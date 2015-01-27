<?php

namespace Baileylo\Blog\Page;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\Cursor;


class PageRepository
{
    /** @var DocumentRepository */
    protected $repository;

    public function __construct(DocumentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Page $page  Page to save
     * @param Bool $flush Automatically flush the changes to the persistent store
     *
     * @return void
     */
    public function save(Page $page, $flush = true)
    {
        $dm = $this->repository->getDocumentManager();
        $dm->persist($page);

        if ($flush) {
            $dm->flush($page);
        }
    }

    /**
     * Deletes a page from the remote datastore.
     *
     * @param Page $page  Page to delete
     * @param Bool $flush Automatically flush the changes to the persistent store
     */
    public function delete(Page $page, $flush = true)
    {
        $dm = $this->repository->getDocumentManager();
        $dm->remove($page);

        if ($flush) {
            $dm->flush();
        }
    }

    /**
     * Find a given page by its slug.
     *
     * @param String $slug Unique URL safe identifier
     * @param Bool $onlyVisible Whether to only return publicy visible slugs
     *
     * @return Page|null
     */
    public function findBySlug($slug, $onlyVisible)
    {
        $queryBuilder = $this->repository->createQueryBuilder()
            ->field('slug')->equals($slug);

        if ($onlyVisible) {
            $queryBuilder->field('isVisible')->equals(true);
        }

        return $queryBuilder->getQuery()->execute()->getSingleResult();
    }

    /**
     * A list pages.
     *
     * @param int $pageSize Number of pages to return
     * @param int $skip     Number of pages to skip
     *
     * @return Page[]|Cursor
     */
    public function listPages($pageSize, $skip, $orderColumn = 'createdAt')
    {
        return $this->repository->createQueryBuilder()
            ->limit($pageSize)
            ->skip($skip)
            ->sort($orderColumn, -1)
            ->getQuery()
            ->execute();
    }
}
