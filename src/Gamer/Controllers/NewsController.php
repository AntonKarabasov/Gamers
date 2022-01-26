<?php

namespace Gamer\Controllers;

use Gamer\Exceptions\Forbidden;
use Gamer\Exceptions\UnauthorizedException;
use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Exceptions\NotFoundException;
use Gamer\Models\Games\Game;
use Gamer\Models\News\News;
use Gamer\Models\Users\User;
use Gamer\Models\Users\UsersAuthService;
use Gamer\View\View;

class NewsController extends AbstractController
{
    public function view(int $newsId)
    {
        /** @var News $news */
        $news = News::getById($newsId);

        if ($news === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('news/view.php', [
          'news' => $news
        ], $news->getName());
    }

    public function viewAll()
    {
        $news = News::findAllOrder('created_at');

        if ($news === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('news/news.php', [
          'news' => $news
        ], 'Новости');
    }

    public function edit(int $newsId)
    {
        /** @var News $news */
        $news = News::getById($newsId);

        if ($news === []) {
            throw new NotFoundException();
        }

        $news->setName('Новое название новости');
        $news->setText('Новый текст новости');

        $news->save();
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
                $news = News::createFromArray($_POST, $_FILES, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('news/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /news/' . $news->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('news/add.php');
    }

    public function delete($newsId)
    {
        /** @var News $news */
        $news = News::getById($newsId);

        if ($news === null) {
            throw new NotFoundException();
        }

        $news->delete();
        $this->view->renderHtml('news/delete.php', ['topGames' => Game::findLimitAndOrder(10, 'rating')], 'Страница удалена');
    }
}
