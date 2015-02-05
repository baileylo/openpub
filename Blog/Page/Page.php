<?php

namespace Baileylo\Blog\Page;

class Page
{
    /** @var String|\MongoId */
    protected $id;

    /** @var Bool */
    protected $isVisible;

    /** @var String */
    protected $slug;

    /** @var String The page's title */
    protected $title;

    /** @var String */
    protected $html;

    /** @var \DateTimeInterface */
    protected $createdAt;

    /** @var \DateTimeInterface */
    protected $updatedAt;

    /**
     * @return \MongoId|String
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Creates a new Page.
     *
     * @param String $slug      URL safe identifier
     * @param        $title
     * @param String $html      HTML for the page
     * @param Bool   $isVisible Whether or not the page is accessible for logged out users.
     *
     * @return Page
     */
    public static function create($slug, $title, $html, $isVisible)
    {
        $page = new self();
        $page->title = $title;
        $page->slug = $slug;
        $page->html = $html;
        $page->isVisible = (bool)$isVisible;
        $page->setCreatedAt();
        return $page;
    }

    /**
     * Updates the slug and/or html of an existing page.
     *
     * @param String $slug URL safe identifier
     * @param String $title
     * @param String $html HTML for the page
     */
    public function update($slug, $title, $html)
    {
        $this->slug = $slug;
        $this->title = $title;
        $this->html = $html;
    }

    /**
     * Change the visibility of a page to publicly visible
     */
    public function publish()
    {
        $this->isVisible = true;
    }

    /**
     * Change the visibility of a page to publicly invisible
     */
    public function unpublish()
    {
        $this->isVisible = false;
    }

    /**
     * Determine if the current page has been published.
     * @return bool
     */
    public function isPublished()
    {
        return (bool)$this->isVisible;
    }

    /**
     * Set the time the Page was created at
     *
     * @param \DateTimeInterface|NULL $dt If null current time is used
     */
    public function setCreatedAt(\DateTimeInterface $dt = null)
    {
        $dt = $dt ?: new \DateTime();
        $this->createdAt = $dt;
    }

    /**
     * Set the time the Page was updated at
     *
     * @param \DateTimeInterface|NULL $dt If null current time is used
     */
    public function setUpdatedAt(\DateTimeInterface $dt = null)
    {
        $dt = $dt ?: new \DateTime();
        $this->updatedAt = $dt;
    }

    /**
     * @return String
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return String
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
