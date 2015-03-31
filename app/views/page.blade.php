<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>
</head>
<body>
	<div class="welcome">
    <a href="http://laravel.com" title="Laravel PHP Framework">Hello 
<?php echo $name; ?> @ <?php echo $host; ?></a>
		@if ($errors->any())

<ul style="color:red;">

{{ implode('', $errors->all('<li>:message</li>')) }}

</ul>

@endif

@if (Session::has('message'))

<p>{{ Session::get('message') }}</p>

@endif
<ul>
    @foreach($posts as $key => $value)
<li>{{ $value->name }} and {{ $value->code }}</li>
    @endforeach
</ul>
		    {{ Form::open(array('url' => '/ux')) }}
<input type="hidden" name="name" value="<?php echo $name;?>"></input>
 
        <p>Text :</p>
 
        <p>{{ Form::text('code') }}</p>
 
        <p>{{ Form::submit('Submit') }}</p>
 
    {{ Form::close() }}
	</div>
</body>
</html>
