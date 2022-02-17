<?php

namespace Gamer\Models\ShortNews;

use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Models\ActiveRecordEntity;
use Gamer\Models\Users\User;


class ShortNews extends ActiveRecordEntity
{
    /** @var int */
    protected $authorId;


    /** @var string */
    protected $text;

    /** @var string */
    protected $createdAt;

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
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
     * @return string
     */
    public function getDate(): string
    {
        $date = explode(' ', $this->createdAt);
        $date = $date[0];
        $date = explode('-', $date);

        for ($i = 2; $i >= 0; $i--) {
            if ($i !== 0) {
                $newDate = $newDate . $date[$i] . '.';
            } else {
                $newDate .= $date[$i];
            }
        }

        return $newDate;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }


    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }


    /**
     * @return ShortNews
     */
    public static function createFromArray(array $fields, User $author): ShortNews
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст новости');
        }

        $shortNews = new ShortNews;
        $shortNews->setAuthor($author);
        $shortNews->setText($fields['text']);

        $shortNews->save();

        return $shortNews;
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'short_news';
    }
}