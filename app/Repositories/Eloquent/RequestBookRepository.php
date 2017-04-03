<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\RequestBookRepositoryInterface;
use Illuminate\Support\Facades\Input;
use App\Models\RequestBook;

class RequestBookRepository extends BaseRepository implements RequestBookRepositoryInterface
{
    public function model()
    {
        return RequestBook::class;
    }
}
