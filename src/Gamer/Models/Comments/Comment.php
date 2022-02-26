<?php

namespace Gamer\Models\Comments;

use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Models\ActiveRecordEntity;
use Gamer\Models\Users\User;

class Comment extends ActiveRecordEntity
{
    /** @var int */
    protected $authorId;

    /** @var int */
    protected $newsId;

    /** @var string */
    protected $text;

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
    public function setNewsId(int $newsId): void
    {
        $this->newsId = $newsId;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
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
    public function getNewsId(): int
    {
        return $this->newsId;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
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
     * @return Comment
     */
    public static function createFromArray(array $fields, User $author, int $newsId): Comment
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Комментарий пустой');
        }

        $comments = new Comment;
        $comments->setAuthor($author);
        $comments->setNewsId($newsId);
        $comments->setText(nl2br($fields['text']));

        $comments->save();

        return $comments;
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'comments';
    }
}