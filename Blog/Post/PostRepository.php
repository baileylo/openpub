<?php

namespace Baileylo\Blog\Post;

interface PostRepository
{
    /**
     * @param Post $post  Post to save
     * @param Bool $flush Automatically flush the changes to the persistent store
     *
     * @return void
     */
    public function save(Post $post, $flush = true);

    /**
     * Deletes a post from the remote datastore.
     *
     * @param Post $post  Post to delete
     * @param Bool $flush Automatically flush the changes to the persistent store
     */
    public function delete(Post $post, $flush = true);

    /**
     * A list of recently published posts.
     *
     * @param int $pageSize Number of posts to return
     * @param int $skip   Number of posts to skip
     *
     * @return Post[]
     */
    public function findRecentPosts($pageSize, $skip);

    /**
     * @param String $slug URL Slug
     *
     * @return Post|null
     */
    public function findUnpublishedArticle($slug);

    /**
     * @param String $slug URL Slug
     *
     * @return Post|null
     */
    public function findBySlug($slug);

    /**
     * @param  String            $slug     URL slug
     * @param \DateTimeInterface $dateTime Date of publication
     *
     * @return mixed
     */
    public function findPublishedArticle($slug, \DateTimeInterface $dateTime);

    /**
     * Find all pips irregardless of their publish state
     *
     * @param int $pageSize Number of posts to return
     * @param int $skip   Number of posts to skip
     *
     * @return Post[]
     */
    public function findUnpublishedPosts($pageSize, $skip);

    /**
     * @param bool $excludeUnpublished
     *
     * @return \DateTime|Null
     */
    public function getLastUpdatedDate($excludeUnpublished = true);
} 
