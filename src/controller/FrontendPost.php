<?php
namespace src\controller;

use src\manager\PostManager;

class FrontendPost
{
    public function listPosts ()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();

        require('./view/post/postList.php');
    }

    public function post ()
    {
        $postManager = new PostManager();
        $post = $postManager->getPost($_GET['id']);

        require('./view/post/postView.php');
    }
}