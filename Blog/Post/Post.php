<?php

namespace Baileylo\Blog\Post;

use Baileylo\Core\Markdown\Markdown;
use Doctrine\Common\Collections\ArrayCollection;
use Baileylo\Blog\Category\Category;
use Illuminate\Support\Str;

class Post
{
    /** @var String|\MongoId */
    protected $id;

    /** @var \DateTimeInterface */
    protected $publishDate;

    /** @var String URL safe UUID */
    protected $slug;

    /** @var String Title of Post */
    protected $title;

    /** @var String Short description, used in OGP */
    protected $description;

    /** @var String Post in markdown format */
    protected $markdown;

    /** @var String Post in generated HTML */
    protected $html;

    /** @var ArrayCollection|Category[] */
    protected $categories;

    /** @var \DateTime */
    protected $updatedAt;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return \Baileylo\Blog\Category\Category[]|ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @return string|null
     */
    public function getMarkdown()
    {
        return $this->markdown;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * @return string|null
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @param string   $title
     * @param string   $description
     * @param string   $body
     * @param Markdown $converter
     */
    public function update($title, $description, $body, Markdown $converter)
    {
        $this->title = $title;
        $this->description = $description;
        $this->markdown = $body;
        $this->html = $converter->toHtml($body);
    }

    public function addCategory(Category $category)
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }
    }

    /**
     * Changes the state of the post to published.
     * @param \DateTimeInterface $date
     */
    public function publish(\DateTimeInterface $date)
    {
        $this->publishDate = $date;
    }

    /**
     * Makes a post unpublished
     */
    public function unpublish()
    {
        $this->publishDate = null;
    }

    /**
     * Determine if a post is published.
     *
     * @return bool
     */
    public function isPublished()
    {
        return !is_null($this->publishDate) || $this->publishDate <= new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return is_null($this->updatedAt) ? $this->publishDate : $this->updatedAt;
    }

    /**
     * Sets the time that this Post was last updated at.
     *
     * @param \DateTime $updatedAt Time when the Post was last updated, if null will use current time.
     */
    public function setUpdatedAt($updatedAt = null)
    {
        if (is_null($updatedAt)) {
            $updatedAt = new \DateTime;
        }

        $this->updatedAt = $updatedAt;
    }
}
