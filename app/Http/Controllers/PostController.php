<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function post(Request $request)
    {
        Post::create([
            'content' => $request['content'],
            'user_id' => auth()->id()
        ]);
        return redirect()->route('home');
    }

    public function delete($id)
    {
        $post = Post::where('id', $id)->first();
        if($post->user_id != auth()->id())
            abort(403);
        Post::destroy($id);
        return redirect()->route('home');
    }
}
