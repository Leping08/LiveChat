@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-header">{{ Auth::user()->name }}</div>
                </div>

            </div>
        </div>
    </div>
@endsection
