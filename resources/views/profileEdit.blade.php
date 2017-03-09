@extends('master')
@section('title')
Edit Profile
@stop
@section('beforeContent')
<h1 id="site-logo">
  <a href="<?php echo URL::to('/'.$username);?>"><?php echo (sizeof($name)==0)?$name:$username;?></a>
</h1>
@stop
@section('content')
<div class="row">

<div class="thought-submission col-md-10 col-md-offset-1">
  <form role="form" class="form-horizontal" id="thought-form" action="/profile/edit" method="post">
    <input name="id" value="{{ $id }}" type="hidden">
    {{ csrf_field() }}
  <div class="form-group">
    <label class="thought-input-label" for="username">Username</label>
    <input name="username" value="{{ $username }}" type="string" class="form-control">
  </div>
  <div class="form-group">
    <label class="thought-input-label" for="name">Name</label>
    <input name="name" value="{{ $name }}" type="string" class="form-control">
  </div>
  <div class="form-group">
    <label class="thought-input-label" for="email">Email</label>
    <input name="email" value="{{ $email }}" type="string" class="form-control">
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary pull-right">
      Submit
    </button>
  </div>
</form>
</div>
</div>
@stop
