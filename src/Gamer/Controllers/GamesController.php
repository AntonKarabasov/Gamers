<?php

namespace Gamer\Controllers;

use Gamer\Exceptions\Forbidden;
use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Exceptions\NotFoundException;
use Gamer\Exceptions\UnauthorizedException;
use Gamer\Models\Games\Game;
use Gamer\Models\Genres\Genre;
use Gamer\Models\Platforms\Platform;
use Gamer\Models\Reviews\Review;


class GamesController extends AbstractController
{

    public function view(int $gameId)
    {
        $result = Game::getById($gameId);
        $reviews = Review::findByColumn('game_id', $gameId);

        if ($result === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('games/view.php', [
          'game' => $result,
          'reviews'=> $reviews,
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames
        ], $result->getName());
    }

    public function viewByGenre(string $genreName)
    {
        $genre= Genre::getByName($genreName);

        $games = Game::getObjectByForeignKeys('game',
          'genres', $genre->getId(), 'genres');;


        $sortedGames = $this->selectionSortByColumn($games, 'getRating');

        if ($games === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('games/rating.php', [
          'ratingGames' => $sortedGames,
          'platformsName' => $genreName,
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames
        ], ucfirst($genreName));
    }

    public function viewByPlatforms(string $platformsName)
    {
        $platformsNames = Platform::getIdPlatformsByCompany($platformsName);
        $platforms = [];
        foreach ($platformsNames as $platformName) {
            $platforms[] = Platform::getByName($platformName);
        }

        $games = [];
        foreach ($platforms as $platform) {
            $gamesByOnePlatform = Game::getObjectByForeignKeys('game',
              'platforms', $platform->getId(), 'platforms');
            foreach ($gamesByOnePlatform as $game) {
                if (in_array($game, $games)) {
                    continue;
                }
                $games[] = $game;
            }
        }


        $sortedGames = $this->selectionSortByColumn($games, 'getRating');

        if ($games === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('games/rating.php', [
          'ratingGames' => $sortedGames,
          'platformsName' => $platformsName,
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames
        ], ucfirst($platformsName));
    }

    public function viewByYear(string $year)
    {
        $games = Game::findByColumn('year', $year);

        if ($games === null) {
            throw new NotFoundException();
        }

        $sortedGames = $this->selectionSortByColumn($games, 'getRating');


        $this->view->renderHtml('games/rating.php', [
          'ratingGames' => $sortedGames,
          'platformsName' => $year,
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames
        ], $year);
    }

    public function rating()
    {
        $ratingGames = Game::findAllOrder('rating');

        if ($ratingGames === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('games/rating.php', [
          'ratingGames' => $ratingGames,
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames
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

        $this->view->renderHtml('games/add.php', [
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames
        ], 'Добавление новой игры');
    }

    public function search() {
        if (!empty($_POST['query'])) {
            try {
                $result = Game::searchGames($_POST['query']);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('games/search.php', ['error' => $e->getMessage(), 'query'=> $_POST['query']]);
                return;
            }
            $this->view->renderHtml('games/search.php', ['foundGames' => $result, 'query'=> $_POST['query'], 'topGames' => $this->topGames], 'Результаты поиска');
            exit();
        }

        $this->view->renderHtml('games/search.php', [
          'error' => 'Пустой поисковой запрос',
          'shortNews' => $this->shortNews,
          'topGames' => $this->topGames], 'Результаты поиска');
    }

    public function delete(int $gameId)
    {
        $game = Game::getById($gameId);

        if ($game === null) {
            throw new NotFoundException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Вы не можете удалять игры');
        }

        $game->delete();

        $games = Game::findAll();

        if ($games === null) {
            throw new NotFoundException();
        }

        header('Location: /admin/games', true, 302);
    }
}