<?php


namespace App\Services;


use App\Models\Follower;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostService
{

    public function posts()
    {
        $following = Follower::where('follow_id', auth()->id())->pluck('user_id');
        $posts = Post::whereIn('user_id', $following)->paginate(10);
        return $posts;
    }

    public function post($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if ($post == null)
            return throw new \Exception("this post doesn't exist", 404);
        return $post;
    }
    public function add($data)
    {
        $post = Post::create([
            'content' => $data['content'],
            'user_id' => auth()->id()
        ]);

        return $post;
    }

    public function delete($id)
    {
        $post = Post::where('id', $id)->first();
        if ($post == null)
            return throw new \Exception("post unavailable!",404);
        if($post->user_id != auth()->id())
            return throw new \Exception("you can only delete your posts!", 403);
        Post::destroy($id);
        return response()->noContent();
    }
}
