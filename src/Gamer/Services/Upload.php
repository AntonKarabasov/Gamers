<?php

namespace Gamer\Services;

use Gamer\Exceptions\InvalidArgumentException;
use Intervention\Image\ImageManager;

class Upload
{
    public static function uploadImage(array $image, int $index): string
    {
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);

        $srcImageName = "news" . $index . '.' . $extension;
        $newImagePath = __DIR__ . '/../../../assets/img/news/' . $srcImageName;

        $allowedExtensions = ['jpg', 'png', 'gif'];
        if (!in_array($extension, $allowedExtensions)) {
            throw new InvalidArgumentException('Загрузка файлов с таким расширением запрещена!');
        } elseif ($image['error'] !== UPLOAD_ERR_OK) {
            throw new InvalidArgumentException('Ошибка при загрузке файла');
        } elseif (file_exists($newImagePath)) {
            throw new InvalidArgumentException('Файл с таким именем существует');
        } elseif (!move_uploaded_file($image['tmp_name'], $newImagePath)) {
            throw new InvalidArgumentException('Ошибка при загрузке файла');
        } else {
            $link = 'http://gamer.test/assets/img/news/' . $srcImageName;
        }

        return $link;
    }

    public static function uploadPoster(array $image, string $name): string
    {
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);

        $srcImageName = $name . '.' . $extension;
        $newImagePath = __DIR__ . '/../../../assets/img/poster/' . $srcImageName;



        $posterManager = new ImageManager(['driver' => 'gd']);
        $poster = $posterManager->make($image['tmp_name']);
        $poster->fit(500, 690);

        $allowedExtensions = ['jpg', 'png', 'gif'];

        if (!in_array($extension, $allowedExtensions)) {
            throw new InvalidArgumentException('Загрузка файлов с таким расширением запрещена!');
        } elseif ($image['error'] !== UPLOAD_ERR_OK) {
            throw new InvalidArgumentException('Ошибка при загрузке файла');
        } elseif (file_exists($newImagePath)) {
            throw new InvalidArgumentException('Файл с таким именем существует');
        } elseif (!$poster->save($newImagePath)) {
            throw new InvalidArgumentException('Ошибка при загрузке файла');
        } else {
            $link = 'http://gamer.test/assets/img/poster/' . $srcImageName;
        }

        return $link;
    }
}