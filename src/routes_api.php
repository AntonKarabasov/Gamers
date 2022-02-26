<?php

return [
  '~^news/(\d+)$~' => [\Gamer\Controllers\Api\NewsApiController::class, 'view'],
  '~^news/add$~' => [\Gamer\Controllers\Api\NewsApiController::class, 'add'],
  '~^games/(\d+)$~' => [\Gamer\Controllers\Api\GamesApiController::class, 'view'],
  '~^games/add$~' => [\Gamer\Controllers\Api\GamesApiController::class, 'add'],
];