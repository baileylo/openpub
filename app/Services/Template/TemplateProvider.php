<?php

namespace App\Services\Template;

use Illuminate\Support\Collection;
use Symfony\Component\Finder\Finder;

class TemplateProvider
{
    /** @var Finder */
    private $fileFinder;

    /** @var string */
    private $templateDirectory;

    public function __construct(Finder $fileFinder, $templateDirectory)
    {
        $this->fileFinder = $fileFinder;
        $this->templateDirectory = $templateDirectory;
    }

    public function getTemplates()
    {
        $files = $this->fileFinder->files()
            ->in($this->templateDirectory)
            ->name('*.blade.php');

        $templates = [];
        foreach($files as $file) {
            /** @var \SplFileInfo $file */
            $templates[] = $file->getBasename('.blade.php');
        }

        return $templates;
    }
}
