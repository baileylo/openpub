<?php

namespace App\Http\Controllers;

use App\Article\Page;
use App\Services\Template\TemplateProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use League\CommonMark\CommonMarkConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @param TemplateProvider $templateProvider
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TemplateProvider $templateProvider)
    {
        return $this->responseFactory->view('pages.create', [
            'templates' => $templateProvider->getTemplates()
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
        $page       = new Page($request->only('title', 'slug', 'template'));
        $body       = $request->input('body');
        $page->html = $body;
        if ($request->input('is_markdown')) {
            $page->markdown = $body;
            $page->html     = $converter->convertToHtml($body);
            $page->is_html  = false;
        }

        $page->save();

        return $this->responseFactory->redirectToRoute('page.edit', $page->slug)
            ->with('save.status', 'created');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = $this->findPage($slug);

        return $this->responseFactory->view('pages.show', ['page' => $page]);
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
        $page = $this->findPage($slug);

        return $this->responseFactory->view('pages.edit', [
            'page'      => $page,
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
        $page = $this->findPage($slug);

        $page->is_html = !$request->has('is_markdown');

        if ($page->is_html) {
            $page->html     = $request->input('body');
            $page->markdown = '';
        } else {
            $page->html     = $converter->convertToHtml($request->input('body'));
            $page->markdown = $request->input('body');
        }

        $page->fill([
            'title'       => $request->input('title'),
            'slug'        => $request->input('slug'),
            'template'    => $request->input('template'),
        ]);

        $page->save();

        return $this->responseFactory->redirectToRoute('page.edit', $page->slug)
            ->with('save.status', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $page = $this->findPage($slug);
        $page->delete();
        return $this->responseFactory->redirectToRoute('page.index');
    }

    /**
     * Find a post by its slug or fail.
     *
     * @param string $slug
     *
     * @return Page
     */
    private function findPage($slug)
    {
        $page = Page::findBySlug($slug);
        if (!$page) {
            throw new NotFoundHttpException;
        }

        return $page;
    }

}
