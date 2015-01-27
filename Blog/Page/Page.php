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
     * @param String $html      HTML for the page
     * @param Bool   $isVisible Whether or not the page is accessible for logged out users.
     *
     * @return Page
     */
    public static function create($slug, $html, $isVisible)
    {
        $page = new self();
        $page->slug = $slug;
        $page->html = $html;
        $page->isVisible = (bool)$isVisible;
        return $page;
    }

    /**
     * Updates the slug and/or html of an existing page.
     *
     * @param String $slug      URL safe identifier
     * @param String $html      HTML for the page
     */
    public function update($slug, $html)
    {
        $this->slug = $slug;
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
     * Set the time the Page was created at
     * @param \DateTimeInterface|NULL $dt If null current time is used
     */
    public function setCreatedAt(\DateTimeInterface $dt = null)
    {
        $dt = $dt ?: new \DateTime();
        $this->createdAt = $dt;
    }

    /**
     * Set the time the Page was updated at
     * @param \DateTimeInterface|NULL $dt If null current time is used
     */
    public function setUpdatedAt(\DateTimeInterface $dt = null)
    {
        $dt = $dt ?: new \DateTime();
        $this->updatedAt = $dt;
    }
}
