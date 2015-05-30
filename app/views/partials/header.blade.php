<div id="header" class="row text-center">
  <h1 id="site-logo">
    <a href="/">NightOwl</a>
  </h1>
</div>

<div id="flash">
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

</div>
