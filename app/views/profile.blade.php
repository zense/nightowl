@extends('master')
@section('title')
<?php echo (empty($name))?$username:$name;?>
@stop
@section('beforeContent')
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
@stop
@section('content')
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
@stop
@section('scripts')
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
@stop
