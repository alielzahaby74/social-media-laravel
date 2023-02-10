@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('user.post')}}" method="POST" id="post-form">
                        @csrf
                        <textarea class="form-control" rows="5" placeholder="What's on your mind?..." name="content" id="rich"></textarea>
                        <button class="btn btn-dark my-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Friends') }}</div>

                <div class="card-body">


                    <form action="{{route('friend.add')}}" method="POST">
                        @csrf
                        <input type="text" class="form-control" name="friend_id">
                        <button class="btn btn-dark my-3">Submit</button>
                    </form>
                        @if(!empty($friend_requests))
                            @foreach($friend_requests as $f_request)
                                @if($f_request->status == 'pending')
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-4">
                                                <img src="https://api.dicebear.com/5.x/adventurer/svg?seed={{$f_request->user->avatar ?? $f_request->user->name}}" alt="">
                                            </div>
                                            <div class="col-8">
                                                <p class="m-0 fw-bold">{{$f_request->user->name}}</p>
                                                <p class="text-muted">{{$f_request->user->email}}</p>
                                            </div>
                                            <div class="buttons w-auto m-auto d-flex">

                                                <form action="{{route('friend.accept')}}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="f_req_id" value="{{$f_request->id}}">
                                                    <button class="btn btn-success mx-2">Accept</button>
                                                </form>
                                                <form action="{{route('friend.reject')}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="f_req_id" value="{{$f_request->id}}">
                                                    <button class="btn btn-danger">Reject</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @endforeach
                        @endif



                </div>
            </div>


        </div>

    </div>


    @foreach($posts as $post)
        <x-post :post="$post"/>
    @endforeach
</div>
    @push('js')
        var editor1 = new RichTextEditor("#rich");
    @endpush
@endsection
