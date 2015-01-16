<?php

namespace Baileylo\Blog\Post\Repository;

use Baileylo\Blog\Post\Cursor;
use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\PostRepository;
use Carbon\Carbon;
use Doctrine\ODM\MongoDB\DocumentRepository;

class DoctrineODM implements PostRepository
{
    /** @var DocumentRepository */
    protected $repository;

    public function __construct(DocumentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Post $post  Post to save
     * @param Bool $flush Automatically flush the changes to the persistent store
     *
     * @return void
     */
    public function save(Post $post, $flush = true)
    {
        $dm = $this->repository->getDocumentManager();
        $dm->persist($post);

        if ($flush) {
            $dm->flush($post);
        }
    }

    /**
     * Deletes a post from the remote datastore.
     *
     * @param Post $post  Post to delete
     * @param Bool $flush Automatically flush the changes to the persistent store
     */
    public function delete(Post $post, $flush = true)
    {
        $dm = $this->repository->getDocumentManager();
        $dm->remove($post);

        if ($flush) {
            $dm->flush();
        }
    }


    /**
     * @param String $slug URL Slug
     *
     * @return Post|null
     */
    public function findUnpublishedArticle($slug)
    {
        return $this->repository->createQueryBuilder()
            ->field('slug')->equals($slug)
            ->field('publishDate')->exists(false)
            ->limit(1)
            ->getQuery()->execute()->getSingleResult();
    }

    /**
     * @param String $slug URL Slug
     *
     * @return Post|null
     */
    public function findBySlug($slug)
    {
        return $this->repository->createQueryBuilder()
            ->field('slug')->equals($slug)
            ->limit(1)
            ->getQuery()->execute()->getSingleResult();
    }

    /**
     * @param  String            $slug     URL slug
     * @param \DateTimeInterface $dateTime Date of publication
     *
     * @return mixed
     */
    public function findPublishedArticle($slug, \DateTimeInterface $dateTime)
    {
        return $this->repository->createQueryBuilder()
            ->field('slug')->equals($slug)
            ->field('publishDate')->lte(new \DateTime('now'))
            ->limit(1)
            ->getQuery()->getSingleResult();
    }

    /**
     * A list of recently published posts.
     *
     * @param int $pageSize Number of posts to return
     * @param int $skip     Number of posts to skip
     *
     * @return \Baileylo\Blog\Post\Post[]|Cursor
     */
    public function findRecentPosts($pageSize, $skip)
    {
        return $this->repository->createQueryBuilder()
            ->field('publishDate')->lte(new \DateTime('now'))
            ->limit($pageSize)
            ->skip($skip)
            ->sort('publishDate', -1)
            ->getQuery()
            ->execute();
    }

    /**
     * A list of recently published posts.
     *
     * @param string $categorySlug
     * @param int    $pageSize Number of posts to return
     * @param int    $skip     Number of posts to skip
     *
     * @return Post[]|Cursor
     */
    public function findRecentPostsByCategory($categorySlug, $pageSize, $skip)
    {
        return $this->repository->createQueryBuilder()
            ->field('publishDate')->lte(new \DateTime('now'))
            ->field('categories.slug')->equals($categorySlug)
            ->limit($pageSize)
            ->skip($skip)
            ->sort('publishDate', -1)
            ->getQuery()
            ->execute();
    }


    /**
     * Find all pips irregardless of their publish state
     *
     * @param int $pageSize
     * @param int $skip
     *
     * @return \Baileylo\Blog\Post\Post[]
     */
    public function findUnpublishedPosts($pageSize, $skip)
    {
        $qb = $this->repository->createQueryBuilder();

        return $qb->addOr($qb->expr()->field('publishDate')->exists(false))
            ->addOr($qb->expr()->field('publishDate')->gte(new \DateTime('now')))
            ->sort('publishDate', -1)
            ->limit($pageSize)
            ->skip($skip)
            ->getQuery()
            ->execute();
    }

    /**
     * @param bool $excludeUnpublished
     *
     * @return \DateTime|Null
     */
    public function getLastUpdatedDate($excludeUnpublished = true)
    {
        $query = $this->repository->createQueryBuilder();

        if ($excludeUnpublished) {
            $query->field('publishDate')->lte(new \DateTime('now'));
        }

        return $query->getQuery()->getSingleResult()->getUpdatedAt();
    }
}
