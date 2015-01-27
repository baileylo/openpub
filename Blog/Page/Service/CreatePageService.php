<?php

namespace Baileylo\Blog\Page\Service;

use Baileylo\Blog\Page\Page;
use Baileylo\Blog\Page\PageRepository;
use Baileylo\Blog\Page\Validator\NewPageValidator;
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
     * @param String $slug URL safe unique identifier for the page
     * @param String $html HTML to generate on the page
     * @param Bool $isVisible Flag to determine if page can be viewed by logged out users
     *
     * @throws ValidationException
     * @return Page the newly created page
     */
    public function create($slug, $html, $isVisible)
    {
        $this->validator->validate($slug, $html);
        $page = Page::create($slug, $html, $isVisible);
        $this->pageRepository->save($page, true);

        return $page;
    }
}
