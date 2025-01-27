Utilisateurs/layouts/Template.blade :

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
  
  <!-- Ajout du style pour le sidebar-->
  <style>
    /* Ajoutez ces styles pour gérer l'affichage de la sidebar */
    .sidebar-offcanvas {
     transition: all 0.3s ease;
   }

   .sidebar-offcanvas.active {
     margin-left: 0;
   }

   /* Masquer la barre latérale sur les petits écrans */
    @media (max-width: 991px) {
        .sidebar-offcanvas {
            margin-left: -240px;
        }

        h1, h3, h4, h5, h6 {
          font-size: 30px;
        }

         .sidebar-offcanvas.active {
          margin-left: 0;
        }
        /* Le bouton pour afficher le menu sur les petits écrans */
        .navbar .navbar-menu-wrapper .btn-navbar-menu {
            display: inline-block;
        }
    }
    
      /* Ajouter la logique pour le bouton qui affiche le menu sur mobile */
    .navbar .navbar-menu-wrapper .btn-navbar-menu {
        display: none;
        background: none;
        border: none;
        padding: 0;
        font-size: 24px;
        cursor: pointer;
    }


    .page-body-wrapper {
        display: flex;
        flex-direction: row;
    }
   .main-panel {
    flex: 1;
   }
  </style>
</head>
<body>
    <!-- partial:partials/_navbar.html -->
   @include('utilisateur.layouts.navigation')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
       <!-- Bouton pour afficher le menu sur les petits écrans -->
       <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center btn-navbar-menu" type="button" data-toggle="offcanvas">
       <span class="mdi mdi-menu"></span>
      </button>
      
      
      <div class="sidebar sidebar-offcanvas" id="sidebar">
         @include('utilisateur.layouts.sidebar')
       </div>
       
        <div class="main-panel">
         @yield('content')
       </div>
      
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
    <script>
        // Ajoute ce script pour gérer l'affichage de la barre latérale sur mobile
        (function($) {
            'use strict';
            $(function() {
                $('.btn-navbar-menu').on('click', function(e) {
                    e.preventDefault();
                    $('body').toggleClass('sidebar-icon-only');
                    $('#sidebar').toggleClass('active'); // Ajoutez ou supprimez la classe active
                });
            });
        })(jQuery);
    </script>
  <!-- End custom js for this page-->
</body>

</html>