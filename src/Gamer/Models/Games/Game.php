<?php

namespace Gamer\Models\Games;

use Gamer\Models\ActiveRecordEntity;
use Gamer\Models\Genres\Genre;
use Gamer\Models\Platforms\Platform;

class Game extends ActiveRecordEntity
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $descriptions;

    /** @var float */
    protected $rating;

    /** @var int */
    protected $year;

    /** @var float */
    protected $date;

    /** @var array */
    protected $genres;

    /** @var array */
    protected $platforms;

    /** @var string */
    protected $linkVideo;

    /** @var string */
    protected $addDate;

    public function __construct()
    {
        $this->setGenres();
        $this->setPlatforms();
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
    public function getDescriptions(): string
    {
        return $this->descriptions;
    }

    /**
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return float
     */
    public function getDate(): float
    {
        return $this->date;
    }

    /**
     * @return array
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**
     * @return array
     */
    public function getPlatforms(): array
    {
        return $this->platforms;
    }

    /**
     * @return string
     */
    public function getLinkVideo(): string
    {
        return $this->linkVideo;
    }

    /**
     * @return string
     */
    public function getAddDate(): string
    {
        return $this->addDate;
    }


    public function setGenres(): void
    {
        $this->genres = Genre::getObjectByForeignKeys('genres', $this->getTableName(), $this->id );;
    }

    public function setPlatforms(): void
    {
        $this->platforms = Platform::getObjectByForeignKeys('platforms', $this->getTableName(), $this->id );;
    }


    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'game';
    }
}