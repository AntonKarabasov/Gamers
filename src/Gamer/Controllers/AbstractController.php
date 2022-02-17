<?php

namespace Gamer\Controllers;

use Gamer\Models\Games\Game;
use Gamer\Models\ShortNews\ShortNews;
use Gamer\Models\Users\User;
use Gamer\Models\Users\UsersAuthService;
use Gamer\View\View;

abstract class AbstractController
{

    /** @var View */
    protected $view;

    /** @var User|null */
    protected $user;

    /** @var array */
    protected $topGames;

    /** @var array */
    protected $shortNews;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);
        $this->topGames = Game::findLimitAndOrder(10, 'rating');
        $this->shortNews = ShortNews::findLimitAndOrder(5, 'created_at');
    }

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
}