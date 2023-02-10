@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Progile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <img src="https://api.dicebear.com/5.x/adventurer/svg?seed={{Auth::user()->avatar ?? Auth::user()->name}}" id="img">
                    <form action="{{route('profile.update')}}" method="POST">
                        @csrf
                        <label>seed</label>
                        <input type="text" class="form-control" name="url" id="random-input">
                        <button type="submit" class="btn btn-primary rounded-pill my-3 px-3 py-2">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let input = document.getElementById("random-input");
    input.addEventListener("keyup", function (e){
        console.log(e.target.value);
        let img = document.getElementById("img");
        img.src = `https://api.dicebear.com/5.x/adventurer/svg?seed=${e.target.value}`
    });
</script>

@endsection
