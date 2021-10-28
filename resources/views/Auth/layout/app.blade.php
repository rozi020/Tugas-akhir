<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title', 'Login')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Logo title -->
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/logo.png')}}">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/stisla.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  @stack('stylesheet')
</head>

<!-- Main Body -->
<body>
  <div id="app">
    @yield('content')
    @stack('modal')
  </div>

  <!-- Online JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" ></script>

  <!-- Offline JS File -->
  <script src="{{asset('assets/js/bootstrap-show-password.js')}}"></script>
  <script src="{{asset('assets/js/toastr.min.js')}}"></script>
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  @stack('javascript')

  <!-- Toaster -->
  <script>
    @if(Session::has('message'))
      toastr.success("{{ Session::get('message') }}");
    @elseif(Session::has('info'))
      toastr.info("{{ Session::get('info') }}");
    @elseif(Session::has('bye'))
      toastr.error("{{ Session::get('bye') }}");
    @endif
  </script>

  <!-- Toastr Validation -->
  <script>
    @if($errors->any())
      @foreach($errors->all() as $error)
        toastr.error("{{ $error }}");
      @endforeach
    @endif
  </script>

</body>
</html>