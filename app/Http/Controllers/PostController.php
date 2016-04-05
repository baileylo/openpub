<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Services\Template\TemplateProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Collection;
use League\CommonMark\CommonMarkConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @param TemplateProvider $template
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TemplateProvider $template)
    {
        return $this->responseFactory->view('post.create', [
            'templates' => $template->getTemplates()
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

        $post = new Post([
            'slug'        => $slug,
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'markdown'    => $request->input('body'),
            'html'        => $converter->convertToHtml($request->input('body'))
        ]);

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
     * Display the specified resource.
     *
     * @param  string  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        /** @var Post $post */
        $post = Post::findBySlug($post, ['categories']);
        if (!$post) {
            throw new NotFoundHttpException();
        }

        return $this->responseFactory->view("post.templates.{$post->template}", compact('post'));
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
        $post = Post::findBySlug($post);
        if (!$post) {
            throw new NotFoundHttpException();
        }

        return $this->responseFactory->view('post.edit', [
            'post'      => $post,
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
        $post = Post::findBySlug($post, []);
        if (!$post) {
            throw new NotFoundHttpException();
        }

        $post->fill([
            'title'       => $request->input('title'),
            'markdown'    => $request->input('body'),
            'description' => $request->input('description'),
            'html'        => $converter->convertToHtml($request->input('body')),
            'template'    => $request->input('template')
        ]);

        $save_status = false;
        if (!$post->is_published && $request->input('isPublished') === 'yes') {
            $post->published_at = new \DateTime('-5 seconds');
            $save_status = 'published';
        }

        $sync = $post->categories()->sync(
            $this->getCategories($request->input('categories'))->pluck('slug')->toArray()
        );

        if (!$save_status && ($post->isDirty() || $sync['attached'] || $sync['detached'])) {
            $save_status = 'updated';
        }

        $post->save();

        // Expected Save Status:
        // 'created' => When post is created, but not published
        // 'updated' => When post is updated but not published or is already published
        // 'published' => When post is published and was not already.

        if ($post->wasRecentlyCreated && !$post->is_published) {
            $save_status = 'created';
        }

        return $this->responseFactory
            ->redirectToRoute('post.edit', $post->slug)
            ->with('save.status', $save_status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        /** @var Post $post */
        $post = Post::findBySlug($post, []);
        if (!$post) {
            throw new NotFoundHttpException();;
        }

        $post->delete();

        return $this->responseFactory->redirectToRoute('admin');
    }
}
