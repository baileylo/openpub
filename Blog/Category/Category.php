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

    /**
     * Compare if two categories are identical.
     *
     * @param Category $category
     *
     * @return bool
     */
    public function matches(Category $category)
    {
        return $category->getSlug() === $this->getSlug();
    }
}
