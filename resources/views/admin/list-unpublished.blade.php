@extends('layouts.full')
@section('footer') @stop
@section('content')
    <table class="columns large-12">
        <thead>
        <tr>
            <th>Title</th>
            <th>Publish Date</th>
            <th>Actions</th>
        </tr>
        </thead>

        @foreach($posts as $post)
            <tr>
                <td>{{ $post->getTitle() }}</td>
                <td>{{ $post->getPublishDate() ? $post->getPublishDate()->format('F jS, Y') : 'Unknown' }}</td>
                <td>
                    <a href="#" title="Preview"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('post.edit', [$post->getSlug()]) }}" title="Edit"><i class="fa fa-pencil"></i></a>
                    {!! Form::csrfLink('<i class="fa fa-paper-plane-o"></i>', ['route' => ['post.publish', $post->getSlug()], 'method' => 'patch', 'title' => 'Publish']) !!}
                    {!! Form::csrfLink('<i class="fa fa-trash"></i>', ['route' => ['post.delete', $post->getSlug()], 'method' => 'delete', 'title' => 'Delete']) !!}
                </td>
            </tr>
        @endforeach

        <tfoot>
            <tr>
                <td colspan="3" class="hidden-for-small-down">{!! $pagination->render() !!}</td>
            </tr>
        </tfoot>
    </table>
@stop