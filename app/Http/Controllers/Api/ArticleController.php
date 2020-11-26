<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller {

    public function getAll() {
        $articles = Article::all()->toJson(JSON_PRETTY_PRINT);
        return response($articles, 200);
    }

    public function get($id) {
        $article = Article::where('id', $id);
        if ($article->exists()) {
            $article = $article->get()->toJson(JSON_PRETTY_PRINT);
            return response($article, 200);
        } else {
            return response()->json([
                "message" => "Article not found"
            ], 404);
        }
    }

    public function create(Request $request) {
        $article = new Article();
        $article->name = $request->name;
        $article->author = $request->author;
        $article->save();

        return response()->json([
            'message' => 'Article created'
        ], 201);
    }
}
