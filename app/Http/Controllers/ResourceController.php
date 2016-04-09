<?php

namespace App\Http\Controllers;

use App\Article\Article;

use App\Http\Requests;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResourceController extends Controller
{
    public function find($slug)
    {
        /** @var Article $post */
        $article = Article::findBySlug($slug, ['categories']);
        if (!$article) {
            throw new NotFoundHttpException;
        }

        return $this->responseFactory->view("post.templates.{$article->template}", [
            'article' => $article
        ]);
    }
}
