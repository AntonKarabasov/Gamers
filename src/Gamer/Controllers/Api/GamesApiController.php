<?php

namespace Gamer\Controllers\Api;

use Gamer\Controllers\AbstractController;
use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Exceptions\NotFoundException;
use Gamer\Models\Games\Game;
use Gamer\Models\News\News;
use Gamer\Models\Users\User;


class GamesApiController extends AbstractController
{
    public function view(int $gameId)
    {
        $game = Game::getById($gameId);

        if ($game === null) {
            throw new NotFoundException();
        }

        $this->view->displayJson([
          'game' => [$game]
        ]);
    }

    public function add()
    {
        $input = $this->getInputData();
        $gameFromRequest = $input['game'][0];

        try {
            $game = Game::createFromArray($gameFromRequest);
        } catch (InvalidArgumentException $e) {
            $this->view->renderHtml('news/add.php', ['error' => $e->getMessage()]);
            return;
        }

        header('Location: /api/games/' . $game->getId(), true, 302);
    }
}