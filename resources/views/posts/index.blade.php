@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($posts as $post)
                    <div class="card border-success mt-3">
                        <div class="card-header"><a href="{{{$post->path()}}}">{{$post->title}}</a></div>

                        <div class="card-body">
                            {{$post->body}}
                        </div>
                    </div>
                @endforeach


                @if(Auth::check())
                        <div class="card mt-3">
                            <div class="card-body">
                                <form action="" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_id" value="{{{Auth::user()->id}}}">
                                    <div class="form-group">
                                        <label for="inputEmail4">Title</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail4">Body</label>
                                        <textarea class="form-control" id="body" name="body" rows="3" required>{{ old('body') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">create inspiration</button>
                                </form>
                            </div>
                        </div>
                    @endif

                    <div class="mt-3">
                        {{ $posts->links() }}
                    </div>
            </div>
        </div>
    </div>
@endsection
