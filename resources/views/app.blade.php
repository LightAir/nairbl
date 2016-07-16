<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href=""> -->
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/assets/css/main.css" type="text/css" charset="utf-8">
    @yield('css')
  </head>
  <body>

    @yield('content')

    <script src="/assets/js/jquery.js" type="text/javascript"></script>
    <script src="/assets/js/bootstrap.js" type="text/javascript"></script>
    <script src="/assets/js/vue.js" type="text/javascript"></script>
    @yield('js')
    <script src="/assets/js/all.js" type="text/javascript"></script>
  </body
</html>
