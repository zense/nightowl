@extends('master')
@section('title')
Feed
@stop
@section('content')
  <div class="thought-list row">
    <div class="col-md-10 col-md-offset-1">
        @foreach($posts as $key => $value)
      <div class="thought ">
        <div class="thought-content text-left">{{{ $value->text }}}</div>

        {{{ $value->upvotes }}}
        <a type="button" class="btn btn-default btn-sm" id='{{{ $value->id }}}a' onclick="uVote('{{{ $value->id }}}a');" href="/upvote/{{{ $value->id}}}">
          <image img src="/images/like.png" alt="Logo" height='20' breadth='20'></image> Upvote
          <script type="text/javascript">
            function uVote(id)
            { 
              var elem = document.getElementById(id);
              if (elem.innerHTML=="Upvoted") 
              {
                elem.innerHTML = "Upvote";
              }
              else 
              {
                  elem.innerHTML = "Upvoted";

              }
            }
          </script>
        </a>

        {{{ $value->downvotes }}}
        <button type="button" class="btn btn-default btn-sm" id='{{{ $value->id }}}b' onclick="dVote('{{{ $value->id }}}b' );">
          <image img src="/images/dislike.png" alt="Logo" height='20' breadth='20'></image>Downvote
           <script type="text/javascript">
            function dVote(id) 
            { 
              var elem = document.getElementById(id);
              if (elem.innerHTML=="Downvoted") 
              {
                elem.innerHTML = "Downvote";
                elem.src="/images/like.png";

              }
              else
              {
                 elem.innerHTML = "Downvoted";
                 elem.src="/images/like.png";
              }
            }
          </script>
        </button>

        <div class="thought-footer">
          <span class="pull-right ">
            <em>— <a href="<?php echo URL::to('/'.$value->author->username); ?>">{{{ $value->author->username }}}</a></em>
          </span>
        </div>
      </div>
        @endforeach
    </div>
  </div>

  <hr>

  <div class="row">
    <div class="thought-submission col-md-10 col-md-offset-1">
      <form role="form" class="form-horizontal" id="thought-form" action="/" method="post">
        <input name="username" value="{{ $username }}" type="hidden">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="content" class="thought-input-label">Your Thoughts</label>
          <textarea id="content" name="text" class="form-control" placeholder="Your Thoughts..." rows="5"></textarea>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary pull-right">
            Submit
          </button>
        </div>

      </form>
    </div>
  </div>

  <hr>


<div class="row user-info">
  <div class="col-md-12">
    <h3>Who You Are</h3>
    <div>You are <a href="<?php echo URL::to('/profile'); ?>">{{{ $username }}}</a></div>

      <div>
        You should bookmark this link: <a href="<?php echo $url; ?>"><?php echo $url; ?></a> as it is your
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
@stop