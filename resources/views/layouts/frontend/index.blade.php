<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @include('includes._styles')
  </head>

  <body>

    <!-- nav -->
    @include('includes._navbar')

    <!-- page content -->
    @yield('content')

    <!-- footer -->
    @include('includes._footer')
    <!-- Bootstrap core JavaScript -->
    @include('includes._scripts')
    @stack('scripts')
  </body>
</html>
