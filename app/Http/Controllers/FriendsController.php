<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\FriendRequest;
use App\Models\Friends;
use App\Services\FriendsService;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    private $apiResponse;
    private  $friendsService;
    public function __construct(ApiResponse $apiResponse, FriendsService $friendsService)
    {
        $this->apiResponse = $apiResponse;
        $this->friendsService = $friendsService;
    }

    public function get()
    {
        try {
            return $this->apiResponse->success('Friends fetched successfully!', $this->friendsService->get());
        }   catch (\Exception $e) {
            return $this->apiResponse->failed($e->getMessage());
        }

    }


    public function add($id)
    {
        try {
            return $this->apiResponse->success('Friend request sent successfully!', $this->friendsService->add($id));
        }   catch (\Exception $e) {
            return $this->apiResponse->failed($e->getMessage());
        }
    }



    public function accept(FriendRequest $request)
    {
        try {
            return $this->apiResponse->success('Friend request was accepted!', $this->friendsService->accept($request->validated()));
        }   catch (\Exception $e) {
            return $this->apiResponse->failed($e->getMessage());
        }
    }

    public function reject(FriendRequest $request)
    {
        try {
            return $this->apiResponse->success('Friend request was accepted!', $this->friendsService->reject($request->validated()));
        }   catch (\Exception $e) {
            return $this->apiResponse->failed($e->getMessage());
        }
    }

}
