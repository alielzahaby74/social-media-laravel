<?php


namespace App\Services;


use App\Models\Like;
use App\Models\Post;

class LikeService
{
    public function get($post_id)
    {
//        dd($data);
        $likes = Like::where('post_id', $post_id)->paginate(10);
        if ($likes == null){
            return throw new \Exception("there's no likes on this post");
        }
        return $likes;
    }
    public function add($data)
    {
        $like = Like::where('user_id', auth()->id())->where('post_id', $data['post_id'])->first();
        if ($like != null) {
            return throw new \Exception('you can only like a post once!');
        }
        $like = Like::create([
            'user_id' => auth()->id(),
            'post_id' => $data['post_id']
        ]);

        return $like;
    }

    public function delete($id)
    {
        $like = Like::where('id', $id)->first();
        if($like->user_id != auth()->id())
            return throw new \Exception("you can only delete your likes!");
        Like::destroy($id);
    }
}
