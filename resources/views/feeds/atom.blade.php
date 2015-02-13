{!! '<'.'?'.'xml version="1.0" encoding="UTF-8"?>' !!}
<feed
    xmlns="http://www.w3.org/2005/Atom"
    xmlns:thr="http://purl.org/syndication/thread/1.0"
    xml:lang="en-US"
    xml:base="http://www.logansbailey.com/wp-atom.php"
    >

    <title type="text">{{ $site->getTitle() }}</title>
    <subtitle type="text">{{ $site->getSubhead() }}</subtitle>
    <link rel="alternate" type="text/html" href="{{ route('home') }}" />
    <id>{{ route('feed.atom') }}</id>
    <link rel="self" type="application/atom+xml" href="{{ route('feed.atom') }}" />
    <updated>{{ $site->getFeedLastModified()->format(\DateTime::ATOM) }}</updated>

    @foreach($posts as $post)
        <entry>
            <author>
                <name>Logan Bailey</name>
                <uri>http://www.logansbailey.com</uri>
            </author>
            <title type="html"><![CDATA[{{ $post->getTitle() }}]]></title>
            <link rel="alternate" type="text/html" href="{{ route('post.permalink', [$post->getPublishDate()->format('Y/m/d'), $post->getSlug()]) }}" />
            <id>{{ route('post.permalink', [$post->getPublishDate()->format('Y/m/d'), $post->getSlug()]) }}</id>
            <updated>{{ $post->getPublishDate()->format(\DateTime::ATOM) }}</updated>
            <published>{{ $post->getPublishDate()->format(\DateTime::ATOM) }}</published>
            <summary type="html"><![CDATA[{{ $post->getDescription() }}]]></summary>
            <content type="html" xml:base="{{ route('post.permalink', [$post->getPublishDate()->format('Y/m/d'), $post->getSlug()]) }}">
                <![CDATA[{!! $post->getHtml() !!}]]>
            </content>
        </entry>
    @endforeach

</feed>
