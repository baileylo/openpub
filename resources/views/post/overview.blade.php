@extends('layouts.full')

@section('title')Admin &mdash;  @stop

@section('content')
    @if (count($pending))
        <table class="columns large-12">
            <thead>
            <tr>
                <th>Title</th>
                <th class="hidden-for-small-down" style="min-width:145px;">Publish Date</th>
                <th class="hidden-for-small-down" style="min-width:85px;">Actions</th>
            </tr>
            </thead>

            @foreach($pending as $post)
                <tr>
                    <td>
                        <a href="{{ route('resource', $post->slug) }}">{{ $post->title }}</a>
                        <div class="visible-for-small-down">
                            <a href="{{ route('post.edit', $post->slug) }}" title="Edit"><i class="fa fa-pencil"></i></a>
                            {{--{{ Form::csrfLink('<i class="fa fa-remove"></i>', ['route' => ['post.unpublish', $post->getSlug()], 'method' => 'patch', 'title' => 'Un Publish']) }}--}}
                            {{--{{ Form::csrfLink('<i class="fa fa-trash"></i>', ['route' => ['post.delete', $post->getSlug()], 'method' => 'delete', 'title' => 'Delete']) }}--}}
                        </div>
                    </td>
                    <td class="hidden-for-small-down">{{ $post->published_at ? $post->published_at->format('F jS, Y') : 'Unknown' }}</td>
                    <td class="hidden-for-small-down">
                        <a href="{{ route('post.edit', $post->slug) }}" title="Edit"><i class="fa fa-pencil"></i></a>
                        @include('partials.delete-link', ['url' => route('post.destroy', $post->slug)])
                    </td>
                </tr>
            @endforeach

            @if($pending->count())
                <tfoot>
                    <tr>
                        {{--<td colspan="4" class="text-right"><a href="{{ route('admin.unpublished') }}">See All</a></td>--}}
                    </tr>
                </tfoot>
            @endif
        </table>
    @endif

    <table class="columns large-12">
        <thead>
        <tr>
            <th>Title</th>
            <th class="hidden-for-small-down" style="min-width:145px;">Publish Date</th>
            <th class="hidden-for-small-down" style="min-width:85px;">Actions</th>
        </tr>
        </thead>
        @foreach($published as $post)
            <tr>
                <td>
                    <a href="{{ route('resource', $post->slug) }}">{{ $post->title }}</a>
                    <div class="visible-for-small-down">
                        <a href="{{ route('post.edit', $post->slug) }}" title="Edit" class="label round"><i class="fa fa-pencil"></i></a>
                        @include('partials.delete-link', ['url' => route('post.destroy', $post->slug)])
                    </div>
                </td>
                <td class="hidden-for-small-down">{{ $post->published_at->format('F jS, Y')}}</td>
                <td class="hidden-for-small-down">
                    <a href="{{ route('post.edit', $post->slug) }}" title="Edit" class="label round"><i class="fa fa-pencil"></i></a>
                    @include('partials.delete-link', ['url' => route('post.destroy', $post->slug)])
                </td>
            </tr>
        @endforeach
        <tfoot>
        <tr>
            <td colspan="4" class="hidden-for-small-down">
                {!! $published->render() !!}
            </td>
        </tr>
        </tfoot>
    </table>

    {{--<div class="visible-for-small-down">--}}
        {{--@include('pagination.simple', compact('pagination'))--}}
    {{--</div>--}}
@stop

@section('footer') @stop
