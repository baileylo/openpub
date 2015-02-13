<?php

namespace Baileylo\Core\Mongo;

use Doctrine\MongoDB\Connection;
use Illuminate\Support\ServiceProvider;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;

class MongoODMServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('doctrine.odm.configuration', function ($app) {
            $configs = $app['config']['doctrine'];

            $configuration = new Configuration();
            $configuration->setProxyDir($configs['proxy']['dir']);
            $configuration->setProxyNamespace($configs['proxy']['namespace']);
            $configuration->setHydratorDir($configs['hydrator']['dir']);
            $configuration->setHydratorNamespace($configs['hydrator']['namespace']);
            $configuration->setMetadataDriverImpl(new YamlDriver(
                $configs['metadata']['dir'],
                $configs['metadata']['extension']
            ));

            $configuration->setDefaultDB($app['config']['database.mongodb.collection']);

            return $configuration;
        });

        $this->app->singleton('doctrine.odm.connection', function ($app) {
            return new Connection(
                $app['mongodb.connection'],
                [],
                $app['doctrine.odm.configuration']
            );
        });

        $this->app->singleton('mongodb.connection', function ($app) {
            $config = $app['config']['database.mongodb'];
            $options = array_filter($config['options']);

            $server = rtrim("{$config['host']}/{$config['collection']}", '/');

            return new \MongoClient($server, $options);
        });

        $this->app->singleton('mongodb.database', function ($app) {
            return $app['mongodb.connection']->{$app['config']['database.mongodb.collection']};
        });

        $this->app->singleton(DocumentManager::class, function ($app) {
            return DocumentManager::create(
                $app['doctrine.odm.connection'],
                $app['doctrine.odm.configuration']
            );
        });
    }
}
