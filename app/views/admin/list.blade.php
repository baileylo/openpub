@extends('layouts.full')

@section('title')Admin &mdash; {{ $site->getTitle() }} @stop

@section('content')
    @if ($unpublishedPosts->count())
    <table class="columns large-12">
        <thead>
            <tr>
                <th>Title</th>
                <th class="hidden-for-small-down" style="min-width:145px;">Publish Date</th>
                <th class="hidden-for-small-down" style="min-width:85px;">Actions</th>
            </tr>
        </thead>

        @foreach($unpublishedPosts as $post)
            <tr>
                <td>
                    {{ $post->getTitle() }}
                    <div class="visible-for-small-down">
                        <a href="{{ route('post.permalink', [$post->getSlug()]) }}" title="View"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('post.edit', [$post->getSlug()]) }}" title="Edit"><i class="fa fa-pencil"></i></a>
                        {{ Form::csrfLink('<i class="fa fa-remove"></i>', ['route' => ['admin.post.unpublish', $post->getSlug()], 'method' => 'patch', 'title' => 'Un Publish']) }}
                        {{ Form::csrfLink('<i class="fa fa-trash"></i>', ['route' => ['post.delete', $post->getSlug()], 'method' => 'delete', 'title' => 'Delete']) }}
                    </div>
                </td>
                <td class="hidden-for-small-down">{{ $post->getPublishDate() ? $post->getPublishDate()->format('F jS, Y') : 'Unknown' }}</td>
                <td class="hidden-for-small-down">
                    <a href="{{ route('post.permalink', [$post->getSlug()]) }}" title="Preview"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('post.edit', [$post->getSlug()]) }}" title="Edit"><i class="fa fa-pencil"></i></a>
                    {{ Form::csrfLink('<i class="fa fa-paper-plane-o"></i>', ['route' => ['admin.post.publish', $post->getSlug()], 'method' => 'patch', 'title' => 'Publish']) }}
                    {{ Form::csrfLink('<i class="fa fa-trash"></i>', ['route' => ['post.delete', $post->getSlug()], 'method' => 'delete', 'title' => 'Delete']) }}
                </td>
            </tr>
        @endforeach

        @if($unpublishedPosts->count())
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right"><a href="{{ route('admin.unpublished') }}">See All</a></td>
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
        @foreach($publishedPosts as $post)
            <tr>
                <td>
                    {{ $post->getTitle() }}
                    <div class="visible-for-small-down">
                        <a href="{{ route('post.permalink', [$post->getSlug()]) }}" title="View"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('post.edit', [$post->getSlug()]) }}" title="Edit"><i class="fa fa-pencil"></i></a>
                        {{ Form::csrfLink('<i class="fa fa-remove"></i>', ['route' => ['admin.post.unpublish', $post->getSlug()], 'method' => 'patch', 'title' => 'Un Publish']) }}
                        {{ Form::csrfLink('<i class="fa fa-trash"></i>', ['route' => ['post.delete', $post->getSlug()], 'method' => 'delete', 'title' => 'Delete']) }}
                    </div>
                </td>
                <td class="hidden-for-small-down">{{ $post->getPublishDate()->format('F jS, Y')}}</td>
                <td class="hidden-for-small-down">

                    <a href="{{ route('post.permalink', [$post->getSlug()]) }}" title="View"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('post.edit', [$post->getSlug()]) }}" title="Edit"><i class="fa fa-pencil"></i></a>
                    {{ Form::csrfLink('<i class="fa fa-remove"></i>', ['route' => ['admin.post.unpublish', $post->getSlug()], 'method' => 'patch', 'title' => 'Un Publish']) }}
                    {{ Form::csrfLink('<i class="fa fa-trash"></i>', ['route' => ['post.delete', $post->getSlug()], 'method' => 'delete', 'title' => 'Delete']) }}
                </td>
            </tr>
        @endforeach
        <tfoot>
            <tr>
                <td colspan="4" class="hidden-for-small-down">{{ $pagination->links('pagination.zurb-full') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="visible-for-small-down">
        {{ $pagination->links('pagination.zurb-simple') }}
    </div>
@stop
