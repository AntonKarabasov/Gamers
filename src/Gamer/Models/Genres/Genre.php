<?php

namespace Gamer\Models\Genres;

use Gamer\Models\ActiveRecordEntity;

class Genre extends ActiveRecordEntity
{
    /** @var string */
    protected $name;

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
    protected static function getTableName(): string
    {
        return 'genres';
    }
}