<?php

return [
  '~^games/(\d+)$~' => [\Gamer\Controllers\GamesController::class, 'view'],
  '~^games/rating$~' => [\Gamer\Controllers\GamesController::class, 'rating'],
  '~^games/add$~' => [\Gamer\Controllers\GamesController::class, 'add'],
  '~^news$~' => [\Gamer\Controllers\NewsController::class, 'viewAll'],
  '~^news/(\d+)$~' => [\Gamer\Controllers\NewsController::class, 'view'],
  '~^news/(\d+)/edit$~' => [\Gamer\Controllers\NewsController::class, 'edit'],
  '~^news/add$~' => [\Gamer\Controllers\NewsController::class, 'add'],
  '~^news/(\d+)/delete$~' => [\Gamer\Controllers\NewsController::class, 'delete'],
  '~^users/register$~' => [\Gamer\Controllers\UsersController::class, 'signUp'],
  '~^users/login$~' => [\Gamer\Controllers\UsersController::class, 'login'],
  '~^users/logout$~' => [\Gamer\Controllers\UsersController::class, 'logout'],
  '~^platforms/(.+)$~' => [\Gamer\Controllers\PlatformsController::class, 'view'],
  '~^users/(\d+)/activate/(.+)$~' => [\Gamer\Controllers\UsersController::class, 'activate'],
  '~^$~' => [\Gamer\Controllers\MainController::class, 'main'],
];