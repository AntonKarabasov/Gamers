<?php

namespace Gamer\Controllers;

use Gamer\Exceptions\Forbidden;
use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Exceptions\NotFoundException;
use Gamer\Exceptions\UnauthorizedException;
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

    public function add()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для добавления игр нужно обладать правами администратора');
        }

        if (!empty($_POST)) {
            try {
                $game = Game::createFromArray($_POST, $_FILES);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('games/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /games/' . $game->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('games/add.php', [], 'Добавление новой игры');
    }
}