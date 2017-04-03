<?php

namespace App\Repositories\Contracts;

interface ReviewRepositoryInterface extends RepositoryInterface
{
    public function createComment($input);

    public function selectStreamVideo();

    public function selectReviewText();

    public function getTopVideo();

    public function mostNewVideo();

    public function searchReview($caption);

    public function scopeUserLike($userId);
}
