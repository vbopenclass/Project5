<?php

namespace src\manager;

use src\model\Post;

/**
 * Class PostManager with sql requests related to posts
 * @package src\manager
 */
class PostManager extends Manager
{
    /**
     * @return array|mixed
     */
    public function getPosts()
    {
        $posts = $this->prepareObject('SELECT * FROM post order by created_date DESC', Post::class, true);
        $userManager = new UserManager();
        $categoryManager = new CategoryManager();

        foreach ($posts as $post)
        {
            $post->setCreatedBy($userManager->getPostUser($post->getCreatedBy()));
            $post->setCategories($categoryManager->getCategories($post->getId()));
        }

        return $posts;
    }

    /**
     * @param $postId
     * @return array|mixed
     */
    public function getPost( $postId)
    {
        $post = $this->prepareObject('SELECT * FROM post WHERE id = ' . $postId, Post::class, false);

        if($post == true) {

            $userManager = new UserManager();
            $post->setCreatedBy($userManager->getPostUser($post->getCreatedBy()));

            $categoryManager = new CategoryManager();
            $post->setCategories($categoryManager->getCategories($postId));

            $commentManager = new CommentManager();
            $post->setComments($commentManager->getComments($postId));
        }
            return $post;
    }

    /**
     * @param $postId
     * @param $title
     * @param $text
     * @param $chapo
     * @return array|mixed
     */
    public function modifyPost( $postId, $title, $text, $chapo)
    {
        $this->prepareStmt('UPDATE post SET title = "' . $title . '", text = "' . $text .'", chapo = "' . $chapo . '", updated_date = current_timestamp WHERE id=' . $postId);
        return $this->getPost($postId);
    }

    /**
     * @param $author
     * @param $title
     * @param $text
     * @param $chapo
     * @param $fileName
     * @param $imgFolder
     * @return array|mixed
     */
    public function addPost( $author, $title, $text, $chapo, $fileName, $imgFolder)
    {
        $this->prepareStmt('INSERT INTO post (created_by, title, text, chapo, file_name, file_url) VALUES ("'. $author . '", "'. $title . '", "'. $chapo . '", "'. $text . '", "' . $fileName . '", "' . $imgFolder . '")');
        return $this->prepareObject('SELECT * FROM post ORDER BY id DESC LIMIT 1', Post::class, false);
    }

    /**
     * @param $categoryId
     * @param $postId
     * @return array|mixed
     */
    public function linkPostToCategory( $categoryId, $postId)
    {
        $this->prepareStmt('INSERT INTO posts_categories (category_id, post_id) values ("'.$categoryId.'", "'.$postId.'")');
        return $this->getPost($postId);
    }

    /**
     * @param $postId
     */
    public function deletePost( $postId)
    {
        return $this->prepareStmt('DELETE FROM post WHERE id=' . $postId);
    }

    /**
     * @param $postId
     */
    public function unlinkPostToCategory( $postId)
    {
        $this->prepareStmt('DELETE FROM posts_categories WHERE post_id=' . $postId);
    }

    /**
     * @param $postId
     * @param $fileName
     * @param $imgFolder
     * @return array|mixed
     */
    public function addFile( $postId, $fileName, $imgFolder){
        $this->prepareStmt('UPDATE post SET file_name = "' . $fileName . '", file_url = "' . $imgFolder .'" WHERE id=' . $postId);
        return $this->getPost($postId);
    }
}
