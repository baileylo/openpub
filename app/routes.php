<?php

use Baileylo\BlogApp\Controller as Controllers;
use Baileylo\BlogApp\Routing\Filter\Before;
use Baileylo\BlogApp\Routing\Filter\After;

Route::pattern('date', '\d{4}\/\d{2}\/\d{2}');
Route::pattern('page', '[1-9]+[0-9]*');

Route::filter('beforeAtomCache', Before\AtomCacheFilter::class);
Route::filter('beforePostCache', Before\PostCacheFilter::class);
Route::filter('afterAtomCache', After\AtomCacheFilter::class);
Route::filter('afterPostCache', After\PostCacheFilter::class);



// Post Permalink
Route::get('{date}/{postSlug}', [
    'uses' => Controllers\Post\View::class . '@view',
    'before' => 'beforePostCache',
    'after' => 'afterPostCache',
    'as' => 'post.permalink'
]);

// Paginated Homepage
Route::get('', ['uses' => Controllers\Home\View::class . '@view', 'as' => 'home']);
Route::get('page/{page}', ['uses' => Controllers\Home\View::class . '@view', 'as' => 'home.paginated']);

// Paginated Filtered Category Page
Route::get('category/{category}', ['uses' => Controllers\Post\ListingView::class . '@category', 'as' => 'category']);
Route::get('category/{category}/{page}', ['uses' => Controllers\Post\ListingView::class . '@category', 'as' => 'category.paginated']);

// Login Page
Route::get('login', ['uses' => Controllers\Auth\LoginView::class . '@view']);
Route::post('login', ['uses' => Controllers\Auth\LoginHandler::class . '@handle']);

// Logout page
Route::get('logout', ['uses' => Controllers\Auth\LogoutHandler::class . '@logout', 'as' => 'logout']);

Route::get('feed', [
    'uses' => Controllers\Feed\Atom::class . '@feed',
    'before' => 'beforeAtomCache',
    'after' => 'afterAtomCache',
    'as' => 'feed.atom'
]);

Route::group(['before' => 'auth'], function () {

    Route::get('/import', ['uses' => Controllers\Admin\ImportView::class . '@view', 'as' => 'import']);
    Route::post('/import', ['uses' => Controllers\Admin\ImportHandler::class . '@import']);

    // Settings Routes
    Route::get('/settings', ['uses' => Controllers\User\Settings\SettingsView::class . '@view', 'as' => 'settings']);

    // Generic Admin Page
    Route::get('/admin', ['uses' => Controllers\Admin\ListView::class . '@view', 'as' => 'admin']);
    Route::get('/admin/{page}', ['uses' => Controllers\Admin\ListView::class . '@view', 'as' => 'admin.paginated']);

    Route::get('/admin/unpublished', ['uses' => Controllers\Admin\ListUnpublishedPosts::class . '@view', 'as' => 'admin.unpublished']);
    Route::get('/admin/unpublished/{page}', ['uses' => Controllers\Admin\ListUnpublishedPosts::class . '@view', 'as' => 'admin.unpublished.paginated']);

    Route::get('/write', ['uses' => Controllers\Post\Create\View::class . '@view', 'as' => 'admin.post.create']);
    Route::get('{date}/{postSlug}/edit', ['uses' => Controllers\Post\Edit\ViewPublishedPost::class . '@view', 'as' => 'admin.post.edit']);
    Route::get('unpublished/{postSlug}', ['uses' => Controllers\Post\View\ViewUnpublishedPost::class . '@view', 'as' => 'admin.unpublished.preview']);
    Route::get('unpublished/{postSlug}/edit', ['uses' => Controllers\Post\Edit\ViewUnpublishedPost::class . '@view', 'as' => 'admin.unpublished.edit']);


    Route::group(['before' => 'csrf'], function () {
        Route::post('/write', ['uses' => Controllers\Post\Create\CreatePostHandler::class . '@handle']);
        Route::put('{date}/{postSlug}/edit', ['uses' => Controllers\Post\Edit\EditPublishedPostHandler::class . '@handle']);
        Route::put('unpublished/{postSlug}/edit', ['uses' => Controllers\Post\Edit\EditUnpublishedPostHandler::class . '@handle']);

        Route::delete('/admin/{postSlug}', ['uses' => Controllers\Post\Delete\Delete::class . '@delete', 'as' => 'admin.post.delete']);
        Route::patch('/admin/{postSlug}/publish', ['uses' => Controllers\Post\Publish\Publish::class . '@publish', 'as' => 'admin.post.publish']);
        Route::patch('/admin/{postSlug}/unpublish', ['uses' => Controllers\Post\Publish\Unpublish::class . '@unpublish', 'as' => 'admin.post.unpublish']);

        Route::put('/settings', ['uses' => Controllers\User\Settings\SettingsHandler::class . '@handleForm']);
        Route::put('/update-password', ['uses' => Controllers\User\Settings\PasswordHandler::class . '@handleForm', 'as' => 'passwordHandler']);
    });
});
