<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>SNetwork</title>
  </head>
  
  <body style="overflow-x:hidden">

  <div style="background-size: cover; background-color: #FEF6F6; position: absolute; min-height: 100vh; 
  width: 100vw; ">
    @include('layouts.block.nav')

    <div class="container">
      @include('layouts.block.info')
      @yield('content')
    </div>
  </div>

  </body>
</html>