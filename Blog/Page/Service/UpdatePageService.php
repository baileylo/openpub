<?php

namespace Baileylo\Blog\Page\Service;

use Baileylo\Blog\Page\Page;
use Baileylo\Blog\Page\PageRepository;
use Baileylo\Blog\Page\Validator\NewPageValidator;
use Baileylo\Blog\Page\Validator\UpdatePageValidator;
use Baileylo\Blog\Validation\ValidationException;

class UpdatePageService
{
    /** @var PageRepository */
    private $pageRepository;

    /** @var UpdatePageValidator */
    private $validator;

    public function __construct(PageRepository $pageRepository, UpdatePageValidator $validator)
    {
        $this->pageRepository = $pageRepository;
        $this->validator = $validator;
    }

    /**
     * Updates an existing page
     *
     * @param Page   $page      The page the data will be attached too.
     * @param String $slug      URL safe unique identifier for the page
     * @param String $html      HTML to generate on the page
     * @param Bool   $isVisible Flag to determine if page can be viewed by logged out users
     *
     * @return Page
     * @throws ValidationException
     */
    public function create(Page $page, $slug, $html, $isVisible)
    {
        $this->validator->validate($page, $slug, $html);
        $page->update($slug, $html);
        $isVisible ? $page->publish() : $page->unpublish();
        $this->pageRepository->save($page, true);

        return $page;
    }
}
