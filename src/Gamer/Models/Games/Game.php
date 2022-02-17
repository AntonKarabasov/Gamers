<?php

namespace Gamer\Models\Games;

use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Models\ActiveRecordEntity;
use Gamer\Models\Genres\Genre;
use Gamer\Models\Platforms\Platform;
use Gamer\Services\Db;
use Gamer\Services\Upload;

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
    protected $linkPoster;

    /** @var string */
    protected $linkVideo;

    /** @var string */
    protected $addDate;

    public function __construct()
    {
        $this->getGenres();
        $this->getPlatforms();
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
    public function getGenres(): ?array
    {
        if ($this->id === null) {
            return null;
        }
        $this->genres = Genre::getObjectByForeignKeys('genres', $this->getTableName(), $this->id );
        return $this->genres;
    }

    /**
     * @return array
     */
    public function getPlatforms(): ?array
    {
        if ($this->id === null) {
            return null;
        }
        $this->platforms = Platform::getObjectByForeignKeys('platforms', $this->getTableName(), $this->id );
        return $this->platforms;
    }

    /**
     * @return string
     */
    public function getLinkPoster(): string
    {
        return $this->linkPoster;
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

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $descriptions
     */
    public function setDescriptions(string $descriptions): void
    {
        $this->descriptions = $descriptions;
    }

    /**
     * @param float $rating
     */
    public function setRating(float $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * @param float $date
     */
    public function setDate(float $date): void
    {
        $this->date = $date;
    }

    /**
     * @param string $linkPoster
     */
    public function setLinkPoster(string $linkPoster): void
    {
        $this->linkPoster = $linkPoster;
    }


    /**
     * @param string $linkVideo
     */
    public function setLinkVideo(string $linkVideo): void
    {
        $this->linkVideo = $linkVideo;
    }

    /**
     * @param array $genres
     */
    public function setGenres(array $genres): void
    {
        $this->genres = $genres;
    }

    /**
     * @param array $platforms
     */
    public function setPlatforms(array $platforms): void
    {
        $this->platforms = $platforms;
    }

    public function delete(): void
    {
        $db = Db::getInstance();

        $sql = 'DELETE FROM `game_genres` WHERE game_id = :id;';
        $db->query($sql, [':id' => $this->id]);

        $sql = 'DELETE FROM `game_platforms` WHERE game_id = :id;';
        $db->query($sql, [':id' => $this->id]);

        $sql = 'DELETE FROM `reviews` WHERE game_id = :id;';
        $db->query($sql, [':id' => $this->id]);

        unlink(str_replace( 'http://gamer.test/',  '' , $this->linkPoster));

        parent::delete();
    }

    protected function insert(array $mappedProperties): void
    {
        $filteredProperties = array_filter($mappedProperties);

        $columns = [];
        $paramsNames = [];
        $params2values = [];
        foreach ($filteredProperties as $columnName => $value) {
            if (is_array($value)) {
                if ($columnName === 'genres') {
                    $relationTableArray['game_genres'] = $value;
                    continue;
                } elseif ($columnName === 'platforms') {
                    $relationTableArray['game_platforms'] = $value;
                    continue;
                }
            }
            $columns[] = '`' . $columnName . '`';
            $paramName = ':' . $columnName;
            $paramsNames[] = $paramName;
            $params2values[$paramName] = $value;
        }

        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);

        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ');';

        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
        $this->id = $db->getLastInsertId();
        foreach ($relationTableArray as $tableName => $values) {
            if ($tableName === 'game_genres') {
                $columnName = 'genres_id';
            } elseif ($tableName === 'game_platforms') {
                $columnName = 'platforms_id';
            }

            foreach ($values as $value) {
                $sql = 'INSERT INTO `' . $tableName .'` (`game_id`, `' . $columnName .'`) VALUES (:game_id, :' . $columnName .')';

                $db->query($sql, [':game_id' => $this->id,
                                  ':' . $columnName => $value]);

            }
        }
        $this->refresh();
    }

    /**
     * @return Game
     */
    public static function createFromArray(array $fields, array $poster): Game
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название игры');
        }

        if (empty($fields['linkVideo'])) {
            throw new InvalidArgumentException('Не передана ссыдка на видео игры');
        }

        if (empty($fields['date'])) {
            throw new InvalidArgumentException('Не передана дата выхода');
        }

        if (empty($fields['rating'])) {
            throw new InvalidArgumentException('Не передан рейтинг игры');
        }

        if (empty($fields['platforms'])) {
            throw new InvalidArgumentException('Не передана платформа');
        }

        if (empty($fields['genres'])) {
            throw new InvalidArgumentException('Не передан жанр');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передано описание игры');
        }

        if (empty($poster['attachment'])) {
            throw new InvalidArgumentException('Не передан постер игры');
        }

        try {
            $linkPoster = Upload::uploadPoster($poster['attachment'], $fields['name']);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }


        $date = explode('-', $fields['date']);

        $game = new Game();
        $game->setName($fields['name']);
        $game->setLinkPoster($linkPoster);
        $game->setLinkVideo($fields['linkVideo']);
        $game->setDate($date[2] . '.' . $date[1]);
        $game->setYear($date[0]);
        $game->setRating($fields['rating']);
        $game->setPlatforms($fields['platforms']);
        $game->setGenres($fields['genres']);
        $game->setDescriptions($fields['text']);


        $game->save();

        return $game;
    }

    /**
     * @return ?array
     */
    public static function searchGames(string $query): ?array
    {
        if (empty($query)) {
            throw new InvalidArgumentException('Не передано название игры');
        }

        if (strlen($query) < 3) {
            throw new InvalidArgumentException('Слишком короткий поисковый запрос');
        } else if (strlen($query) > 128) {
            throw new InvalidArgumentException('Слишком длинный поисковый запрос');
        }

        $games = self::search($query, 'name');

        return $games;
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'game';
    }
}