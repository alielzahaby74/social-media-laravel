<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\FollowerService;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    private $followerService;
    public function __construct()
    {
        $this->followerService = new FollowerService();
    }

    public function following()
    {
        try {
            return ApiResponse::success("following retrieved", $this->followerService->following());
        } catch (\Exception $e) {
            return ApiResponse::failed($e->getMessage(), $e->getCode());
        }
    }

    public function followers()
    {
        try {
            return ApiResponse::success("followers retrieved", $this->followerService->followers());
        } catch (\Exception $e) {
            return ApiResponse::failed($e->getMessage(), $e->getCode());
        }
    }

    public function add($id)
    {
        try {
            return ApiResponse::success("you are now following", $this->followerService->add($id), 201);
        } catch (\Exception $e) {
            return ApiResponse::failed($e->getMessage(), $e->getCode());
        }
    }

    public function delete($id)
    {
        try {
            return ApiResponse::success("you are now following", $this->followerService->delete($id), 201);
        } catch (\Exception $e) {
            return ApiResponse::failed($e->getMessage(), $e->getCode());
        }
    }

    public function followStatus($id)
    {
        try {
            return ApiResponse::success("follow status!", $this->followerService->followStatus($id));
        } catch (\Exception $e) {
            return ApiResponse::failed($e->getMessage(), $e->getCode());
        }
    }
}
