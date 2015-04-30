<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ArticleController extends Controller {

    public function index()
    {
        $articles = [];
        return view('articles.index', compact('articles'));
    }
}
