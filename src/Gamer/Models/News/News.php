<?php

namespace Gamer\Models\News;

use Gamer\Models\ActiveRecordEntity;
use Gamer\Models\Users\User;
use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Services\Db;
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

    public function delete(): void
    {
        $db = Db::getInstance();

        $sql = 'DELETE FROM `comments` WHERE news_id = :id;';
        $db->query($sql, [':id' => $this->id]);

        unlink(str_replace( 'http://gamer.test/',  '' , $this->linkImg));

        parent::delete();
    }

    /**
     * @return News
     */
    public static function createFromArray(array $fields, User $author, array $image = []): News
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название новости');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст новости');
        }

        if (empty($image['attachment']) && empty($fields['link_img'])) {
            throw new InvalidArgumentException('Не передана картинка новости');
        }

        $news = new News;
        $news->setAuthor($author);
        $news->setName($fields['name']);
        $news->setText($fields['text']);

        if (!empty($fields['link_img'])) {
            $news->setLinkImg($fields['link_img']);
        }

        if ($image['attachment']['size'] !== 0 && !empty($image['attachment'])) {
            try {
                $link = Upload::uploadImage($image['attachment'],
                  $news->getId());
            } catch (InvalidArgumentException $e) {
                $news->delete();
                throw new InvalidArgumentException($e->getMessage());
            }

            $news->setLinkImg($link);
        }

        $news->save();


        return $news;
    }

    /**
     * @return News
     */
    public function updateFromArray(array $fields, array $image = []): News
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название новости');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст новости');
        }

        if (!empty($fields['link_img'])) {
            $this->setLinkImg($fields['link_img']);
        }

        if ($image['attachment']['size'] !== 0) {
            try {
                $link = Upload::uploadImage($image['attachment'], $this->getId(), true);
                $this->setLinkImg($link);
            } catch (InvalidArgumentException $e) {
                throw new InvalidArgumentException($e->getMessage());
            }
        }

        $this->setName($fields['name']);
        $this->setText($fields['text']);

        $this->save();

        return $this;
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'news';
    }
}