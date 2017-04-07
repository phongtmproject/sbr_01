<?php
/**
 * Created by PhpStorm.
 * User: VS9 X64Bit
 * Date: 24/03/2017
 * Time: 2:07 PM
 */

namespace App\Http\Controllers;

use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class BookListController extends Controller
{
    protected $bookRepository;
    protected $categoryRepository;

    public function __construct(
        BookRepositoryInterface $bookRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        parent::__construct();
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();
        if (($search = \Request::get('search')) != null) {
            $books = $this->bookRepository->search($search);
            $title = null;
        } else {
            $books = $this->bookRepository->findLatest();
            $title = trans('book.latest-stories');
        }
        $books = $books->paginate(config('settings.pagination.limit'));

        return view('pages.book-list')->with(compact('categories', 'books', 'title', 'search'));
    }

    public function show($title)
    {
        $search = null;
        $categories = $this->categoryRepository->all();
        switch ($title) {
            case trans('sidebar.latest-stories'):
                $books = $this->bookRepository->findLatest();
                break;
            case trans('sidebar.most-popular'):
                $books = $this->bookRepository->findMostPopular();
                break;
            default:
                $books = $this->categoryRepository->findByName($title)->books();
        }
        $books = $books->paginate(config('settings.pagination.limit'));

        return view('pages.book-list')->with(compact('categories', 'books', 'title', 'search'));
    }
}
