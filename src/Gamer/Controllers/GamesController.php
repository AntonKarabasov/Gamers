<?php

namespace Gamer\Controllers;

use Gamer\Exceptions\NotFoundException;
use Gamer\Models\Games\Game;
use Gamer\View\View;
use Gamer\Models\Users\User;
use Gamer\Models\Users\UsersAuthService;

class GamesController extends AbstractController
{

    public function view(int $gameId)
    {
        $result = Game::getById($gameId);

        if ($result === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('games/view.php', [
          'game' => $result
        ], $result->getName());
    }

    public function rating()
    {
        $ratingGames = Game::findAllOrder('rating');

        if ($ratingGames === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('games/rating.php', [
          'ratingGames' => $ratingGames
        ], 'Рейтинг игр');
    }

}