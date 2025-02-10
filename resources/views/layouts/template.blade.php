<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>E-ci</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets3/css/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets3/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets3/css/themify-icons.css') }}">
  <link rel="icon" href="{{ asset('assets/images/profiles/E-ci-logo.png') }}">
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