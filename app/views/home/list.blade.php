@extends('layouts.full')

@section('content')
    @foreach($posts as $post)
        <article class="list-article">
            <h3 class="article-header"><a href="{{ route('post.permalink', ['date' => $post->getPublishDate()->format('Y/m/d'), 'postSlug' => $post->getSlug()]) }}">{{{ $post->getTitle() }}}</a></h3>

            <div class="article-content">
                {{ $post->getDescription() }}
            </div>

            <h6 class="subheader article-footer">{{{ $post->getPublishDate()->format('F jS, Y') }}}</h6>
        </article>
    @endforeach

    {{ $pagination->links('pagination.zurb-simple') }}

@stop
