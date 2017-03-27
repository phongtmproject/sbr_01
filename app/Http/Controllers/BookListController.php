<?php
/**
 * Created by PhpStorm.
 * User: VS9 X64Bit
 * Date: 24/03/2017
 * Time: 2:07 PM
 */

namespace App\Http\Controllers;


use App\Category;

class BookListController extends Controller
{
    public function index()
    {
            $category = Category::find(1);
            $books = $category->books;
            $title = $category->name;
            $categories = Category::all();

        return view('pages.book-list')->with([
            'books' => $books,
            'categories' => $categories,
            'title' => $title,
        ]);
    }
}
