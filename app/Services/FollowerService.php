<?php


namespace App\Services;


use App\Models\Follower;

class FollowerService
{

    public function following()
    {
        $following = Follower::where('follow_id', auth()->id());
        return $following;
    }

    public function followers()
    {
        $followers = Follower::where('user_id', auth()->id());
        return $followers;
    }

    public function add($follow_id)
    {
        if (auth()->id() == $follow_id)
            throw new \Exception("you cannot follow yourself!", 304);
        $follow = Follower::where('user_id', auth()->id())->where('follow_id', $follow_id)->first();
        if ($follow != null)
            throw new \Exception("you've already followed this person!", 500);

        return Follower::create([
            'user_id' => auth()->id(),
            'follow_id' => $follow_id
        ]);
    }

    public function delete($follow_id)
    {
        $follow = Follower::where('user_id', auth()->id())->where('follow_id', $follow_id)->first();
        if($follow == null)
            return throw new \Exception('you are already not following this user');
        return Follower::destroy($follow->id);
    }

    public function followStatus($id)
    {
        $follower = Follower::where('user_id', auth()->id())->where('follow_id', $id)->first();
        return $follower != null;
    }
}
