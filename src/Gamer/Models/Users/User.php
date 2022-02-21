<?php

namespace Gamer\Models\Users;

use Gamer\Models\ActiveRecordEntity;
use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Models\Games\Game;
use Gamer\Services\Upload;

class User extends ActiveRecordEntity
{

    /** @var string */
    protected $nickname;

    /** @var string */
    protected $email;

    /** @var string */
    protected $dateOfBirth;

    /** @var  int */
    protected $isConfirmed;

    /** @var string */
    protected $avatar;

    /** @var string */
    protected $role;

    /** @var string */
    protected $passwordHash;

    /** @var string */
    protected $authToken;

    /** @var string */
    protected $createdAt;


    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getDateOfBirth(): ?string
    {
        return $this->dateOfBirth;
    }


    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }


    /**
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->isConfirmed;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function activate(): void
    {
        $this->isConfirmed = true;
        $this->save();
    }

    public function canUserToReview(?array $reviews): bool
    {
        if (empty($reviews)) {
            return true;
        }

        foreach ($reviews as $review) {
            if ($review->getAuthorId() === $this->id) {
                return false;
            }
        }

        return true;
    }

    public static function signUp(array $userData): User
    {
        if (empty($userData['nickname'])) {
            throw new InvalidArgumentException('Не передан nickname');
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $userData['nickname'])) {
            throw new InvalidArgumentException('Nickname может состоять только из символов латинского алфавита и цифр');
        }

        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }

        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email некорректен');
        }

        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Не передан пароль');
        }

        if (mb_strlen($userData['password']) < 8) {
            throw new InvalidArgumentException('Пароль должен быть не менее 8 символов');
        }

        if (empty($userData['repeatedPassword'])) {
            throw new InvalidArgumentException('Повторите пароль');
        }

        if ($userData['repeatedPassword'] !== $userData['password']) {
            throw new InvalidArgumentException('Пароли не совпадают');
        }

        if (static::findOneByColumn('nickname', $userData['nickname'])
          !== null
        ) {
            throw new InvalidArgumentException('Пользователь с таким nickname уже существует');
        }

        if (static::findOneByColumn('email', $userData['email']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким email уже существует');
        }

        $user = new User;
        $user->nickname = $userData['nickname'];
        $user->email = $userData['email'];
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->role = 'user';
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->save();

        return $user;
    }

    public static function login(array $loginData): User
    {
        if (empty($loginData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }

        if (empty($loginData['email'])) {
            throw new InvalidArgumentException('Не передан password');
        }

        $user = User::findOneByColumn('email', $loginData['email']);
        if ($user === null) {
            throw new InvalidArgumentException('Нет пользователя с таким email');
        }

        if (!password_verify($loginData['password'], $user->getPasswordHash())) {
            throw new InvalidArgumentException('Неправильный пароль');
        }

        if (!$user->isConfirmed) {
            throw new InvalidArgumentException('Пользователь не подтверждён');
        }

        $user->refreshAuthToken();
        $user->save();

        return $user;
    }

    /**
     * @return User
     */
    public function updateUserFromArray(array $userData, array $image): User
    {
        if (empty($userData['nickname'])) {
            throw new InvalidArgumentException('Не передан nickname');
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $userData['nickname'])) {
            throw new InvalidArgumentException('Nickname может состоять только из символов латинского алфавита и цифр');
        }

        if ($this->nickname !== $userData['nickname']) {
            if (static::findOneByColumn('nickname', $userData['nickname']) !== null  ) {
                throw new InvalidArgumentException('Пользователь с таким nickname уже существует');
            }
        }

        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }

        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email некорректен');
        }

        if ($this->email !== $userData['email']) {
            if (static::findOneByColumn('email', $userData['email']) !== null) {
                throw new InvalidArgumentException('Пользователь с таким email уже существует');
            }
        }

        if (!empty($userData['password'])) {
            if (mb_strlen($userData['password']) < 8) {
                throw new InvalidArgumentException('Пароль должен быть не менее 8 символов');
            }

            if (empty($userData['repeatedPassword'])) {
                throw new InvalidArgumentException('Повторите пароль');
            }

            if ($userData['repeatedPassword'] !== $userData['password']) {
                throw new InvalidArgumentException('Пароли не совпадают');
            }

            $this->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        }

        if (!empty($userData['date'])) {
            $this->dateOfBirth = $userData['date'];
        }

        if ($image['attachment']['size'] !== 0) {
            try {
                $linkAvatar = Upload::uploadAvatar($image['attachment'], $this->getNickname(), true);
                $this->avatar = $linkAvatar;
            } catch (InvalidArgumentException $e) {
                throw new InvalidArgumentException($e->getMessage());
            }
        }

        $this->nickname = $userData['nickname'];
        $this->email = $userData['email'];

        $this->save();

        return $this;
    }

    private function refreshAuthToken()
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'users';
    }
}