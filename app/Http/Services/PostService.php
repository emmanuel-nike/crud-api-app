<?php

namespace App\Http\Services;

use App\Models\Post;

class PostService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getPostById($id): Post
    {
        return Post::findOrFail($id);
    }

    public function getPosts($page = 1, $perPage = 10)
    {
        return Post::orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
    }

    public function store($data)
    {
        $data['user_id'] = $this->userService->getAuthUser()->id;

        return Post::create($data);
    }

    public function update(array $data, Post $post)
    {
        $authUser =  $this->userService->getAuthUser();
        if($authUser->id != $post->user_id){
            return false;
        }
        return $post->update($data);
    }

    public function delete(Post $post)
    {
        $authUser =  $this->userService->getAuthUser();
        if($authUser->id != $post->user_id){
            return false;
        }
        return $post->delete();
    }
}
