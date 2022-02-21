<?php

namespace Gamer\Cli;

use Gamer\Exceptions\MailException;
use Gamer\Models\Users\User;
use Gamer\Services\EmailSender;

class CongratulateBirthday extends AbstractCommand
{
    public function __construct()
    {
        $date['date']=date('m-d');
        parent::__construct($date);
    }

    protected function checkParams()
    {
        $this->ensureParamExists('date');
    }

    public function execute()
    {
        $birthdayUsers = User::search($this->getParam('date'), 'date_of_birth',);

        if (empty($birthdayUsers)) {
            exit();
        }

        foreach ($birthdayUsers as $user) {
            try {
                EmailSender::send($user, 'Happy Birthday', 'congratulateBirthday.php', [
                  'name' => $user->getNickname()
                ]);
            } catch (MailException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

}