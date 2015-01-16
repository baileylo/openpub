<?php

namespace Baileylo\Blog\Site;

class Site
{
    /** @var \DateTime */
    protected $lastModified;

    /** @var \DateTime */
    protected $lastModifiedPost;

    /** @var String */
    protected $title;

    /** @var String */
    protected $subHead;

    /**
     * @param \DateTime $lastModified
     * @param \DateTime $lastModifiedPost
     * @param           $title
     * @param           $subHead
     */
    function __construct(\DateTime $lastModified, \DateTime $lastModifiedPost, $title, $subHead)
    {
        $this->lastModified = $lastModified;
        $this->lastModifiedPost = $lastModifiedPost;
        $this->title = $title;
        $this->subHead = $subHead;
    }

    /**
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSubHead()
    {
        return $this->subHead;
    }

    public function getFeedLastModified()
    {
        return max($this->lastModified, $this->lastModifiedPost);
    }
}
