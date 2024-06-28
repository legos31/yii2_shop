<?php

namespace unit\entities;

use Codeception\Test\Unit;
use shop\entities\User;

class ConfirmSignUpTest extends Unit
{
    public function testSuccess ()
    {
        $user = new User ([
            'status' => User::STATUS_INACTIVE,
            'verification_token' => 'token',
        ]);

        // TODO


    }
}