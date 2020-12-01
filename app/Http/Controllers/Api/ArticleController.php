<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller {

    /**
     * List all articles
     *
     * @return ResponseFactory|Response
     */
    public function getAll() {
        $articles = Article::all()->toJson(JSON_PRETTY_PRINT);
        return response($articles, 200);
    }

    /**
     * Get Article by Id
     *
     * @param $id
     * @return ResponseFactory|JsonResponse|Response
     */
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

    /**
     * Create new Article
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request) {
        $article = new Article([
            'name' => $request->get('name'),
            'author' => $request->get('author')
        ]);
        $article->save();

        return response()->json([
            'message' => 'Article created',
            "article" => $article
        ], 201);
    }

    /**
     * Update Article by Id
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) {
        if (Article::where('id', $id)->exists()) {
            $article = Article::find($id);

            $article->name = is_null($request->get('name')) ? $article->name : $request->get('name');
            $article->author = is_null($request->get('author')) ? $article->author : $request->get('author');
            $article->save();

            return response()->json([
                "message" => "records updated successfully",
                "article" => $article
            ], 200);
        } else {
            return response()->json([
                "message" => "Article not found"
            ], 404);
        }
    }

    /**
     * Delete Article by Id
     *
     * @param $id
     * @return JsonResponse
     */
    public function delete($id) {
        if (Article::where('id', $id)->exists()) {
            $article = Article::find($id);
            $article->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }
}
