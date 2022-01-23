<?php

namespace Gamer\Models\Platforms;

use Gamer\Models\ActiveRecordEntity;

class Platform extends ActiveRecordEntity
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
        return 'platforms';
    }

    /**
     * @return string
     */
    public static function getCompanyByPlatform(string $platform): string
    {
        switch ($platform) {
            case 'PC':
                return 'PC';
            case 'PS3':
            case 'PS4':
            case 'PS5':
                return 'PS';
            case 'Xbox 360':
            case 'Xbox One':
            case 'Xbox XS':
                return 'xbox';
            case 'Wii U':
            case 'Nintendo Switch':
                return 'nintendo';
        }
    }

    /**
     * @return string
     */
    public static function getIdPlatformsByCompany(string $company): array
    {
        switch ($company) {
            case 'PC':
                return ['PC'];
            case 'PS':
                return ['PS3', 'PS4', 'PS5'];
            case 'Xbox':
                return ['Xbox 360', 'Xbox One', 'Xbox XS'];
            case 'Nintendo':
                return ['Wii U', 'Nintendo Switch'];
            default:
                return [$company];
        }
    }

}