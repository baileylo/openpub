<?php

namespace App\Http\Controllers;

use App\Article\Post;
use App\Category;
use App\Services\Category as CategoryService;
use App\Services\Template\TemplateProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Collection;
use League\CommonMark\CommonMarkConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends ArticleController
{
    protected $templates = [
        'create' => 'admin.posts.create'
    ];

    protected $redirects = [
        'destroy' => 'admin.post.index'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_term = $request->input('search');
        if (!$search_term) {
            return $this->responseFactory->view('admin.posts.list', [
                'posts'  => Post::orderBy('id', 'desc')->paginate(10),
                'status' => session('save.status', false),
            ]);
        }

        $posts = Post::where('title', 'like', "%{$search_term}%")
            ->orderBy('id', 'desc')
            ->paginate(10);

        return $this->responseFactory->view('admin.posts.list', [
            'posts'       => $posts,
            'status'      => session('save.status', false),
            'search_term' => $search_term
        ]);
    }

    /**
     * Shows posts separated out by their publish date
     */
    public function overview()
    {
        return $this->responseFactory->view('post.list', [
            'posts' => Post::published()->simplePaginate(25)
        ]);
    }

    public function category(CategoryService\Repository $repository, $slug)
    {
        $category = $repository->findBySlug($slug);
        if (!$category) {
            throw new NotFoundHttpException;
        }

        return $this->responseFactory->view('post.list', [
            'category' => $category,
            'posts'    => $category->posts()->published()->simplePaginate()
        ]);
    }

    public function feed()
    {
        $posts = Post::published(10)->get();
        $last_updated = $posts->reduce(function ($carry, Post $post) {
            $date = $post->updated_at ?: $post->published_at;
            if (!$carry || $date > $carry) {
                return $date;
            }

            return $carry;
        }, null);

        return $this->responseFactory->view('post.feed', ['posts' => $posts, 'last_updated' => $last_updated], 200, [
            'Content-Type' => 'application/atom+xml; charset=UTF-8'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CommonMarkConverter       $converter
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CommonMarkConverter $converter)
    {
        $this->validate($request, $this->getValidationRules(new Post, $request));

        /** @var \App\User $user */
        $user = $request->user();

        // Add the timestamp to the slug if the slug is already in use.
        $slug = str_slug($request->input('title'));
        if (Post::findBySlug($slug, [])) {
            $slug .= '-' . time();
        }

        $postData = $request->only('title', 'description', 'template', 'body', 'is_markdown');

        /** @var Post $post */
        $post = $this->updateArticle(new Post, $converter, $postData + ['slug' => $slug]);

        if ($request->input('isPublished') === 'yes') {
            $post->published_at = new \DateTime('-5 seconds');
        }

        if ($request->input('published_at')) {
            $post->published_at = new \DateTime($request->input('published_at'));
        }

        $user->posts()->save($post);

        $post->categories()->attach(
            $this->getCategories($request->input('categories'))
        );

        return $this->responseFactory
            ->redirectToRoute('admin.post.edit', $post->slug)
            ->with('save.status', 'Created');
    }

    private function getCategories($categories)
    {
        $category_data = Collection::make(explode(',', $categories))
            ->filter()
            ->map(function ($category) {
                $category = trim($category);

                return ['slug' => str_slug($category), 'name' => $category];
            });

        /** @var Collection $persisted_categories */
        $persisted_categories = Category::whereIn('slug', $category_data->pluck('slug'))->get()->keyBy('slug');

        foreach ($category_data as $data) {
            if (!isset($persisted_categories[$data['slug']])) {
                $persisted_categories->push(Category::create($data));
            }
        }

        return $persisted_categories;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TemplateProvider $template
     * @param  string          $post
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(TemplateProvider $template, $post)
    {
        return $this->responseFactory->view('admin.posts.edit', [
            'post'      => $this->findBySlug($post, ['categories'], true),
            'status'    => session('save.status', false),
            'templates' => $template->getTemplates()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CommonMarkConverter       $converter
     * @param  string                   $post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommonMarkConverter $converter, $post)
    {
        /** @var Post $post */
        $post = $this->findBySlug($post, [], true);

        $this->validate($request, $this->getValidationRules($post, $request));

        $data = $request->only('title', 'template', 'is_markdown', 'body', 'description');
        $data['slug'] = $post->slug;

        $post = $this->updateArticle($post, $converter, $data);

        if ($request->input('isPublished') === 'yes') {
            $post->published_at = new \DateTime('-5 seconds');
        }

        if ($request->input('published_at')) {
            $post->published_at = new \DateTime($request->input('published_at'));
        }

        $post->save();

        $post->categories()->sync(
            $this->getCategories($request->input('categories'))->pluck('slug')->toArray()
        );

        $save_status = $post->wasRecentlyCreated && !$post->is_published ? 'created' : 'updated';

        return $this->responseFactory
            ->redirectToRoute('admin.post.edit', $post->slug)
            ->with('save.status', $save_status);
    }

    private function getValidationRules(Post $post, Request $request)
    {
        if ($post->is_published || $request->input('isPublished') === 'yes') {
            return [
                'title'        => 'required|string|between:3,255',
                'categories'   => 'string',
                'template'     => 'required|string|template',
                'description'  => 'required|string|min:50',
                'body'         => 'required|string|min:50',
                'markdown'     => 'string',
                'published_at' => 'date'
            ];
        }

        return [
            'title'        => 'required|string|between:3,255',
            'categories'   => 'string',
            'template'     => 'required|string|template',
            'description'  => 'string|min:50',
            'body'         => 'string|min:50',
            'markdown'     => 'string',
            'published_at' => 'date'
        ];
    }
}
