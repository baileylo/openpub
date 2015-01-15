<?php

namespace Baileylo\Core\Laravel\Validation\Mongo;

use Illuminate\Validation\ValidationServiceProvider;

class MongoValidationServiceProvider extends ValidationServiceProvider
{
    protected function registerPresenceVerifier()
    {
        $this->app->bindShared('validation.presence', function($app)
        {
            return new MongoPresenceVerifier($app['mongodb.database']);
        });
    }

}
