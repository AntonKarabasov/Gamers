<?php

namespace Gamer\Controllers;

use Gamer\Exceptions\Forbidden;
use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Exceptions\NotFoundException;
use Gamer\Exceptions\UnauthorizedException;
use Gamer\Models\Comments\Comment;
use Gamer\Models\News\News;

class CommentsController extends AbstractController
{
    public function add(int $newsId)
    {
        $news = News::getById($newsId);
        $comments = Comment::findByColumn('news_id', $newsId);

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {
                $comment = Comment::createFromArray($_POST, $this->user, $newsId);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('games/view.php', ['error' => $e->getMessage(), 'news' => $news, 'comments'=> $comments]);
                return;
            }

            header('Location: /news/' . $newsId . '#comment' . $comment->getId(), true, 302);
            exit();
        }

       $this->view->renderHtml('news/view.php', ['news' => $news, 'comments'=> $comments]);
    }

    public function delete(int $commentId)
    {
        $comment = Comment::getById($commentId);

        if ($comment === null) {
            throw new NotFoundException();
        }

        if (!$this->user->isAdmin()) {
            if (!$comment->isAuthor($this->user)) {
                throw new Forbidden('Вы можете удалять только свои комментарии');
            }
        }

        $comment->delete();

        $news = News::getById($comment->getNewsId());
        $comments = Comment::findByColumn('news_id', $comment->getNewsId());

        $this->view->renderHtml('news/view.php', ['news' => $news, 'comments'=> $comments]);
    }

    public function edit(int $commentId)
    {
        $editedComment = Comment::getById($commentId);

        if ($editedComment === null) {
            throw new NotFoundException();
        }

        if (!$editedComment->isAuthor($this->user)) {
            throw new Forbidden('Вы можете редактировать только свои комментарии');
        }

        if (!empty($_POST['text'])) {
            $editedComment->setText($_POST['text']);
            $editedComment->save();
            header('Location: /news/' . $editedComment->getNewsId() . '#comment' . $editedComment->getId(), true, 302);
            exit();
        }

        $news = News::getById($editedComment->getNewsId());
        $comments = Comment::findByColumn('news_id', $editedComment->getNewsId());

        $this->view->renderHtml('news/view.php', ['news' => $news, 'comments'=> $comments, 'editedComment' => $editedComment]);
    }
}