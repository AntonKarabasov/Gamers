<?php

namespace Gamer\Controllers;

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
        $author = User::getById(1);

        $news = new News();
        $news->setAuthor($author);
        $news->setName('Новая статья');
        $news->setText('Текст новой статьи');

        $news->save();
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
