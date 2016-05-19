<meta name="description" content="{{ $article->description }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ route('resource', $article->slug) }}" />
<meta property="og:title" content="{{ $article->title }}" />
<meta property="og:description" content="{{ $article->description }}" />
@foreach ($article->categories as $category)
<meta property="og:article:tag" content="{{ $category->name }}" />
@endforeach