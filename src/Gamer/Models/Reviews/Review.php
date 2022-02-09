<?php

namespace Gamer\Models\Reviews;

use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Models\ActiveRecordEntity;
use Gamer\Models\Comments\Comment;
use Gamer\Models\Users\User;


class Review extends ActiveRecordEntity
{
    /** @var int */
    protected $authorId;

    /** @var int */
    protected $gameId;

    /** @var string */
    protected $text;

    /** @var int */
    protected $rating;

    /** @var string */
    protected $createdAt;


    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    /**
     * @param int $newsId
     */
    public function setGameId(int $gameId): void
    {
        $this->gameId = $gameId;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }


    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * @return int
     */
    public function getGameId(): int
    {
        return $this->gameId;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }


    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    /**
     * @return bool
     */
    public function isAuthor(?User $user): bool
    {
        if ($user === null) {
            return false;
        }

        return $this->authorId === $user->getId();
    }

    /**
     * @return string
     */
    public function getActive(int $star): string
    {
       if ($star <= $this->rating) {
           return 'active';
       } else {
           return '';
       }
    }

    /**
     * @return Review
     */
    public static function createFromArray(array $fields, User $author, int $gameId): Review
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Отзыв не может быть пустым');
        }

        if (empty($fields['rating'])) {
            throw new InvalidArgumentException('Поставьте оценку');
        }

        $review = new Review();
        $review->setAuthor($author);
        $review->setGameId($gameId);
        $review->setText($fields['text']);
        $review->setRating($fields['rating']);

        $review->save();

        return $review;
    }

    /**
     * @return void
     */
    public function updateFromArray(array $fields): void
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Отзыв не может быть пустым');
        }

        if (empty($fields['rating'])) {
            throw new InvalidArgumentException('Поставьте оценку');
        }

        $this->setText($fields['text']);
        $this->setRating($fields['rating']);

        $this->save();
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'reviews';
    }
}