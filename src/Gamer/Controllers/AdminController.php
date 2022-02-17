<?php

namespace Gamer\Controllers;

use Gamer\Exceptions\Forbidden;
use Gamer\Exceptions\NotFoundException;
use Gamer\Exceptions\UnauthorizedException;
use Gamer\Models\Games\Game;
use Gamer\Models\News\News;
use Gamer\Models\ShortNews\ShortNews;

class AdminController extends AbstractController
{
    public function admin()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для доступа нужно обладать правами администратора');
        }

        $this->view->renderHtml('admin/adminPanel.php', [
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames
        ]);
    }

    public function games()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для доступа нужно обладать правами администратора');
        }

        $games = Game::findAll();

        if ($games === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('admin/games.php', [
          'games' => $games,
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames
        ], 'Админка игры');
    }

    public function news()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для доступа нужно обладать правами администратора');
        }

        $news = News::findAll();

        if ($news === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('admin/news.php', [
          'news' => $news,
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames
        ], 'Админка новости');
    }

    public function shortNews()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для доступа нужно обладать правами администратора');
        }

        $shortNews = ShortNews::findAll();

        if ($shortNews === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('admin/shortNews.php', [
          'shortNews' => $shortNews,
          'topGames' => $this->topGames,
        ], 'Админка быстрые новости');
    }
}