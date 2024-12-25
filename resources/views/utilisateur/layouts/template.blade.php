<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin2 </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets3/css/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets3/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets3/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets3/css/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets3/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets3/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
 
  <link rel="stylesheet" href="{{ asset('assets3/css/select.dataTables.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets3/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">
      <div class="col-md-12 p-0 m-0">
        <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
          <div class="ps-lg-1">
            <div class="d-flex align-items-center justify-content-between">
              <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
              <a href="https://therichpost.com/" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <a href="https://therichpost.com/"><i class="mdi mdi-home me-3 text-white"></i></a>
            <button id="bannerClose" class="btn border-0 p-0">
              <i class="mdi mdi-close text-white me-0"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- partial:partials/_navbar.html -->
   @include('utilisateur.layouts.navigation')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      @include('utilisateur.layouts.sidebar')
      @yield('content')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('assets3/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page --
  <script src="js/Chart.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('assets3/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets3/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets3/js/template.js') }}"></script>
  <script src="{{ asset('assets3/js/settings.js') }}"></script>
  <script src="{{ asset('assets3/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('assets3/js/jquery.cookie.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets3/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets3/js/Chart.roundedBarCharts.js') }}"></script>
  <!-- End custom js for this page-->
</body>

</html>