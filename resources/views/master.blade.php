<!DOCTYPE html>
<html>
<head>
  <title>@yield('title') | NightOwl</title>
  @include('partials.head')
</head>

<body>
  <div class="container-fluid" id="main-container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        @include('partials.header')
        <div class="row" id="main-content">
          <div class="col-md-12">
          @yield('beforeContent')
          <hr>
          @yield('content')
          @include('partials.footer')
          </div>
        </div>
      </div>
    </div>
  </div>
  @yield('scripts')
  @include('partials.scripts')
</body>
</html>
