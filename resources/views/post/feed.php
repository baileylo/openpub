<?= '<?xml version="1.0" encoding="UTF-8" ?>' . PHP_EOL ?>
<feed
    xmlns="http://www.w3.org/2005/Atom"
    xmlns:thr="http://purl.org/syndication/thread/1.0"
    xml:lang="en-US"
    xml:base="http://www.logansbailey.com"
>

    <title type="text">Logan Bailey</title>
    <subtitle type="text">Adventures in web development</subtitle>
    <link rel="alternate" type="text/html" href="<?= route('home') ?>" />
    <id><?= route('feed') ?></id>
    <link rel="self" type="application/atom+xml" href="<?= route('feed') ?>" />
    <updated>{{ $last_updated->format(\DateTime::ATOM) }}</updated>


    <?php foreach ($posts as $post): ?>
        <?php $post_url = route('resource', $post->slug); ?>
        <entry>
            <author>
                <name>Logan Bailey</name>
                <uri>http://www.logansbailey.com</uri>
            </author>
            <title type="html"><![CDATA[<?= $post->title ?>]]></title>

            <link rel="alternate" type="text/html" href="<?= $post_url ?>" />
            <id><?= $post_url ?></id>
            <?php if ($post->updated_at): ?>
            <updated><?= $post->updated_at->format(\DateTime::ATOM) ?></updated>
            <?php endif; ?>
            <published><?= $post->published_at->format(\DateTime::ATOM) ?></published>
            <summary type="html"><![CDATA[<?= $post->description ?>]]></summary>
            <content type="html" xml:base="<?= $post_url ?>">
                <![CDATA[<?= $post->html ?>]]>
            </content>
        </entry>
    <?php endforeach; ?>

</feed>