<!--BISMILLAHI-->

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
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            <!-- sidebar -->
            @include('includes._dashboard')
            <!-- page-content -->
            <div id="page-content-wrapper">
                @include('includes._navbar-dashboard')
                @yield('content')
            </div>
        </div>
    </div>
    @include('includes._scripts')
    @stack('scripts')
  </body>
</html>
