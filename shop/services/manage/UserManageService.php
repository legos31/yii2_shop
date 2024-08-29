<?php

namespace shop\services\manage;

use shop\entities\User;
use shop\forms\manage\user\UserCreateForm;
use shop\forms\manage\user\UserEditForm;
use shop\repositories\UserRepository;
use shop\services\RoleManager;

class UserManageService
{
    private $roles;

    public function __construct(
        UserRepository $repository,
        RoleManager $roles,
    )
    {
        $this->repository = $repository;

        $this->roles = $roles;
    }

    public function create(UserCreateForm $form): User
    {
        $user = User::createByAdmin(
            $form->username,
            $form->email,
            $form->password
        );
        $this->roles->assign($user->id, $form->role);
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
        $this->roles->assign($user->id, $form->role);
        $this->repository->save($user);

    }

    public function assignRole($id, $role): void
    {
        $user = $this->repository->get($id);
        $this->roles->assign($user->id, $role);
    }

    public function remove($id): void
    {
        $user = $this->repository->get($id);
        $this->repository->remove($user);
        //$this->newsletter->unsubscribe($user->email);
    }
}