<?php

namespace Gamer\Controllers;


use Gamer\Exceptions\Forbidden;
use Gamer\Exceptions\TelegramException;
use Gamer\Exceptions\UnauthorizedException;
use Gamer\Models\Users\User;
use Gamer\Models\Games\Game;
use Gamer\Models\Users\UserActivationService;
use Gamer\Models\Users\UsersAuthService;
use Gamer\Services\EmailSender;
use Gamer\Services\TelegramSender;
use Gamer\View\View;
use Gamer\Exceptions\InvalidArgumentException;
use Gamer\Exceptions\ActivationException;
use Gamer\Exceptions\MailException;

class UsersController extends AbstractController
{
    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()], 'Регистрация');
                return;
            }

            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);

                try {
                    EmailSender::send($user, 'Aктивация', 'userActivation.php', [
                      'userId' => $user->getId(),
                      'code' => $code
                    ]);
                } catch (MailException $e) {
                    $this->view->renderHtml('errors/500.php', ['error' => $e->getMessage()], 500);
                    UserActivationService::deleteActivationCode($user, $code);
                    $user->delete();
                    return;
                }

                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }

        $this->view->renderHtml('users/signUp.php', ['topGames' => $this->topGames], 'Регистрация');
    }

    public function activate(int $userId, string $activationCode)
    {
        $user = User::getById($userId);

        if ($user === null) {
            throw new ActivationException('Пользователь не найден.');
        }

        if ($user->IsConfirmed()) {
            throw new ActivationException('Пользователь уже активирован');
        }

        $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);

        if (!$isCodeValid) {
            throw new ActivationException('Неверный код активации');

        } else {
            $user->activate();
            UserActivationService::deleteActivationCode($user, $activationCode);
            $this->view->renderHtml('users/activationSuccessful.php', ['topGames' => $this->topGames]);
        }
    }

    public function login()
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /');
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()], 'Вход');
                return;
            }
        }
        $this->view->renderHtml('users/login.php', ['topGames' => $this->topGames] ,'Вход');
    }

    public function profile()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST) || !empty($_FILES)) {
            try {
                $this->user->updateUserFromArray($_POST, $_FILES);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/profile.php',
                  ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /users/profile', true, 302);
            exit();
        }
        $this->view->renderHtml('users/profile.php', ['topGames' => $this->topGames], 'Профиль');
    }

    public function logout()
    {
        UsersAuthService::deleteToken();
        header('Location: /');
    }

    public function contact()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST['text'])) {
            try {
                $text = 'Отправитель: ' . $this->user->getNickname() . "\n" .
                         'Email отправителя ' . $this->user->getEmail() . "\n" .
                         $_POST['text'];
                TelegramSender::send($text);
            } catch (TelegramException $e) {
                $this->view->renderHtml('errors/500.php', ['error' => $e->getMessage()], 500);
                return;
            }catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/contacts.php', ['error' => $e->getMessage()], 'Контакты');
                return;
            }

            $this->view->renderHtml('users/sendSuccessful.php', ['topGames' => $this->topGames]);
            exit();
        }

        $this->view->renderHtml('users/contacts.php', ['topGames' => $this->topGames], 'Контакты');
    }
}
