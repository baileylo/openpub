@if($site->getTwitterAccount())
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="{{ $site->getTwitterAccount() }}" />
    <meta name="twitter:title" content="{{ $article->title }}" />
    <meta name="twitter:description" content="{{ $article->description }}" />
@endif