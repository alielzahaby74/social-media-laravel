<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\LikeRequest;
use App\Services\LikeService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    private $likeService;

    public function __construct()
    {
        $this->likeService = new LikeService();
    }


    public function get($post_id)
    {
        try {
            return ApiResponse::success('likes were retrieved successfully!',
                $this->likeService->get($post_id));
        } catch (\Exception $e) {
            return ApiResponse::failed($e->getMessage(), $e->getCode());
        }
    }
    public function add(LikeRequest $request)
    {
        try {
            return ApiResponse::success('like!', $this->likeService->add($request->validated()));
        } catch (\Exception $e) {
            return ApiResponse::failed("there's an error. try again later!", $e->getCode());
        }
    }

    public function delete($id)
    {
        try {
            return ApiResponse::success('unlike!', $this->likeService->delete($id));
        } catch (\Exception $e) {
            return ApiResponse::failed('failed to unlike post, try again later!', $e->getCode());
        }
    }

    public function likeStatus($post_id){
        try {
            return ApiResponse::success('like status received!', $this->likeService->likeStatus($post_id));
        } catch (\Exception $e) {
            return ApiResponse::failed($e->getMessage(), $e->getCode());
        }
    }
}
