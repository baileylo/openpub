@extends('layouts.full')

@section('title') Pages &mdash; {{{ $site->getTitle() }}} @stop
@section('footer') @stop
@section('content')

    <table class="columns large-12">
        <thead>
        <tr>
            <th>Title</th>
            <th class="hidden-for-small-down">Actions</th>
        </tr>
        </thead>
        @foreach($pages as $page)
            <tr>
                <td>
                    {{ $page->getTitle() }}
                    <div class="visible-for-small-down">
                        <a href="{{ route('post.permalink', [$page->getSlug()]) }}" title="View"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('post.edit', [$page->getSlug()]) }}" title="Edit"><i class="fa fa-pencil"></i></a>
                        {!! Form::csrfLink('<i class="fa fa-remove"></i>', ['route' => ['post.unpublish', $page->getSlug()], 'method' => 'patch', 'title' => 'Un Publish']) !!}
                        {!! Form::csrfLink('<i class="fa fa-trash alert"></i>', ['route' => ['page.delete', $page->getSlug()], 'method' => 'delete', 'title' => 'Delete']) !!}
                    </div>
                </td>
                <td class="hidden-for-small-down">
                    <a href="{{ route('post.permalink', [$page->getSlug()]) }}" title="View"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('post.edit', [$page->getSlug()]) }}" title="Edit"><i class="fa fa-pencil"></i></a>
                    {!! Form::csrfLink('<i class="fa fa-remove"></i>', ['route' => ['post.unpublish', $page->getSlug()], 'method' => 'patch', 'title' => 'Un Publish']) !!}
                    {!! Form::csrfLink('<i class="fa fa-trash"></i>', ['route' => ['page.delete', $page->getSlug()], 'method' => 'delete', 'title' => 'Delete']) !!}
                </td>
            </tr>
        @endforeach
        <tfoot>
            <tr>
                <td colspan="4" class="hidden-for-small-down">{!! $pagination->render() !!}</td>
            </tr>
        </tfoot>
    </table>
@stop
