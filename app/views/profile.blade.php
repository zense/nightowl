<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title><?php echo (sizeof($name)==0)?$name:$username;?> | NightOwl</title>

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
              <a href="<?php echo URL::to('/'.$username);?>"><?php echo (empty($name))?$username:$name;?></a>
            @if ($following == 1)
            <button type="button" id="follow" class="btn btn-success">Following</button>
            @elseif ($following == 0)
            <button type="button" id="follow" class="btn btn-primary">Follow</button>
            @else
            <a type="button" id="edit" class="btn btn-primary" href="profile/edit">Edit Profile</a>
            @endif
              </h1>

            <h3>
            <a href="<?php echo URL::to('/'.$username);?>" class="thought-input-label">@<?php echo $username; ?></a>
            @if ($following == -1)
            <a class="thought-input-label" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
            @endif
            </h3>
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
  <h4>Thoughts</h4>
  <hr>
  <div class="thought-list row">
    <div class="col-md-10 col-md-offset-1">
        @foreach($posts as $key => $value)
      <div class="thought ">
        <div class="thought-content text-center">{{ $value->text }}</div>
        <div class="thought-footer">
          <span class="pull-right">
            <em>— {{ $value->updated_at }}</em>
          </span>
        </div>
      </div>
        @endforeach
    </div>
  </div>

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

    <script type="text/javascript">
        $("#follow").click(function(e){
          e.preventDefault();
          if($('#follow').html() == 'Follow'){
            $.getJSON('<?php echo URL::to('/'.$username);?>/follow',function(data){
              console.log(data);
              if(data.status == 1){
                $('#follow').html('Following').attr('class','btn btn-success');
              }
            });
          }else{
            $.getJSON('<?php echo URL::to('/'.$username);?>/unfollow',function(data){
              console.log(data);
              if(data.status == 1){
                $('#follow').html('Follow').attr('class','btn btn-primary');
              }
            });
          }
        });
    </script>
</body></html>
