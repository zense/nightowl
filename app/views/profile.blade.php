<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>NightOwl | Feed</title>

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
              <a href="/">My Profile</a>
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

  <div class="thought-list row">
    <div class="col-md-10 col-md-offset-1">
        @foreach($posts as $key => $value) 
      <div class="thought ">
        <div class="thought-content text-center">{{ $value->code }}</div>
        <div class="thought-footer">
          <span class="pull-right">
            <em>— {{ $value->timestamp }}</em>
          </span>
        </div>
      </div>
        @endforeach    
    </div>
  </div>

  <hr>
  
<div class="row user-info">
  <div class="col-md-12">
    <h3>Who You Are</h3>
    <div>You are <?php echo $name;?></div>
    
      <div>
        You should bookmark this link: <a href="<?php echo Request::Url(); ?>"><?php echo Request::Url(); ?></a> as it is your
        identity here, and the key to your personalised feed. Don't share your identity
        with anyone else.
      </div>
    
    <h3>Where You Are</h3>
    <div>
      <p>
        Owl is a network of anonymous people sharing their thoughts. Every day at
        03:00:00 UTC a new feed of thoughts is randomly generated for you. You may post
        one thought per day, which will be included in other peoples feeds.
      </p>
      <p>Please don't post spam or abusive content here.</p>
    </div>
  </div>
</div>


  <hr>

          <div class="row" id="site-footer">
            <div class="col-md-12">
              <hr>
              <span>
                <a href="https://zense-proxy.appspot.com/nightOwl.com/about">About</a>
              </span>
              <span>
                <a href="https://zense-proxy.appspot.com/nightOwl.tumblr.com" target="_blank">Blog</a>
              </span>
            </div>
          </div>

        </div>
      </div>
    </div>
  

</body></html>
