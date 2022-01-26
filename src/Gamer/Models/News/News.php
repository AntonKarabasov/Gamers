<?php

namespace Gamer\Models\News;

use Gamer\Models\ActiveRecordEntity;
use Gamer\Models\Users\User;
use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Services\Upload;

class News extends ActiveRecordEntity
{
    /** @var int */
    protected $authorId;

    /** @var string */
    protected $name;

    /** @var string */
    protected $text;

    /** @var string */
    protected $linkImg;

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
    public function getName(): string
    {
        return $this->name;
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
    public function getLinkImg(): string
    {
        return $this->linkImg;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @param string $linkImg
     */
    public function setLinkImg(string $linkImg): void
    {
        $this->linkImg = $linkImg;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    /**
     * @return News
     */
    public static function createFromArray(array $fields, array $image, User $author): News
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название новости');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст новости');
        }

        if (empty($image['attachment'])) {
            throw new InvalidArgumentException('Не передана картинка новости');
        }

        $news = new News;
        $news->setAuthor($author);
        $news->setName($fields['name']);
        $news->setText($fields['text']);

        $news->save();

        try {
            $link = Upload::uploadImage($image['attachment'], $news->getId());
        } catch (InvalidArgumentException $e) {
            $news->delete();
            throw new InvalidArgumentException($e->getMessage());
        }

        $news->setLinkImg($link);
        $news->save();


        return $news;
    }


    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'news';
    }
}