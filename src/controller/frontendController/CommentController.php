<?php

namespace src\controller\frontendController;

use src\controller\Input;
use src\manager\CommentManager;

/**
 * Class CommentController
 * @package src\controller\frontendController
 * To submit a comment in frontend
 */
class CommentController
{
    /**
     * @return array
     * Action after new comment's form submission
     */
    public function submitComment( $postId)
    {
        $input = new Input();

        if (isset($_POST['commentAuthor']) && isset($_POST['commentText']) && isset($_POST['postId']))
        {
            $commentAuthor = $input->post('commentAuthor');
            $commentText = $input->post('commentText');
            $postId = $input->post('postId');
        }

        $commentManager = new CommentManager();
        $newComment = $commentManager->submitComment($commentText, $commentAuthor, $postId);

        return $newComment;
    }
}
