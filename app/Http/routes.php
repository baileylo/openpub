<?php

Route::pattern('date', '\d{4}\/\d{2}\/\d{2}');
Route::pattern('page', '[1-9]+[0-9]*');

// Paginated Homepage
Route::get('', ['uses' => 'Home\View@view', 'as' => 'home']);
Route::get('page/{page}', ['uses' => 'Home\View@view', 'as' => 'home.paginated']);

// Paginated Filtered Category Page
Route::get('category/{category}', ['uses' => 'Post\Listings\CategoryView@category', 'as' => 'category']);
Route::get('category/{category}/{page}', ['uses' => 'Post\Listings\CategoryView@category', 'as' => 'category.paginated']);

// Login Page
Route::get('login', ['uses' => 'Auth\LoginView@view', 'before' => 'forceSSL']);
Route::post('login', ['uses' => 'Auth\LoginHandler@handle', 'before' => 'forceSSL']);

// Logout page
Route::get('logout', ['uses' => 'Auth\LogoutHandler@logout', 'as' => 'logout']);

Route::get('feed', [
    'uses' => 'Feed\Atom@feed',
    'before' => 'beforeAtomCache',
    'after' => 'afterAtomCache',
    'as' => 'feed.atom'
]);

Route::group(['before' => 'auth'], function () {

    Route::get('/import', ['uses' => 'Admin\ImportView@view', 'as' => 'import']);
    Route::post('/import', ['uses' => 'Admin\ImportHandler@import']);

    // Settings Routes
    Route::get('/settings', ['uses' => 'User\Settings\SettingsView@view', 'as' => 'settings', 'before' => 'forceSSL']);

    // Generic Admin Page
    Route::get('/admin/', ['uses' => 'Admin\ListView@view', 'as' => 'admin']);
    Route::get('/admin/{page}', ['uses' => 'Admin\ListView@view', 'as' => 'admin.paginated']);

    Route::get('/admin/pages/', ['uses' => 'Page\View\ListView@view', 'as' => 'admin.pages']);
    Route::get('/admin/pages/{page}', ['uses' => 'Page\View\ListView@view', 'as' => 'admin.pages.paginated']);

    Route::get('/admin/posts/unpublished', ['uses' => 'Admin\ListUnpublishedPosts@view', 'as' => 'admin.unpublished']);
    Route::get('/admin/posts/unpublished/{page}', ['uses' => 'Admin\ListUnpublishedPosts@view', 'as' => 'admin.unpublished.paginated']);

    Route::get('/write', ['uses' => 'Post\Create\View@view', 'as' => 'admin.post.create']);
    Route::get('/write/page', ['uses' => 'Page\Create\View@view', 'as' => 'admin.page.create']);

    // Edit
    Route::get('{slug}/edit', ['uses' => 'Resource\Edit@view', 'as' => 'page.edit']);
    Route::get('{slug}/edit', ['uses' => 'Resource\Edit@view', 'as' => 'post.edit']);

    Route::group(['before' => 'csrf'], function () {
        // Delete Page Or Post
        Route::delete('{slug}', ['uses' => 'Resource\Delete@delete', 'as' => 'page.delete']);
        Route::delete('{slug}', ['uses' => 'Resource\Delete@delete', 'as' => 'post.delete']);

        // Handle Edits to Page
        Route::put('{slug}/edit', ['uses' => 'Resource\EditHandler@handle']);
        Route::post('{slug}/edit', ['uses' => 'Resource\EditHandler@handle']);

        // Create Page/Slug
        Route::post('/write', ['uses' => 'Post\Create\CreatePostHandler@handle']);
        Route::post('/write/page', ['uses' => 'Page\Create\Handler@handleForm', 'as' => 'admin.page.create']);

        // Publish / Unpublish Page
        Route::patch('{slug}/publish', ['uses' => 'Resource\Publish@publish', 'as' => 'post.publish']);
        Route::patch('{slug}/publish', ['uses' => 'Resource\Publish@publish', 'as' => 'page.publish']);

        Route::patch('{slug}/unpublish', ['uses' => 'Resource\Unpublish@unpublish', 'as' => 'post.unpublish']);
        Route::patch('{slug}/unpublish', ['uses' => 'Resource\Unpublish@unpublish', 'as' => 'page.unpublish']);

        Route::put('/settings', ['uses' => 'User\Settings\SettingsHandler@handleForm', 'before' => 'forceSSL']);
        Route::put('/update-password', ['uses' => 'User\Settings\PasswordHandler@handleForm', 'as' => 'passwordHandler']);
    });
});

Route::get('{date}/{slug}', ['before' => 'postUrlRedirect']);

// View
Route::get('{slug}', ['uses' => 'Resource\View@view', 'as' => 'page.permalink', 'before' => 'unpublishedResource|beforeResourceCache', 'after' => 'afterResourceCache']);
Route::get('{slug}', ['uses' => 'Resource\View@view', 'as' => 'post.permalink', 'before' => 'unpublishedResource|beforeResourceCache', 'after' => 'afterResourceCache']);


