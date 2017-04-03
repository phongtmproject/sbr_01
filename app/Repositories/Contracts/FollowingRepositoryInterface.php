<?php

namespace App\Repositories\Contracts;

interface FollowingRepositoryInterface extends RepositoryInterface
{
    public function selectFollower($id);

    public function selectFollowing($id);
}
