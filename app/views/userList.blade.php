@extends('master')
@section('title')
Users
@stop
@section('content')
  <div class="thought-list row">
    <div class="col-md-10 col-md-offset-1">
        @foreach($users as $user)
        <div class="thought ">
          <div class="thought-content text-center">
            <a href="<?php echo URL::to('/'.$user->username); ?>">{{ $user->username }}</a>
          </div>
        </div>
          @endforeach
    </div>
  </div>
@stop
