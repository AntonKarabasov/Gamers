<?php

namespace Gamer\Controllers;

use Gamer\Models\Users\User;
use Gamer\Models\Users\UsersAuthService;
use Gamer\Models\Games\Game;
use Gamer\Models\News\News;
use Gamer\View\View;


class MainController extends AbstractController
{
    public function main()
    {
        $newGames = Game::findLimitAndOrder(4, 'year');

        $news = News::findLimitAndOrder(2, 'created_at');

        $this->view->renderHtml('main/main.php', [
          'newGames' => $newGames,
          'news' => $news
          ]);
    }
}