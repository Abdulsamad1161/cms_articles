<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class PublicArticleController extends Controller
{
    public function cms()
    {
        $articles = Article::where('status', 'published')->with('user')->get();
        return view('publish.cms', compact('articles'));
    }
}