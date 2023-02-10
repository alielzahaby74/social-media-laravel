<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\Post;
use Illuminate\Http\Request;
use Psy\Util\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $friend_requests = Friends::where('friend_id', auth()->id())->get();
        return view('home', compact('posts', 'friend_requests'));
    }

    public function edit()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->avatar = $request['url'];
        $user->save();
        return view('profile');
    }
}
