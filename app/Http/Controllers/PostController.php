<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $post = Post::query();
        if ($request->only('sort')) {
            $post = $post->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $post = $post->orderBy('id', 'ASC');
        }
        $post = $post->get();
        return response()->json($post, 200);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $post = Post::find($id);
        return response()->json($post, 200);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $post = $request->all();
        Post::create($post);
        return response()->json($post, 200);
    }

    public function search(Request $request)
    {
        $post = Post::query();
        $post = $post->where('title', 'like', '%' . $request->get('search') . '%');
        $post = $post->get();
        return response()->json($post,200);
    }
}
