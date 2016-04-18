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

    public function __construct(ResponseFactory $responseFactory, ArticleService\Repository $articleRepository)
    {
        parent::__construct($responseFactory);
        $this->articleRepository = $articleRepository;
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
     * Remove the specified resource from storage.
     *
     * @param  string $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $this->findBySlug($post)->delete();

        return $this->responseFactory->redirectToRoute($this->redirects['destroy']);
    }

    /**
     * Find article by slug.
     *
     * @param string $slug
     * @param array  $relationships
     *
     * @return Article
     * @throws NotFoundHttpException
     */
    protected function findBySlug($slug, array $relationships = [])
    {
        $article = $this->articleRepository->findBySlug($slug);
        if (!$article) {
            throw new NotFoundHttpException();
        }

        if ($relationships) {
            $article->load($relationships);
        }

        return $article;
    }
}
