<?php

namespace Gamer\Controllers;

use Gamer\Exceptions\Forbidden;
use Gamer\Exceptions\UnauthorizedException;
use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Exceptions\NotFoundException;
use Gamer\Models\Comments\Comment;
use Gamer\Models\Games\Game;
use Gamer\Models\News\News;


class NewsController extends AbstractController
{
    public function view(int $newsId)
    {
        /** @var News $news */
        $news = News::getById($newsId);

        $comments = Comment::findByColumn('news_id', $newsId);

        if ($news === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('news/view.php', [
          'news' => $news,
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames,
          'comments' => $comments
        ], $news->getName());
    }

    public function viewAll()
    {
        $news = News::findAllOrder('created_at');

        if ($news === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('news/news.php', [
          'news' => $news,
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames
        ], 'Новости');
    }

    public function  add()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для добавления новости нужно обладать правами администратора');
        }

        if (!empty($_POST)) {
            try {
                $news = News::createFromArray($_POST, $this->user, $_FILES);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('news/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /news/' . $news->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('news/add.php', [
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames], 'Добавление новости');
    }

    public function edit(int $newsId)
    {
        /** @var News $news */
        $news = News::getById($newsId);

        if ($news === []) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для редактирования новости нужно обладать правами администратора');
        }

        if (!empty($_POST)) {
            try {
                $news->updateFromArray($_POST, $_FILES);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('news/edit.php',
                  ['error' => $e->getMessage(), 'news' => $news]);
                return;
            }

            header('Location: /news/' . $news->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('news/edit.php', [
          'news' => $news,
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames]);
    }

    public function delete($newsId)
    {
        if (!$this->user->isAdmin()) {
            throw new Forbidden('Вы не можете удалять новости');
        }

        /** @var News $news */
        $news = News::getById($newsId);

        if ($news === null) {
            throw new NotFoundException();
        }

        $news->delete();

        header('Location: /admin/news', true, 302);
    }
}
