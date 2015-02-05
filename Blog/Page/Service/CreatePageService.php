<?php

namespace Baileylo\Blog\Page\Service;

use Baileylo\Blog\Page\Page;
use Baileylo\Blog\Page\PageRepository;
use Baileylo\Blog\Page\Service\Validator\NewPageValidator;
use Baileylo\Blog\Validation\ValidationException;

class CreatePageService
{
    /** @var PageRepository */
    private $pageRepository;

    /** @var NewPageValidator */
    private $validator;

    public function __construct(PageRepository $pageRepository, NewPageValidator $validator)
    {
        $this->pageRepository = $pageRepository;
        $this->validator = $validator;
    }

    /**
     * Creates a new Page and saves it to the database.
     *
     * @param String $slug      URL safe unique identifier for the page
     * @param        $title
     * @param String $html      HTML to generate on the page
     * @param Bool   $isVisible Flag to determine if page can be viewed by logged out users
     *
     * @return Page
     * @throws ValidationException
     */
    public function create($slug, $title, $html, $isVisible)
    {
        $this->validator->validate($slug, $title, $html);
        $page = Page::create($slug, $title, $html, $isVisible);
        $this->pageRepository->save($page, true);

        return $page;
    }
}
