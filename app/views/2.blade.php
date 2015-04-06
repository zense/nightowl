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
            <em>— <a href="<?php echo URL::to('/'.$value->name); ?>">{{ $value->name }}</a></em>
          </span>
        </div>
      </div>
        @endforeach    
    </div>
  </div>

  <hr>

  <div class="row">
    
        


<div class="thought-submission col-md-10 col-md-offset-1">
  <form role="form" class="form-horizontal" id="thought-form" action="/ux/" method="post">

      



  <input name="name" value="<?php echo $name;?>" type="hidden">



      

<div>
  
</div>


      <div class="form-group">
        <label for="content" class="thought-input-label">Your Thoughts</label>
        <textarea id="content" name="code" class="form-control" placeholder="Your Thoughts..." rows="5"></textarea>
        
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary pull-right">
          Submit
        </button>
      </div>

  </form>
</div>

      
  </div>
  <div class="row text-center">
  </div>

  <hr>

  
<div class="row user-info">
  <div class="col-md-12">
    <h3>Who You Are</h3>
    <div>You are <a href="<?php echo URL::to('/profile'); ?>"><?php echo $name;?></a></div>
    
      <div>
        You should bookmark this link: <a href="<?php echo User::getURL($id); ?>"><?php echo User::getURL($id); ?></a> as it is your
        identity here, and the key to your personalised feed. Don't share your identity
        with anyone else.
      </div>
    
    <h3>Where You Are</h3>
    <div>
      <p>
        Owl is a network of anonymous people sharing their thoughts. You may post
        any number of thoughts per day, which will be included in other peoples feeds.
      </p>
      <p>Please don't post spam or abusive content here.</p>
    </div>
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
  

</body></html>
