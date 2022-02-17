<?php

namespace Gamer\Controllers;

use Gamer\Exceptions\Forbidden;
use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Exceptions\NotFoundException;
use Gamer\Exceptions\UnauthorizedException;

use Gamer\Models\Comments\Comment;
use Gamer\Models\Games\Game;
use Gamer\Models\News\News;
use Gamer\Models\Reviews\Review;


class ReviewsController extends AbstractController
{
    public function add(int $gameId)
    {
        $game = Game::getById($gameId);
        $reviews = Review::findByColumn('game_id', $gameId);

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {
                $review = Review::createFromArray($_POST, $this->user, $gameId);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('games/view.php', ['error' => $e->getMessage(), 'game' => $game, 'reviews'=> $reviews]);
                return;
            }

            header('Location: /games/' . $gameId . '#review' . $review->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('games/view.php', [
          'game' => $game,
          'reviews'=> $reviews,
          'topGames' => $this->topGames,
          'shortNews' => $this->shortNews,
        ]);
    }

    public function delete(int $reviewId)
    {
        $review = Review::getById($reviewId);

        if ($review === null) {
            throw new NotFoundException();
        }

        if (!$this->user->isAdmin()) {
            if (!$review->isAuthor($this->user)) {
                throw new Forbidden('Вы можете удалять только свои отзывы');
            }
        }

        $review->delete();

        $game = Game::getById($review->getGameId());
        $reviews = Review::findByColumn('game_id', $review->getGameId());

        $this->view->renderHtml('games/view.php', [
          'game' => $game,
          'reviews'=> $reviews,
          'topGames' => $this->topGames,
          'shortNews' => $this->shortNews,
        ]);
    }

    public function edit(int $reviewId)
    {
        $editedReview = Review::getById($reviewId);
        $game = Game::getById($editedReview->getGameId());
        $reviews = Review::findByColumn('game_id', $editedReview->getGameId());

        if ($editedReview === null) {
            throw new NotFoundException();
        }

        if (!$editedReview->isAuthor($this->user)) {
            throw new Forbidden('Вы можете редактировать только свои комментарии');
        }

        if (!empty($_POST)) {
            try {
                $editedReview->updateFromArray($_POST);
                header('Location: /games/' . $editedReview->getGameId() . '#review' . $editedReview->getId(), true, 302);
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('games/view.php', ['error' => $e->getMessage(), 'game' => $game, 'reviews'=> $reviews, 'editedReview' => $editedReview, 'topGames' => $this->topGames, 'shortNews' => $this->shortNews]);
                return;
            }
        }

        $this->view->renderHtml('games/view.php', [
          'game' => $game,
          'reviews'=> $reviews,
          'topGames' => $this->topGames,
          'shortNews' => $this->shortNews,
          'editedReview' => $editedReview]);
    }
}