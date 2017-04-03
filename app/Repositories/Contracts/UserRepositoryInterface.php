<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function isExistEmail($email);

    public function searchUser($item);

    public function deleteAll($users);
}
