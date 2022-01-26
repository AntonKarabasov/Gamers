<?php

namespace Gamer\Controllers;

use Gamer\Models\Games\Game;
use Gamer\Models\Platforms\Platform;
use Gamer\View\View;
use Gamer\Models\Users\User;
use Gamer\Models\Users\UsersAuthService;

class PlatformsController extends AbstractController
{
    protected function findBiggest(array $array, string $method): int
    {
        $biggest = $array[0];
        $biggestIndex = 0;

        for ($i = 1; $i < count($array); $i++) {
            if ($biggest->$method() < $array[$i]->$method()) {
                $biggest = $array[$i];
                $biggestIndex = $i;
            }
        }

        return $biggestIndex;
    }

    public  function selectionSortByColumn(array $array, string $method): array
    {
        $sortedArray = [];
        $sizeArray = count($array);

        for ($i = 0; $i < $sizeArray; $i++) {
            $biggestIndex = $this->findBiggest($array, $method);
            $sortedArray[] = $array[$biggestIndex];
            array_splice($array, $biggestIndex, 1);
        }

        return $sortedArray;
    }

    public function view(string $platformsName)
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
            $this->view->renderHtml('errors/404.php',
              ['topGames' => Game::findLimitAndOrder(10, 'rating')], '', 404);
            return;
        }

        $this->view->renderHtml('games/rating.php', [
          'ratingGames' => $sortedGames
        ], ucfirst($platformsName));
    }
}