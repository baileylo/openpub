<?php

use Baileylo\BlogApp\Controller as Controllers;

Route::pattern('date', '\d{4}\/\d{2}\/\d{2}');
Route::pattern('page', '[1-9]+[0-9]*');

// Paginated Homepage
Route::get('', ['uses' => Controllers\Home\View::class . '@view', 'as' => 'home']);
Route::get('page/{page}', ['uses' => Controllers\Home\View::class . '@view', 'as' => 'home.paginated']);

// Paginated Filtered Category Page
Route::get('category/{category}', ['uses' => Controllers\Post\ListingView::class . '@category', 'as' => 'category']);
Route::get('category/{category}/{page}', ['uses' => Controllers\Post\ListingView::class . '@category', 'as' => 'category.paginated']);

// Login Page
Route::get('login', ['uses' => Controllers\Auth\LoginView::class . '@view', 'before' => 'forceSSL']);
Route::post('login', ['uses' => Controllers\Auth\LoginHandler::class . '@handle', 'before' => 'forceSSL']);

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
    Route::get('/settings', ['uses' => Controllers\User\Settings\SettingsView::class . '@view', 'as' => 'settings', 'before' => 'forceSSL']);

    // Generic Admin Page
    Route::get('/admin/', ['uses' => Controllers\Admin\ListView::class . '@view', 'as' => 'admin']);
    Route::get('/admin/{page}', ['uses' => Controllers\Admin\ListView::class . '@view', 'as' => 'admin.paginated']);

    Route::get('/admin/pages/', ['uses' => Controllers\Page\View\ListView::class . '@view', 'as' => 'admin.pages']);
    Route::get('/admin/pages/{page}', ['uses' => Controllers\Page\View\ListView::class . '@view', 'as' => 'admin.pages.paginated']);

    Route::get('/admin/posts/unpublished', ['uses' => Controllers\Admin\ListUnpublishedPosts::class . '@view', 'as' => 'admin.unpublished']);
    Route::get('/admin/posts/unpublished/{page}', ['uses' => Controllers\Admin\ListUnpublishedPosts::class . '@view', 'as' => 'admin.unpublished.paginated']);

    Route::get('/write', ['uses' => Controllers\Post\Create\View::class . '@view', 'as' => 'admin.post.create']);
    Route::get('/write/page', ['uses' => Controllers\Page\Create\View::class . '@view', 'as' => 'admin.page.create']);

    // Edit
    Route::get('{slug}/edit', ['uses' => Controllers\Resource\Edit::class . '@view', 'as' => 'page.edit']);
    Route::get('{slug}/edit', ['uses' => Controllers\Resource\Edit::class . '@view', 'as' => 'post.edit']);

    Route::group(['before' => 'csrf'], function () {
        // Delete Page Or Post
        Route::delete('{slug}', ['uses' => Controllers\Resource\Delete::class . '@delete', 'as' => 'page.delete']);
        Route::delete('{slug}', ['uses' => Controllers\Resource\Delete::class . '@delete', 'as' => 'post.delete']);

        // Handle Edits to Page
        Route::put('{slug}/edit', ['uses' => Controllers\Resource\EditHandler::class . '@handle']);
        Route::post('{slug}/edit', ['uses' => Controllers\Resource\EditHandler::class . '@handle']);

        // Create Page/Slug
        Route::post('/write', ['uses' => Controllers\Post\Create\CreatePostHandler::class . '@handle']);
        Route::post('/write/page', ['uses' => Controllers\Page\Create\Handler::class . '@handleForm', 'as' => 'admin.page.create']);

        // Publish / Unpublish Page
        Route::patch('{slug}/publish', ['uses' => Controllers\Post\Publish\Publish::class . '@publish', 'as' => 'admin.post.publish']);
        Route::patch('{slug}/unpublish', ['uses' => Controllers\Post\Publish\Unpublish::class . '@unpublish', 'as' => 'admin.post.unpublish']);

        Route::put('/settings', ['uses' => Controllers\User\Settings\SettingsHandler::class . '@handleForm', 'before' => 'forceSSL']);
        Route::put('/update-password', ['uses' => Controllers\User\Settings\PasswordHandler::class . '@handleForm', 'as' => 'passwordHandler']);
    });
});

Route::get('{date}/{slug}', ['before' => 'postUrlRedirect']);

// View
Route::get('{slug}', ['uses' => Controllers\Resource\View::class . '@view', 'as' => 'page.permalink', 'before' => 'unpublishedResource|beforeResourceCache', 'after' => 'afterResourceCache']);
Route::get('{slug}', ['uses' => Controllers\Resource\View::class . '@view', 'as' => 'post.permalink', 'before' => 'unpublishedResource|beforeResourceCache', 'after' => 'afterResourceCache']);


