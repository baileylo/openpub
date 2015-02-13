<?php

namespace App\Http\Controllers\Feed;

use Baileylo\Blog\Post\PostRepository;
use Baileylo\Blog\Site\Site;
use App\Http\Responses\AtomResponse;
use Baileylo\Core\Laravel\Renderable;
use App\Http\Controllers\Controller;

class Atom extends Controller
{
    use Renderable;

    /** @var PostRepository */
    private $postRepository;

    /** @var Site */
    private $site;

    public function __construct(PostRepository $postRepo, Site $site)
    {
        $this->postRepository = $postRepo;
        $this->site = $site;
    }

    public function feed()
    {
        $posts = $this->postRepository->findRecentPosts(20, 0)->toArray(false);
        $site = $this->site;

        $content = $this->viewFactory()->make('feeds.atom', compact('posts', 'site'));

        return new AtomResponse($content);
    }
}
