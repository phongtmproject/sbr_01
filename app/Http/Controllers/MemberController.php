<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\FollowingRepositoryInterface;
use App\Repositories\Contracts\UserBookRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $userRepository;
    protected $followingRepository;
    protected $userBookRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        FollowingRepositoryInterface $followingRepository,
        UserBookRepositoryInterface $userBookRepository
    )
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->followingRepository = $followingRepository;
        $this->userBookRepository = $userBookRepository;
    }

    public function searchMember(Request $request)
    {
        $members = $this->userRepository->searchMember($request->name)->get();

        return view('pages.search-member', compact('members'));
    }

    public function show($id)
    {
        if (isset($this->user->id) && ($this->user->id != $id)) {
            $following = $this->followingRepository->selectFollower($this->user->id)->selectFollowing($id)->first();

            if (isset($following)) {
                $following->resetNewReview();
            }
        }

        $this->shareView($id);

        return view('profiles.timeline');
    }

    public function showVideo($id)
    {
        $this->shareView($id);

        return view('profiles.videos');
    }

    public function following($id)
    {
        $this->shareView($id);

        return view('profiles.followings');
    }

    public function about($id)
    {
        $this->shareView($id);

        return view('profiles.about');
    }

    public function favorites($id)
    {
        $this->shareView($id);
        $favorites = $this->userBookRepository->selectUser($id)->favorites()->paginate(config('view.paginate'));

        return view('profiles.favorites', compact('favorites'));
    }

    public function shareView($id)
    {
        $videos = $this->userRepository->find($id)->reviews()->selectStreamVideo()->get();
        $numberVideos = $videos->count();
        $numberFavorites = $this->userBookRepository->selectUser($id)->favorites()->count();
        $member = $this->userRepository->find($id);
        $user = $this->user;
        $reviews = $this->userRepository->find($id)->reviews()->selectReviewText()->get();
        $reviews = $this->userLike($user, $reviews);

        view()->share('user', $this->user);
        view()->share('member', $member);
        view()->share('videos', $videos);
        view()->share('numberVideos', $numberVideos);
        view()->share('numberFavorites', $numberFavorites);
        view()->share('reviews', $reviews);
    }
}
