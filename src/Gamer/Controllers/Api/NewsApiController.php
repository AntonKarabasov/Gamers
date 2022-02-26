<?php

namespace Gamer\Controllers\Api;

use Gamer\Controllers\AbstractController;
use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Exceptions\NotFoundException;
use Gamer\Models\News\News;
use Gamer\Models\Users\User;

class NewsApiController extends AbstractController
{
    public function view(int $newsId)
    {
        $news = News::getById($newsId);

        if ($news === null) {
            throw new NotFoundException();
        }

        $this->view->displayJson([
            'news' => [$news]
        ]);
    }

    public function add()
    {
        $input = $this->getInputData();
        $newsFromRequest = $input['news'][0];

        $authorId = $newsFromRequest['author_id'];
        $author = User::getById($authorId);

        try {
            $news = News::createFromArray($newsFromRequest, $author);
        } catch (InvalidArgumentException $e) {
            $this->view->renderHtml('news/add.php', ['error' => $e->getMessage()]);
            return;
        }

        header('Location: /api/news/' . $news->getId(), true, 302);
    }
}