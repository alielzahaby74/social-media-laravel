<div class="row my-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <p class="post-name fs-2 fw-bold m-0">{{$post->user->name}}</p>
                <p class="text-muted fs-6">{{$post->user->created_at}}</p>
            </div>
            <div class="card-body">
                <div class="post my-3">

                    {!! $post->content !!}
                    <div>
                        <a class="btn btn-danger" href="{{route('user.delete', $post->id)}}">
                            <i class="fa fa-trash"></i>
                        </a>
                        <a class="btn btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
