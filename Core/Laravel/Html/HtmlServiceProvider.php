<?php

namespace Baileylo\Core\Laravel\Html;

class HtmlServiceProvider extends \Illuminate\Html\HtmlServiceProvider
{
    protected function registerFormBuilder()
    {
        $this->app->bindShared('form', function($app)
        {

            $form = new FormBuilder($app['html'], $app['url'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });
    }
}
