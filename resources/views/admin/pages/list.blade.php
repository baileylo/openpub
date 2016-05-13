@extends('admin.layouts.master')

@section('content-header')
    <h1>Pages</h1>
    <ol class="breadcrumb">
        <li>Content</li>
        <li><a href="{{ route('admin.page.index') }}" class="active">Page</a></li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-1">
            <a href="#" class="btn btn-sm btn-default">
                <i class="fa fa-refresh" aria-hidden="true"></i>
                Refresh
            </a>
        </div>
        <div class="col-lg-9">
            <form class="form-inverse">
                <label class="sr-only" for="search">Search For Page</label>
                <div class="input-group">
                    <input type="search" id="search" class="form-control input-sm" placeholder="Search" name="search" aria-describedby="search-help-block" />
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-sm">Go!</button>
                    </span>
                </div>
                <span id="search-help-block" class="help-block">
                    Search a page by title.
                </span>
            </form>
        </div>
        <div class="col-lg-2 text-right">
            <a href="{{ route('admin.page.create') }}" class="btn btn-default btn-sm">Create New Post</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table admin-article-list">
                <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td class="admin-article-list-title">
                            <a href="{{ route('resource', $page->slug) }}">{{ $page->title }}</a>
                        </td>
                        <td class="admin-article-list-options">
                            <a href="{{ route('resource', $page->slug) }}" class="btn btn-default btn-sm" target="_blank">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                View
                            </a>
                            <a href="{{ route('admin.page.edit', $page->slug) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Edit
                            </a>
                            @include('partials.delete-link', ['url' => route('admin.page.destroy', $page->slug)])
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" align="center">
                        {!! $pages->links() !!}
                    </td>
                </tr>
                </tfoot>

            </table>
        </div>
    </div>
@endsection