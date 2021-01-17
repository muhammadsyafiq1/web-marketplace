<!--BISMILLAHI-->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport"content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Success Belanja</title>

    @include('includes._styles')
  </head>

  <body>

    <div class="page-content page-success">
        <div class="section-success" data-aos="zoom-in">
            <div class="container">
                <div class="row align-items-center row-login justify-content-center">
                    <div class="col-lg-6 text-center">
                        <img src="/frontend/images/success.svg" class="mb-4">
                        <h2>
                            Transaction Processed!
                        </h2>
                        <p>
                            Silahkan tunggu konfirmasi email dari kami dan
                            kami akan menginformasikan resi secepat mungkin!
                        </p>  
                        <div>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-success w-50 mt-4">
                                My Dashbord
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-signup w-50 mt-2">
                                Go to Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    @include('includes._footer')
    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.slim.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="scripts/navbar-scroll.js"></script>
  </body>
</html>