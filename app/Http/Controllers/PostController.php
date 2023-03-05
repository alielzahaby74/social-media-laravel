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

    public function add(PostRequest $request)
    {
        try {
            return ApiResponse::success("Post was Created successfully! ",
                $this->postService->add($request->validated()));
        } catch (\Exception $e) {
            return ApiResponse::failed($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            return ApiResponse::success("Post was deleted successfully! ",
                $this->postService->delete($id));
        } catch (\Exception $e) {
            return ApiResponse::failed($e->getMessage());
        }
    }
}
