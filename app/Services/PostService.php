<?php


namespace App\Services;


use App\Models\Post;

class PostService
{
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
        if($post->user_id != auth()->id())
            return throw new \Exception("you can only delete your posts!");
        Post::destroy($id);
    }
}
