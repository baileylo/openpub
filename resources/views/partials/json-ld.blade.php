<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "BlogPosting",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ route('resource', $article) }}"
  },
  "headline": "{{ $article->title }}",
  @if ($article->published_at)
      {{--This can happen when an admin views an unpublished post--}}
    "datePublished": "{{ $article->published_at->format(\DateTime::W3C) }}",
  @endif
  @if ($article->updated_at)
    "dateModified": "{{ $article->updated_at->format(\DateTime::W3C) }}",

  @endif
  "author": {
    "@type": "Person",
    "name": "Logan Bailey"
  },
  "description": "{{ $article->description }}"
}
</script>