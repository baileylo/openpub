<?php

namespace App\Http\Controllers\Post\Listings;

use App\Http\Controllers\Controller;
use Baileylo\Blog\Category\Category;
use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\PostRepository;
use Baileylo\BlogApp\Pagination\LengthAwareRoutePaginator;
use Baileylo\Core\Laravel\Renderable;
use Illuminate\Contracts\Routing\UrlGenerator;

class CategoryView extends Controller
{
    use Renderable;

    const PAGE_SIZE = 6;

    /** @var PostRepository */
    private $postRepository;

    /** @var UrlGenerator */
    private $urlGenerator;

    public function __construct(PostRepository $postRepository, UrlGenerator $urlGenerator)
    {
        $this->postRepository = $postRepository;
        $this->urlGenerator = $urlGenerator;
    }
    public function category(Category $category, $page = 1)
    {
        $posts = $this->postRepository->findRecentPostsByCategory(
            $category->getSlug(),
            self::PAGE_SIZE,
            ( $page - 1) * self::PAGE_SIZE
        );

        $category = $this->resolveCategory($category, $posts->getNext());
        $posts->reset();

        $pagination = new LengthAwareRoutePaginator(
            $posts->toArray(),
            $posts->count(),
            self::PAGE_SIZE,
            'category',
            $this->urlGenerator,
            $page,
            [$category->getSlug()]
        );

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
