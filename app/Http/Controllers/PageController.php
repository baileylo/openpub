<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Requests;
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->responseFactory->view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Page $page */
        $page = Page::create($request->only('title', 'slug', 'body'));

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
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $page = $this->findPage($slug);

        return $this->responseFactory->view('pages.edit', [
            'page' => $page,
            'status' => session('save.status', false)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string                   $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $page = $this->findPage($slug);

        $page->update($request->only('title', 'slug', 'body'));

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
