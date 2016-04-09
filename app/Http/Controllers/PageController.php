<?php

namespace App\Http\Controllers;

use App\Article\Page;
use App\Services\Template\TemplateProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use League\CommonMark\CommonMarkConverter;

class PageController extends ArticleController
{
    protected $templates = [
        'create' => 'pages.create'
    ];

    protected $redirects = [
        'destroy' => 'page.index'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseFactory->view('pages.index', [
            'pages' => Page::paginate()
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
        $pageData = $request->only('title', 'slug', 'template', 'body', 'is_markdown');
        $page = $this->updateArticle(new Page, $converter, $pageData);

        $page->save();

        return $this->responseFactory->redirectToRoute('page.edit', $page->slug)
            ->with('save.status', 'created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TemplateProvider $templateProvider
     * @param string           $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(TemplateProvider $templateProvider, $slug)
    {
        return $this->responseFactory->view('pages.edit', [
            'page'      => $this->findBySlug($slug),
            'status'    => session('save.status', false),
            'templates' => $templateProvider->getTemplates()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CommonMarkConverter       $converter
     * @param  string                   $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommonMarkConverter $converter, $slug)
    {
        $page = $this->findBySlug($slug);
        $data = $request->only('slug', 'title', 'template', 'is_markdown', 'body', 'description');
        $page = $this->updateArticle($page, $converter, $data);

        $page->save();

        return $this->responseFactory->redirectToRoute('page.edit', $page->slug)
            ->with('save.status', 'updated');
    }
}
