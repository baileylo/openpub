<?php

namespace App\Http\Controllers;

use App\Article\Article;
use App\Services\Template\TemplateProvider;
use App\Services\Article as ArticleService;
use App\Http\Requests;
use Illuminate\Routing\ResponseFactory;
use League\CommonMark\CommonMarkConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends Controller
{
    protected $templates = [];

    protected $redirects = [];

    /** @var ArticleService\Repository */
    private $articleRepository;

    /** @var ArticleService\Repository\Eloquent */
    private $cachelessRepository;

    public function __construct(
        ResponseFactory $responseFactory,
        ArticleService\Repository $articleRepository,
        ArticleService\Repository\Eloquent $cachelessRepository
    ) {
        parent::__construct($responseFactory);
        $this->articleRepository   = $articleRepository;
        $this->cachelessRepository = $cachelessRepository;
    }

    /**
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = $this->findBySlug($slug);

        if (!$article->is_published && !\Auth::check()) {
            throw new NotFoundHttpException;
        }

        return $this->responseFactory->view("post.templates.{$article->template}", [
            'article' => $article
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
        return $this->responseFactory->view($this->templates['create'], [
            'templates' => $templateProvider->getTemplates()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $this->findBySlug($post)->delete();

        return $this->responseFactory
            ->redirectToRoute($this->redirects['destroy'])
            ->with('save.status', 'Deleted');
    }

    /**
     * @param Article             $article   The article it populate
     * @param CommonMarkConverter $converter Library used to convert markdown to HTML
     * @param array               $data      Request that contains the data
     *
     * @return Article
     */
    protected function updateArticle(Article $article, CommonMarkConverter $converter, array $data)
    {
        $article->fill([
            'slug'        => $data['slug'],
            'title'       => $data['title'],
            'template'    => $data['template'],
        ]);

        if (isset($data['description'])) {
            $article->description = $data['description'];
        }

        $body             = $data['body'];
        $article->is_html = !isset($data['is_markdown']);
        if ($article->is_html) {
            $article->html     = $body;
            $article->markdown = '';
        } else {
            $article->markdown = $body;
            $article->html     = $converter->convertToHtml($body);
        }

        return $article;
    }

    /**
     * Find article by slug.
     *
     * @param string $slug          The slug of the article to find.
     * @param array  $relationships A list of relationships to fetch
     * @param bool   $cacheless     false to search cache, this is the default option
     *
     * @return Article
     */
    protected function findBySlug($slug, array $relationships = [], $cacheless = false)
    {
        if ($cacheless) {
            $article = $this->cachelessRepository->findBySlug($slug);
        } else {
            $article = $this->articleRepository->findBySlug($slug);
        }

        if (!$article) {
            throw new NotFoundHttpException();
        }

        if ($relationships) {
            $article->load($relationships);
        }

        return $article;
    }
}
