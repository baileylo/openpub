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
        <div class="col-lg-12 text-right">
            <a href="{{ route('admin.page.create') }}" class="btn btn-default btn-sm">Create New Post</a>
        </div>
    </div>

    @if (isset($status) && $status)
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-warning text-center" role="alert">
                    Page {{ ucwords($status) }}!
                </div>
            </div>
        </div>
    @endif

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