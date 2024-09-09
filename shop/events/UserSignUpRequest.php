<?php
namespace shop\events;

use shop\entities\User;
class UserSignUpRequest
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}