<?php

namespace App\Repositories\Contracts;

interface UserBookRepositoryInterface extends RepositoryInterface
{
    public function selectUser($userId);

    public function favorites();
}
