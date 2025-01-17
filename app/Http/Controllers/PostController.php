<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $posts = $this->postService->getPosts($request->input('page', 1), $request->input('per_page', 15));

        return response()->json($posts, 200);
    }

    public function store(PostRequest $request)
    {
        $post = $this->postService->store($request->validated());

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }

    public function update(PostRequest $request, Post $post)
    {
        $res = $this->postService->update($request->validated(), $post);
        if($res) {
            return response()->json(['message' => 'Post updated successfully'], 200);
        }

        return response()->json(['message' => 'Unauthorized action'], 400);
    }

    public function destroy(Post $post)
    {
        $res = $this->postService->delete($post);
        if($res) {
            return response()->json(['message' => 'Post deleted successfully'], 200);
        }

        return response()->json(['message' => 'Unauthorized action'], 400);
    }
}
