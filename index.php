<?php

require __DIR__ . '/vendor/autoload.php';

try {
    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/src/routes.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        throw new \Gamer\Exceptions\NotFoundException();
    }

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName;
    $controller->$actionName(...$matches);
} catch (\Gamer\Exceptions\DbException $e) {
    $view = new \Gamer\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
} catch (\Gamer\Exceptions\NotFoundException $e) {
    $view = new \Gamer\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
} catch (\Gamer\Exceptions\ActivationException $e) {
    $view = new \Gamer\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('ActivationError.php', ['error' => $e->getMessage()], 500);
}  catch (\Gamer\Exceptions\UnauthorizedException $e) {
    $view = new \Gamer\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('401.php', ['error' => $e->getMessage()], 401);
}  catch (\Gamer\Exceptions\Forbidden $e) {
    $view = new \Gamer\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('403.php', ['error' => $e->getMessage()], 403);
}