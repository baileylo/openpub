<meta name="description" content="{{ $article->description }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ route('resource', $article->slug) }}" />
<meta property="og:title" content="{{ $article->title }}" />
<meta property="og:description" content="{{ $article->description }}" />

@foreach ($article->categories as $category)
<meta property="article:tag" content="{{ $category->name }}" />
@endforeach

@if ($article->published_at)
    <meta property="article:published_at" content="{{ $article->published_at->format(\DateTime::ISO8601) }}" />
@endif