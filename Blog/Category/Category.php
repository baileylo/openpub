<?php

namespace Baileylo\Blog\Category;

use Illuminate\Support\Str;

class Category
{
    /** @var String */
    protected $slug;

    /** @var String */
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
        $this->slug = Str::slug($name);
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getName()
    {
        return $this->name;
    }
}
