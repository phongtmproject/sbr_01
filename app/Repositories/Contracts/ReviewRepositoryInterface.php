<?php

namespace App\Repositories\Contracts;

interface ReviewRepositoryInterface extends RepositoryInterface
{
    public function createComment($input);
}
