@extends('layouts.full')

@section('title') Pages &mdash; Admin @stop

@section('content')
    <a href="{{ route('page.create') }}" class="button tiny round right success">Create Page</a>
    <table class="columns large-12">
        <thead>
            <tr>
                <th colspan="2">Title</th>
            </tr>
        </thead>
        @foreach($pages as $page)
            <tr>
                <td>
                    <a href="{{ route('resource', $page->slug) }}">{{ $page->title }}</a>
                    <div class="visible-for-small-down">
                        <a href="{{ route('page.edit', $page->slug) }}" title="Edit" class="label round"><i class="fa fa-pencil"></i></a>
                        @include('partials.delete-link', ['url' => route('page.destroy', $page->slug)])
                    </div>
                </td>
                <td class="hidden-for-small-down text-right">
                    <a href="{{ route('page.edit', $page->slug) }}" title="Edit" class="label round"><i class="fa fa-pencil"></i></a>
                    @include('partials.delete-link', ['url' => route('page.destroy', $page->slug)])
                </td>
            </tr>
        @endforeach
        <tfoot>
        <tr>
            <td colspan="4" class="hidden-for-small-down">
                {!! $pages->render() !!}
            </td>
        </tr>
        </tfoot>
    </table>
@stop

@section('footer') @stop
