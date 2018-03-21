@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-header"><a href="{{{$post->path()}}}">{{$post->title}}</a></div>

                    <div class="card-body">
                        {{$post->body}}
                    </div>
                </div>


                @foreach($post->Comments as $comment)
                    <div class="card mt-3">
                        <div class="card-header">
                            <div class="text-muted">{{$comment->author()}}</div>
                        </div>

                        <div class="card-body">
                            {{$comment->body}}
                        </div>
                    </div>
                @endforeach


                @if(Auth::check())
                    <div class="card mt-3">
                        <div class="card-header">Reply</div>

                        <div class="card-body">
                            <form action="" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{{Auth::user()->id}}}">
                                <input type="hidden" name="post_id" value="{{{$post->id}}}">
                                <div class="form-group">
                                    <textarea class="form-control" id="body" name="body" rows="3" required>{{ old('body') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">add sass</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
