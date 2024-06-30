<?php

namespace shop\services\manage;

use shop\entities\User;
use shop\forms\manage\user\UserCreateForm;
use shop\forms\manage\user\UserEditForm;
use shop\repositories\UserRepository;

class UserManageService
{
    public function __construct(
        UserRepository $repository,
    )
    {
        $this->repository = $repository;

    }

    public function create(UserCreateForm $form): User
    {
        $user = User::createByAdmin(
            $form->username,
            $form->email,
            $form->password
        );

        $this->repository->save($user);

        return $user;
    }

    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email,
        );

        $this->repository->save($user);

    }
}