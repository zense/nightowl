<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Edit Profile | NightOwl</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link rel="stylesheet" media="screen" href="/css/main.css">
    <link rel="stylesheet" media="screen" href="/css/bootstrap.css">

    <!-- Favicon-->
    <link rel="shortcut icon" type="image/png" href="">

    <!-- Javascript -->
    <script src="/js/jquery-2.js" type="text/javascript"></script>
    <script src="/js/bootstrap.js" type="text/javascript"></script>
    <script src="/js/hello.js" type="text/javascript"></script>
  </head>

  <body>
    <div class="container-fluid" id="main-container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">

          <div id="header" class="row text-center">
            <h1 id="site-logo">
              <a href="/">NightOwl</a>
            </h1>
          </div>

          <div id="flash">


          </div>

          <div class="row" id="main-content">
            <div class="col-md-12">
	    <h1 id="site-logo">
              <a href="<?php echo URL::to('/'.$username);?>"><?php echo (sizeof($name)==0)?$name:$username;?></a>
            </h1>
@if ($errors->any())
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{ implode('', $errors->all(message)) }}
</div>
@endif

@if (Session::has('message'))
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <p>{{ Session::get('message') }}</p>
</div>
@endif

<hr>

<div class="row">

<div class="thought-submission col-md-10 col-md-offset-1">

  {{ Form::open(array('/profile/edit','POST','class'=>'form-horizontal', 'id'=>'thought-form' )) }}
  {{ Form::hidden('id', $id) }}
  <div class="form-group">
  <label class="thought-input-label" for="username">Username</label>  {{ Form::text('username', $username,array('class'=>'form-control')) }}
  </div>
  <div class="form-group">
  <label class="thought-input-label" for="name">Name</label>  {{ Form::text('name', $name,array('class'=>'form-control')) }}
  </div>
  <div class="form-group">
  <label class="thought-input-label" for="email">Email</label>  {{ Form::email('email', $email,array('class'=>'form-control')) }}
  </div>
  <div class="form-group">
      <button type="submit" class="btn btn-primary pull-right">
        Submit
      </button>
  {{ Form::close() }}
  </div>
</div>


</div>


  <hr>
          <div class="row" id="site-footer">
            <div class="col-md-12">
              <hr>
              <span>
                <a href="<?php echo URL::to('/about'); ?>">About</a>
              </span>
              <span>
                <a href="<?php echo URL::to('/blog'); ?>" target="_blank">Blog</a>
              </span>
            </div>
          </div>

        </div>
      </div>
    </div>


</body></html>
