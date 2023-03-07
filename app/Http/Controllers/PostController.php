<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;
    public function __construct()
    {
        $this->postService = new PostService();
    }



    public function posts()
    {
        try {
            return ApiResponse::success("Posts were received successfully! ",
                $this->postService->posts());
        } catch (\Exception $e) {
            return ApiResponse::failed($e->getMessage(), $e->getCode());
        }
    }

    public function post($post_id)
    {
        try {
            return ApiResponse::success("Posts were received successfully! ",
                $this->postService->post($post_id));
        } catch (\Exception $e) {
            return ApiResponse::failed($e->getMessage(), $e->getCode());
        }
    }

    public function add(PostRequest $request)
    {
        try {
            return ApiResponse::success("Post was Created successfully! ",
                $this->postService->add($request->validated()), 201);
        } catch (\Exception $e) {
            return ApiResponse::failed($e->getMessage(), $e->getCode());
        }
    }

    public function delete($id)
    {
        try {
            return ApiResponse::success("Post was deleted successfully! ",
                $this->postService->delete($id), 204);
        } catch (\Exception $e) {
            return ApiResponse::failed($e->getMessage(), $e->getCode());
        }
    }
}
