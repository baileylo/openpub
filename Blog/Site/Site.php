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

    /** @var String Google Analytics Tracking ID */
    private $gaId;

    /**
     * @param \DateTime $lastModified
     * @param \DateTime $lastModifiedPost
     * @param String    $title   Site Title
     * @param String    $subHead Site sub title
     * @param String    $gaId    Google Analytics UA
     */
    function __construct(\DateTime $lastModified, \DateTime $lastModifiedPost, $title, $subHead, $gaId)
    {
        $this->lastModified = $lastModified;
        $this->lastModifiedPost = $lastModifiedPost;
        $this->title = $title;
        $this->subHead = $subHead;
        $this->gaId = $gaId;
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

    /**
     * @return String
     */
    public function getGAId()
    {
        return $this->gaId;
    }
}
