<?php

namespace Gamer\Controllers;


use Gamer\Models\Users\User;
use Gamer\Models\Games\Game;
use Gamer\Models\Users\UserActivationService;
use Gamer\Models\Users\UsersAuthService;
use Gamer\Services\EmailSender;
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

        $this->view->renderHtml('users/signUp.php', ['topGames' => Game::findLimitAndOrder(10, 'rating')], 'Регистрация');
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
            $this->view->renderHtml('users/activationSuccessful.php');
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
                $this->view->renderHtml('users/login.php', ['errorLogin' => $e->getMessage()], 'Вход');
                return;
            }
        }
        $this->view->renderHtml('users/login.php');
    }

    public function logout()
    {
        UsersAuthService::deleteToken();
        header('Location: /');
    }
}
