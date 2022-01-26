<?php

namespace Gamer\Services;

use Gamer\Exceptions\InvalidArgumentException;

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
            throw new InvalidArgumentException('Файл с таким именем существует');
        } else {
            $link = 'http://gamer.test/assets/img/news/' . $srcImageName;
        }

        return $link;
    }
}