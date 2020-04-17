<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>To-Do List</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
  <div id="app">
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
          </a>
        </div>

       
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url('/add') }}">Add Task</a></li>
            <li><a href="{{ url('/') }}">All Tasks</a></li>
          </ul>
         

      </div>
    </nav>

    @yield('content')
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('script')
</body>

</html>