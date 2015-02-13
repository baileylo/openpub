<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Baileylo\Blog\Category\Category;
use Baileylo\Blog\Post\Post;
use Baileylo\Core\Markdown\Markdown;
use Doctrine\ODM\MongoDB\DocumentManager;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ImportHandler extends Controller
{
    /** @var Request */
    private $request;

    /** @var Redirector */
    private $redirector;

    public function __construct(Request $request, Redirector $redirector)
    {
        $this->request = $request;
        $this->redirector = $redirector;
    }

    public function import()
    {
        $xmlDump = $this->request->file('xml');

        $xml = simplexml_load_file($xmlDump->getPathname(), 'SimpleXMLElement', LIBXML_NOCDATA);

        $dm = app(DocumentManager::class);

        foreach ($xml->xpath('/rss/channel/item') as $result) {
            if (trim(($result->xpath('wp:status')[0])) !== 'publish') {
                continue;
            }

            $post = new Post();

            $post->update(
                trim($result->title),
                trim($result->description),
                (string)(new \HTML_To_Markdown(trim(htmlentities($result->xpath('content:encoded')[0])))),
                app(Markdown::class)
            );

            $post->setSlug(trim(($result->xpath('wp:post_name')[0])));

            foreach((array)$result->category as $index => $category) {
                if (!is_numeric($index)) continue;

                $post->addCategory(new Category($category));
            }

            $post->setUpdatedAt(new \DateTime((string)$result->pubDate));
            $post->publish($post->getUpdatedAt());
            $dm->persist($post);
        }

        $dm->flush();
        return $this->redirector->route('admin');
    }
}
