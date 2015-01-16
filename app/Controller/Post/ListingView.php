<?php

namespace Baileylo\BlogApp\Controller\Post;

use Baileylo\Blog\Category\Category;
use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\PostRepository;
use Baileylo\BlogApp\Pagination\Paginate;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Routing\Controller;

class ListingView extends Controller
{
    use Renderable;

    const PAGE_SIZE = 6;

    /** @var PostRepository */
    private $postRepository;
    /** @var Paginate */
    private $paginate;

    public function __construct(PostRepository $postRepository, Paginate $paginate)
    {
        $this->postRepository = $postRepository;
        $this->paginate = $paginate;
    }

    public function view($page = 1)
    {
        /** @var \Doctrine\ODM\MongoDB\Cursor $posts */
        $posts = $this->postRepository->findRecentPosts(self::PAGE_SIZE, ($page - 1) * self::PAGE_SIZE);
        $pagination = $this->paginate->paginate($posts, self::PAGE_SIZE, 'home', $page);

        return $this->viewFactory()->make('home.list', compact('posts', 'pagination'));
    }

    public function category(Category $category, $page = 1)
    {
        $posts = $this->postRepository->findRecentPostsByCategory($category->getSlug(), self::PAGE_SIZE, 0);
        $pagination = $this->paginate->paginate($posts, self::PAGE_SIZE, 'category', $page);

        $category = $this->resolveCategory($category, $posts->getSingleResult());

        return $this->viewFactory()->make('home.list', compact('posts', 'pagination', 'category'));
    }

    /**
     * Determine the correct name of the Category.
     * Since the $category is populated only by slug, the name may be incorrect. Loop through the categories on the first
     * post until we find a matching category, then return that category.
     *
     * @param Category $category
     * @param Post     $post
     *
     * @return Category
     */
    private function resolveCategory(Category $category, Post $post = null)
    {
        if (is_null($post)) {
            return $category;
        }

        foreach($post->getCategories() as $postCategory) {
            if ($postCategory->matches($category)) {
                return $postCategory;
            }
        }

        return $category;
    }
}
