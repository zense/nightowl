@extends('master')
@section('title')
Posts
@stop
@section('content')
  <div class="thought-list row">
    <div class="col-md-10 col-md-offset-1">
        @foreach($posts as $value)
      <div class="thought ">
        <div class="thought-content text-center">{{{ $value->text }}}</div>
        <div class="thought-footer">
          <span class="pull-right">
            <em>— <a href="<?php echo URL::to('/'.$value->author->username); ?>">{{{ $value->author->username }}}</a></em>
          </span>
        </div>
      </div>
        @endforeach
    </div>
  </div>
@stop
