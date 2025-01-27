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
</head>
<style>
   @media (max-width: 768px) {
            .form-background {
                padding: 10px;
            }

            .card-title-dash {
                font-size: 1.2rem;
            }

            .btn-lg {
                font-size: 0.9rem;
                padding: 0.5rem 1rem;
            }

            .table th, .table td {
                font-size: 0.75rem;
                padding: 0.2rem;
            }

            .table img {
                width: 50px;
            }

            /* Important : Gestion de l'alignement des boutons */
            .d-sm-flex {
                flex-direction: column !important;
                align-items: start !important;
            }

            .d-sm-flex > div:last-child {
                margin-top: 10px;
            }

            .nav-tabs .nav-link {
                padding: 0.5rem 0.7rem;
            }
        }

        /* Ajustement des images dans les tableaux pour les petits écrans */
        .table img {
            max-width: 70px;
            height: auto;
        }
        
         /* Modification de la modal pour un affichage vertical sur mobile */
       
       @media (max-width: 768px) {
        .modal.fade .modal-dialog {
            transform: translateY(-50%); /* Déplace vers le haut */
            transition: transform 0.3s ease-out; /* Applique la transition */
              top: 15%; /* Position verticale initial de la modal */
          }
      
         .modal.show .modal-dialog {
            transform: translateY(0); /* Ramène la modal à sa position visible */
           
         }
        .modal-dialog {
           display: flex;
           align-items: flex-start;
           
       }
        .modal-content {
            width: 100%;
            height: 100%;
            border-radius: 0;
        }
        .modal-body {
            flex: 1 1 auto;
            padding: 1rem;
            overflow-y: auto;
        }
        .modal-header {
            flex: 0 0 auto;
            padding: 1rem;
        }
        .modal-footer {
            flex: 0 0 auto;
            padding: 1rem;
        }
    }
    /* Fin de la modification de la modal pour un affichage vertical sur mobile */
</style>
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