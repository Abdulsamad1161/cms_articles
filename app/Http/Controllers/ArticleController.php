<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ArticleController extends Controller
{
  public function drafts()
  {
    $articles = Article::where('status', 'draft')->with('user')->get();
    return view('articles.index', compact('articles'))->with('type', 'draft');
  }

  public function published()
  {
    $articles = Article::where('status', 'published')->with('user')->get();
    return view('articles.index', compact('articles'))->with('type', 'published');
  }

  public function create()
  {
    return view('articles.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'scheduled_at' => 'nullable|date',
    ]);

    $article = new Article();
    $article->title = $request->title;
    $article->description = $request->description;
    $article->scheduled_at = $request->scheduled_at;
    $article->user_id = Auth::id();
    $article->save();

    return redirect()->route('articles.drafts')->with('success', 'Article created successfully!');
  }

  public function upload(Request $request)
  {
    $request->validate([
      'upload' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:10240', // 10MB max size
    ]);

    $file = $request->file('upload');
    $path = $file->store('ckeditor/images', 'public');

    $url = asset('storage/' . $path);

    return response()->json([
      'uploaded' => true,
      'fileName' => $file->getClientOriginalName(),
      'url' => $url,
    ]);
  }
  public function update(Request $request, $id)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'scheduled_at' => 'nullable|date',
    ]);

    $article = Article::findOrFail($id);
    $article->title = $request->title;
    $article->description = $request->description;
    $article->scheduled_at = $request->scheduled_at;
    $article->save();

    return redirect()->back()->with('success', 'Article updated successfully!');
  }

  public function edit($id)
  {
    $article = Article::findOrFail($id);
    return view('articles.edit', compact('article'));
  }

  public function show($id)
  {
    $article = Article::findOrFail($id);
    return view('articles.show', compact('article'));
  }

  public function destroy($id)
  {
    $article = Article::findOrFail($id);
    $article->delete();

    return redirect()->back()->with('success', 'Article deleted successfully!');
  }
}