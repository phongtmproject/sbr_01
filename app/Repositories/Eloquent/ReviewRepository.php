<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Models\Review;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function model()
    {
        return Review::class;
    }

    /**
     * Create Comment For Review
     *
     * @param  array $input
     * @return bool
     */
    public function createComment($input)
    {
        if (!auth()->check()) {
            return false;
        }

        $data = [
            'user_id' => auth()->id,
            'content' => $input['content'],
        ];

        return $this->model->find($input['review_id'])->comments()->create($data);
    }

    public function selectStreamVideo()
    {
        return $this->model->where('stream_link', '<>', null);
    }

    public function selectReviewText()
    {
        return $this->model->where('stream_link', null);
    }

    public function getTopVideo()
    {
        return $this->model->where('stream_link', '<>', null)
            ->orderBy('id', 'desc')
            ->take(config('view.top_video'));
    }

    public function mostNewVideo()
    {
        return $this->model->where('stream_link',  '<>', null)
            ->take(config('view.most_new_review'))
            ->first();
    }

    public function searchReview($caption)
    {
        return $this->model->where('caption', 'like', '%' . $caption . '%');
    }

    public function scopeUserLike($userId)
    {
        return $this->model->likes->where('user_id', $userId);
    }
}
