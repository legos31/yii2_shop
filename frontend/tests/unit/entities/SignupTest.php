<?php

namespace frontend\tests\unit\entities;

use Codeception\Test\Unit;
use shop\entities\User;

class SignupTest extends Unit
{
    public function testSuccess()
    {
        $user = User::create(
            $username = 'username',
            $email = '@email@site.ru',
            $password = 'password'
        );

        $this->assertEquals($username, $user->username);
        $this->assertEquals($email, $user->email);
        $this->assertNotEmpty($user->password_hash);
        $this->assertNotEquals($password, $user->password_hash);
        //$this->assertNotEmpty($user->created_at);
        $this->assertNotEmpty($user->auth_key);
        //$this->assertEquals($user::STATUS_ACTIVE, $user->isActive());
    }
}