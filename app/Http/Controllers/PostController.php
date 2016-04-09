<?php

namespace App\Http\Controllers;

use App\Article\Article;
use App\Category;
use App\Article\Post;
use App\Services\Template\TemplateProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Collection;
use League\CommonMark\CommonMarkConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends ArticleController
{
    protected $templates = [
        'create' => 'post.create'
    ];

    protected $redirects = [
        'destroy' => 'admin'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseFactory->view('post.list', [
            'posts' => Post::published()->simplePaginate(25)
        ]);
    }

    /**
     * Shows posts separated out by their publish date
     */
    public function overview()
    {
        return $this->responseFactory->view('post.overview', [
            'published' => Post::published()->paginate(25),
            'pending'   => Post::unpublished()->limit(25)->get(),
        ]);
    }

    public function category($slug)
    {
        /** @var Category $category */
        $category = Category::find($slug);
        if (!$category) {
            throw new NotFoundHttpException;
        }

        return $this->responseFactory->view('post.list', [
            'posts' => $category->posts()->published()->simplePaginate()
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

        $user->posts()->save($post);

        $post->categories()->attach(
            $this->getCategories($request->input('categories'))
        );

        return $this->responseFactory->redirectToRoute('resource', $post->slug);
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
        return $this->responseFactory->view('post.edit', [
            'post'      => $this->findBySlug($post, ['categories']),
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
        $post = $this->findBySlug($post);

        $data = $request->only('title', 'template', 'is_markdown', 'body', 'description');
        $data['slug'] = $post->slug;

        $post = $this->updateArticle($post, $converter, $data);

        if (!$post->is_published && $request->input('isPublished') === 'yes') {
            $post->published_at = new \DateTime('-5 seconds');
        }

        $post->save();

        $post->categories()->sync(
            $this->getCategories($request->input('categories'))->pluck('slug')->toArray()
        );

        $save_status = $post->wasRecentlyCreated && !$post->is_published ? 'created' : 'updated';
        return $this->responseFactory
            ->redirectToRoute('post.edit', $post->slug)
            ->with('save.status', $save_status);
    }
}
