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
  {{ Form::open(array('/profile/edit','POST','class'=>'form-horizontal', 'id'=>'thought-form' )) }}
  {{ Form::hidden('id', $id) }}
  <div class="form-group">
    <label class="thought-input-label" for="username">Username</label>
    {{ Form::text('username', $username,array('class'=>'form-control')) }}
  </div>
  <div class="form-group">
    <label class="thought-input-label" for="name">Name</label>
    {{ Form::text('name', $name,array('class'=>'form-control')) }}
  </div>
  <div class="form-group">
    <label class="thought-input-label" for="email">Email</label>
    {{ Form::email('email', $email,array('class'=>'form-control')) }}
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary pull-right">
      Submit
    </button>
  </div>
  {{ Form::close() }}
</div>
</div>
@stop
