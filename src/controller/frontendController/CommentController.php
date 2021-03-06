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
    public function submitComment($postId)
    {
        $input = new Input();

        if ($input->post('commentAuthor') && $input->post('commentText') && $input->post('postId'))
        {
            $commentAuthor = htmlspecialchars($input->post('commentAuthor'));
            $commentText = htmlspecialchars($input->post('commentText'));
            $postId = htmlspecialchars($input->post('postId'));
        }

        $commentManager = new CommentManager();
        $newComment = $commentManager->submitComment($commentText, $commentAuthor, $postId);

        return $newComment;
    }
}
