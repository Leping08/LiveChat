@extends('layouts.app')

@section('content')
    <div>
        <chat-component :auth_user="{{Auth::user()}}"></chat-component>
    </div>
@endsection
