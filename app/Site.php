<?php

namespace App;

class Site
{
    /** @var String Google Analytics id */
    protected $google_analytics_id = null;

    /** @var string Facebook app id */
    protected $facebook_id = null;

    /** @var string the HTML title of the site */
    protected $title = null;

    /** @var string  */
    protected $description;

    public function __construct($title, $description, $ga_id, $fb_id)
    {
        $this->title = $title;
        $this->description = $description;
        $this->google_analytics_id = $ga_id;
        $this->facebook_id = $fb_id;
    }

    /**
     * @return String
     */
    public function getGoogleAnalyticsId()
    {
        return $this->google_analytics_id;
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
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
    public function getDescription()
    {
        return $this->description;
    }
}
