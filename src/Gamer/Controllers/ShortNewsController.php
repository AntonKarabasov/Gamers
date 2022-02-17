<?php

namespace Gamer\Controllers;

use Gamer\Exceptions\Forbidden;
use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Exceptions\NotFoundException;
use Gamer\Exceptions\UnauthorizedException;
use Gamer\Models\ShortNews\ShortNews;


class ShortNewsController extends AbstractController
{
    public function  add()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для добавления новости нужно обладать правами администратора');
        }

        if (!empty($_POST)) {
            try {
                $news = ShortNews::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('shortNews/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /admin/shortNews', true, 302);
            exit();
        }

        $this->view->renderHtml('shortNews/add.php', [
          'topGames' => $this->topGames,
          'shortNews' => $this->shortNews,]);
    }


    public function delete($shortNewsId)
    {
        if (!$this->user->isAdmin()) {
            throw new Forbidden('Вы не можете удалять новости');
        }

        /** @var ShortNews $shortNews */
        $shortNews = ShortNews::getById($shortNewsId);

        if ($shortNews === null) {
            throw new NotFoundException();
        }

        $shortNews->delete();

        header('Location: /admin/shortNews', true, 302);
    }
}