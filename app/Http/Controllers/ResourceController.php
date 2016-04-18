<?php

namespace App\Http\Controllers;

use App\Article\Article;
use App\Services\Article as ArticleService;
use App\Http\Requests;
use Illuminate\Routing\ResponseFactory;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResourceController extends Controller
{

    /** @var ArticleService\Repository */
    private $articleRepository;

    public function __construct(ResponseFactory $responseFactory, ArticleService\Repository $articleRepository)
    {
        parent::__construct($responseFactory);
        $this->articleRepository = $articleRepository;
    }

    public function find($slug)
    {
        $article = $this->articleRepository->findBySlug($slug);
        if (!$article) {
            throw new NotFoundHttpException;
        }

        if (!$article->is_published && !\Auth::check()) {
            throw new NotFoundHttpException;
        }

        return $this->responseFactory->view("post.templates.{$article->template}", [
            'article' => $article
        ]);
    }
}
