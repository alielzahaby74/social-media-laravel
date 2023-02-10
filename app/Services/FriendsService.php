<?php


namespace App\Services;


use App\Models\Friends;

class FriendsService
{
    public function get()
    {
        $friends = Friends::select('id', 'user_id', 'friend_id', 'status')->where('user_id', auth()->id())->orWhere('friend_id', auth()->id())->paginate(10);
        return $friends;
    }

    public function add($id)
    {
//        dd($this->isRequestSent($id));
        if($this->isRequestSent($id))
            return throw new \Exception('you have already sent a request!');
        $friend = Friends::create([
            'user_id' => auth()->id(),
            'friend_id' => $id
        ]);

        return;
    }

    public function accept($data)
    {
        $f_request = Friends::where('id', $data['f_req_id'])->first();
//        dd($f_request);
        if(empty($f_request) || $f_request->status == 'accept')
            return throw new \Exception('you cannot accept that request maybe try to send a new one!');
        $f_request->status = 'accept';
        $f_request->save();
        return $f_request;
    }

    public function reject($data)
    {
        $f_request = Friends::where('id', $data['f_req_id'])->first();
        if(empty($f_request))
            return throw new \Exception('request already been rejected!');
        Friends::destroy($data['f_req_id']);
        return;
    }

    public function isRequestSent($id)
    {
        if(!empty(Friends::where('user_id', auth()->id())->where('friend_id', $id)->first())|| !empty(Friends::where('user_id', $id)->where('friend_id', auth()->id())->first()))
            return true;
        return false;
    }
}
