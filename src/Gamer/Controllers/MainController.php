<?php

namespace Gamer\Controllers;

use Gamer\Models\Games\Game;
use Gamer\Models\News\News;



class MainController extends AbstractController
{
    public function main()
    {
        $newGames = Game::findLimitAndOrder(4, 'year');

        $news = News::findLimitAndOrder(2, 'created_at');

        $this->view->renderHtml('main/main.php', [
          'newGames' => $newGames,
          'topGames' => $this->topGames,
          'news' => $news
          ]);
    }
}