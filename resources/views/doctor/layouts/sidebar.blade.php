<aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">
    <!-- Logo -->
    <div class="logo-sn ms-d-block-lg">
      <div style="background-color:azure; margin-top:10px"><a class="pl-0 ml-0 text-center" href="index.html"> {{ Auth::guard('doctor')->user()->nomHop }} </a></div><br>
      <a href="{{ route('doctor.dashboard') }}" class="text-center ms-logo-img-link"> <img class="ms-user-img ms-img-round" style=" width: 70px; /* Taille du cercle */
        height: 70px; /* Taille du cercle */
        border-radius: 55%; /* Cela rend l'image ronde */
        object-fit: cover;" src="{{ asset('storage/' . (Auth::guard('doctor')->user()->profile_picture ?? 'default-profile.png')) }}" alt="Profile Picture"></a>
      <h5 class="text-center text-white mt-2">{{ Auth::guard('doctor')->user()->name ?? 'Alain'  }}</h5>
      
    </div>
    <!-- Navigation -->
    <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
      <!-- Dashboard -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#dashboard" aria-expanded="false" aria-controls="dashboard">
          <span><i class="material-icons fs-16">dashboard</i>Dashboard </span>
        </a>
        <ul id="dashboard" class="collapse" aria-labelledby="dashboard" data-parent="#side-nav-accordion">
          <li> <a href="{{ route('doctor.dashboard') }}">E-Côte d'Ivoire</a> </li>
        </ul>
      </li>
      <!-- /Dashboard -->
      <!-- Doctor -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#doctor" aria-expanded="false" aria-controls="doctor">
          <span><i class="fas fa-stethoscope"></i>Docteur</span>
        </a>
        <ul id="doctor" class="collapse" aria-labelledby="doctor" data-parent="#side-nav-accordion">
          <li> <a href="{{ route('doctor.create') }}">Ajouter Docteur</a> </li>
          <li> <a href="{{ route('doctor.index') }}">Liste Docteur</a> </li>
        </ul>
      </li>
      <!-- Doctor -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#schedule" aria-expanded="false" aria-controls="schedule">
          <span><i class="fas fa-list-alt"></i>Statistique</span>
        </a>
        <ul id="schedule" class="collapse" aria-labelledby="schedule" data-parent="#side-nav-accordion">
          <li> <a href="{{ route('stats.superindex') }}">Statistique</a> </li>
        </ul>
      </li><br><br>
      <!-- /Schedule -->
      <!-- Appointment -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#appointment" aria-expanded="false" aria-controls="appointment">
          <span><i class="far fa-check-square"></i>Appointment</span>
        </a>
        <ul id="appointment" class="collapse" aria-labelledby="appointment" data-parent="#side-nav-accordion">
          <li> <a href="pages/appointment/add-appointment.html">Add Appointment</a> </li>
          <li> <a href="pages/appointment/appointment-list.html">Appointment List</a> </li>
        </ul>
      </li>
      <!-- /Appointment -->
      <!-- Payment -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#payment" aria-expanded="false" aria-controls="payment">
          <span><i class="fas fa-credit-card"></i>Payment</span>
        </a>
        <ul id="payment" class="collapse" aria-labelledby="payment" data-parent="#side-nav-accordion">
          <li> <a href="pages/payment/add-payment.html">Add Payment</a> </li>
          <li> <a href="pages/payment/payment-list.html">Payment List</a> </li>
          <li> <a href="pages/payment/payment-invoice.html">Payment Invoice</a> </li>
        </ul>
      </li>
      <!-- /Payment -->
      <!-- Report -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#report" aria-expanded="false" aria-controls="report">
          <span><i class="fas fa-file-alt"></i>Report</span>
        </a>
        <ul id="report" class="collapse" aria-labelledby="report" data-parent="#side-nav-accordion">
          <li> <a href="pages/report/patient-report.html">Patient Wise Report</a> </li>
          <li> <a href="pages/report/doctor-report.html">Doctor Wise Report</a> </li>
          <li> <a href="pages/report/total-report.html">Total Report</a> </li>
        </ul>
      </li>
      <!-- /Report -->
      <!-- Human Resource -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#human-resource" aria-expanded="false" aria-controls="human-resource">
          <span><i class="far fa-user-circle"></i>Human Resource</span>
        </a>
        <ul id="human-resource" class="collapse" aria-labelledby="human-resource" data-parent="#side-nav-accordion">
          <li> <a href="pages/human-resource/add-employee.html">Add Employee</a> </li>
          <li> <a href="pages/human-resource/employee-list.html">Employee List</a> </li>
          <li> <a href="pages/human-resource/add-nurse.html">Add Nurse</a> </li>
          <li> <a href="pages/human-resource/nurse-list.html">Nurse List</a> </li>
          <li> <a href="pages/human-resource/add-pharmacist.html">Add Pharmacist</a> </li>
          <li> <a href="pages/human-resource/pharmacist-list.html">Pharmacist List</a> </li>
          <li> <a href="pages/human-resource/add-representative.html">Add Representative</a> </li>
          <li> <a href="pages/human-resource/representative-list.html">Representative List</a> </li>
        </ul>
      </li>
      <!-- /Human Resource -->
      <!-- Bed -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#bed" aria-expanded="false" aria-controls="bed">
          <span><i class="fas fa-bed"></i>Bed Manager</span>
        </a>
        <ul id="bed" class="collapse" aria-labelledby="bed" data-parent="#side-nav-accordion">
          <li> <a href="pages/bed-manager/add-bed.html">Add Bed</a> </li>
          <li> <a href="pages/bed-manager/bed-list.html">Bed List</a> </li>
        </ul>
      </li>
      <!-- /Bed-->
      <!-- Notice -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#notice" aria-expanded="false" aria-controls="notice">
          <span><i class="far fa-file-alt"></i>Notice</span>
        </a>
        <ul id="notice" class="collapse" aria-labelledby="notice" data-parent="#side-nav-accordion">
          <li> <a href="pages/notice/add-notice.html">Add Notice</a> </li>
          <li> <a href="pages/notice/notice-list.html">Notice List</a> </li>
        </ul>
      </li>
      <!-- /Notice -->
      <li class="menu-item">
        <a href="pages/widgets.html">
          <span><i class="material-icons fs-16">widgets</i>Widgets</span>
        </a>
      </li>
      <!-- Basic UI Elements -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#basic-elements" aria-expanded="false" aria-controls="basic-elements">
          <span><i class="material-icons fs-16">filter_list</i>Basic UI Elements</span>
        </a>
        <ul id="basic-elements" class="collapse" aria-labelledby="basic-elements" data-parent="#side-nav-accordion">
          <li> <a href="pages/ui-basic/accordions.html">Accordions</a> </li>
          <li> <a href="pages/ui-basic/alerts.html">Alerts</a> </li>
          <li> <a href="pages/ui-basic/buttons.html">Buttons</a> </li>
          <li> <a href="pages/ui-basic/breadcrumbs.html">Breadcrumbs</a> </li>
          <li> <a href="pages/ui-basic/badges.html">Badges</a> </li>
          <li> <a href="pages/ui-basic/cards.html">Cards</a> </li>
          <li> <a href="pages/ui-basic/progress-bars.html">Progress Bars</a> </li>
          <li> <a href="pages/ui-basic/preloaders.html">Pre-loaders</a> </li>
          <li> <a href="pages/ui-basic/pagination.html">Pagination</a> </li>
          <li> <a href="pages/ui-basic/tabs.html">Tabs</a> </li>
          <li> <a href="pages/ui-basic/typography.html">Typography</a> </li>
        </ul>
      </li>
      <!-- /Basic UI Elements -->
      <!-- Advanced UI Elements -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#advanced-elements" aria-expanded="false" aria-controls="advanced-elements">
          <span><i class="material-icons fs-16">code</i>Advanced UI Elements</span>
        </a>
        <ul id="advanced-elements" class="collapse" aria-labelledby="advanced-elements" data-parent="#side-nav-accordion">
          <li> <a href="pages/ui-advanced/draggables.html">Draggables</a> </li>
          <li> <a href="pages/ui-advanced/sliders.html">Sliders</a> </li>
          <li> <a href="pages/ui-advanced/modals.html">Modals</a> </li>
          <li> <a href="pages/ui-advanced/rating.html">Rating</a> </li>
          <li> <a href="pages/ui-advanced/tour.html">Tour</a> </li>
          <li> <a href="pages/ui-advanced/cropper.html">Cropper</a> </li>
          <li> <a href="pages/ui-advanced/range-slider.html">Range Slider</a> </li>
        </ul>
      </li>
      <!-- /Advanced UI Elements -->
      <li class="menu-item">
        <a href="pages/animation.html">
          <span><i class="material-icons fs-16">format_paint</i>Animations</span>
        </a>
      </li>
      <!-- Form Elements -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <span><i class="material-icons fs-16">input</i>Form Elements</span>
        </a>
        <ul id="form-elements" class="collapse" aria-labelledby="form-elements" data-parent="#side-nav-accordion">
          <li> <a href="pages/form/form-elements.html">Form Elements</a> </li>
          <li> <a href="pages/form/form-layout.html">Form Layouts</a> </li>
          <li> <a href="pages/form/form-validation.html">Form Validation</a> </li>
          <li> <a href="pages/form/form-wizard.html">Form Wizard</a> </li>
        </ul>
      </li>
      <!-- /Form Elements -->
      <!-- Charts -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#charts" aria-expanded="false" aria-controls="charts">
          <span><i class="material-icons fs-16">equalizer</i>Charts</span>
        </a>
        <ul id="charts" class="collapse" aria-labelledby="charts" data-parent="#side-nav-accordion">
          <li> <a href="pages/charts/chartjs.html">Chart JS</a> </li>
          <li> <a href="pages/charts/morris-charts.html">Morris Chart</a> </li>
        </ul>
      </li>
      <!-- /Charts -->
      <!-- Tables -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#tables" aria-expanded="false" aria-controls="tables">
          <span><i class="material-icons fs-16">tune</i>Tables</span>
        </a>
        <ul id="tables" class="collapse" aria-labelledby="tables" data-parent="#side-nav-accordion">
          <li> <a href="pages/tables/basic-tables.html">Basic Tables</a> </li>
          <li> <a href="pages/tables/data-tables.html">Data tables</a> </li>
        </ul>
      </li>
      <!-- /Tables -->
      <!-- Popups -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#popups" aria-expanded="false" aria-controls="popups">
          <span><i class="material-icons fs-16">message</i>Popups</span>
        </a>
        <ul id="popups" class="collapse" aria-labelledby="popups" data-parent="#side-nav-accordion">
          <li> <a href="pages/popups/sweet-alerts.html">Sweet Alerts</a> </li>
          <li> <a href="pages/popups/toast.html">Toast</a> </li>
        </ul>
      </li>
      <!-- /Popups -->
      <!-- Icons -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#icons" aria-expanded="false" aria-controls="icons">
          <span><i class="material-icons fs-16">border_color</i>Icons</span>
        </a>
        <ul id="icons" class="collapse" aria-labelledby="icons" data-parent="#side-nav-accordion">
          <li> <a href="pages/icons/fontawesome.html">Fontawesome</a> </li>
          <li> <a href="pages/icons/flaticons.html">Flaticons</a> </li>
          <li> <a href="pages/icons/materialize.html">Materialize</a> </li>
        </ul>
      </li>
      <!-- /Icons -->
      <!-- Maps -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#maps" aria-expanded="false" aria-controls="maps">
          <span><i class="material-icons fs-16">map</i>Maps</span>
        </a>
        <ul id="maps" class="collapse" aria-labelledby="maps" data-parent="#side-nav-accordion">
          <li> <a href="pages/maps/google-maps.html">Google Maps</a> </li>
          <li> <a href="pages/maps/vector-maps.html">Vector Maps</a> </li>
        </ul>
      </li>
      <!-- /Maps -->
      <!-- Pages -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#pages" aria-expanded="false" aria-controls="pages">
          <span><i class="material-icons fs-16">insert_drive_file</i>Pages</span>
        </a>
        <ul id="pages" class="collapse" aria-labelledby="pages" data-parent="#side-nav-accordion">
          <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#authentication" aria-expanded="false" aria-controls="authentication">Authentication</a>
            <ul id="authentication" class="collapse" aria-labelledby="authentication" data-parent="#pages">
              <li> <a href="pages/prebuilt-pages/default-login.html">Default Login</a> </li>
              <li> <a href="pages/prebuilt-pages/modal-login.html">Modal Login</a> </li>
              <li> <a href="pages/prebuilt-pages/default-register.html">Default Registration</a> </li>
              <li> <a href="pages/prebuilt-pages/modal-register.html">Modal Registration</a> </li>
              <li> <a href="pages/prebuilt-pages/lock-screen.html">Lock Screen</a> </li>
            </ul>
          </li>
          <li> <a href="pages/prebuilt-pages/coming-soon.html">Coming Soon</a> </li>
          <li> <a href="pages/prebuilt-pages/error.html">Error Page</a> </li>
          <li class="menu-item"> <a href="pages/prebuilt-pages/faq.html"> FAQ </a> </li>
          <li class="menu-item"> <a href="pages/prebuilt-pages/portfolio.html"> Portfolio </a> </li>
          <li class="menu-item"> <a href="pages/prebuilt-pages/user-profile.html"> User Profile </a> </li>
          <li class="menu-item"> <a href="pages/prebuilt-pages/invoice.html"> Invoice </a> </li>
        </ul>
      </li>
      <!-- /Pages -->
      <!-- Bonus Pages -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#bonus" aria-expanded="false">
          <span><i class="material-icons fs-16">dashboard</i>Bonus Pages </span>
        </a>
        <ul id="bonus" class="collapse" data-parent="#side-nav-accordion">
          <li> <a href="pages/dashboard/web-analytics.html"> Web Analytics </a> </li>
          <li> <a href="pages/dashboard/social-media.html">Social Media Management</a> </li>
          <li> <a href="pages/dashboard/project-management.html">Department Management</a> </li>
          <li> <a href="pages/dashboard/client-management.html">Patient Management</a> </li>
        </ul>
      </li>
      <!-- /Bonus Pages -->
      <!-- Apps -->
      <li class="menu-item">
        <a href="#" class="has-chevron" data-toggle="collapse" data-target="#apps" aria-expanded="false" aria-controls="apps">
          <span><i class="material-icons fs-16">phone_iphone</i>Apps</span>
        </a>
        <ul id="apps" class="collapse" aria-labelledby="apps" data-parent="#side-nav-accordion">
          <li> <a href="pages/apps/chat.html">Chat</a> </li>
          <li> <a href="pages/apps/email.html">Email</a> </li>
          <li> <a href="pages/apps/to-do-list.html">To-do List</a> </li>
        </ul>
      </li>
      <!-- /Apps -->
    </ul>
  </aside>
  <!-- Sidebar Right -->
  <aside id="ms-recent-activity" class="side-nav fixed ms-aside-right ms-scrollable">
    <div class="ms-aside-header">
      <ul class="nav nav-tabs tabs-bordered d-flex nav-justified mb-3" role="tablist">
        <li role="presentation" class="fs-12"><a href="#activityLog" aria-controls="activityLog" class="active" role="tab" data-toggle="tab"> Activity Log</a></li>
        <li role="presentation" class="fs-12"><a href="#recentPosts" aria-controls="recentPosts" role="tab" data-toggle="tab"> Settings </a></li>
        <li><button type="button" class="close ms-toggler text-center" data-target="#ms-recent-activity" data-toggle="slideRight"><span aria-hidden="true">&times;</span></button></li>
      </ul>
    </div>
    <div class="ms-aside-body">
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active fade show" id="activityLog">
          <ul class="ms-activity-log">
            <li>
              <div class="ms-btn-icon btn-pill icon btn-light">
                <i class="flaticon-gear"></i>
              </div>
              <h6>Update 1.0.0 Pushed</h6>
              <span> <i class="material-icons">event</i>1 January, 2019</span>
              <p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, ula in sodales vehicula....</p>
            </li>
            <li>
              <div class="ms-btn-icon btn-pill icon btn-success">
                <i class="flaticon-tick-inside-circle"></i>
              </div>
              <h6>Profile Updated</h6>
              <span> <i class="material-icons">event</i>4 March, 2018</span>
              <p class="fs-14">Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>
            </li>
            <li>
              <div class="ms-btn-icon btn-pill icon btn-warning">
                <i class="flaticon-alert-1"></i>
              </div>
              <h6>Your payment is due</h6>
              <span> <i class="material-icons">event</i>1 January, 2019</span>
              <p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, ula in sodales vehicula....</p>
            </li>
            <li>
              <div class="ms-btn-icon btn-pill icon btn-danger">
                <i class="flaticon-alert"></i>
              </div>
              <h6>Database Error</h6>
              <span> <i class="material-icons">event</i>4 March, 2018</span>
              <p class="fs-14">Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>
            </li>
            <li>
              <div class="ms-btn-icon btn-pill icon btn-info">
                <i class="flaticon-information"></i>
              </div>
              <h6>Checkout what's Trending</h6>
              <span> <i class="material-icons">event</i>1 January, 2019</span>
              <p class="fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, ula in sodales vehicula....</p>
            </li>
            <li>
              <div class="ms-btn-icon btn-pill icon btn-secondary">
                <i class="flaticon-diamond"></i>
              </div>
              <h6>Your Dashboard is ready</h6>
              <span> <i class="material-icons">event</i>4 March, 2018</span>
              <p class="fs-14">Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>
            </li>
          </ul>
          <a href="#" class="btn btn-primary d-block"> View All </a>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="recentPosts">
          <h6>General Settings</h6>
          <div class="ms-form-group">
            <span class="ms-option-name fs-14">Location Tracking</span>
            <label class="ms-switch float-right">
              <input type="checkbox">
              <span class="ms-switch-slider round"></span>
            </label>
          </div>
          <div class="ms-form-group">
            <span class="ms-option-name fs-14">Allow Notifications</span>
            <label class="ms-switch float-right">
              <input type="checkbox">
              <span class="ms-switch-slider round"></span>
            </label>
          </div>
          <div class="ms-form-group">
            <span class="ms-option-name fs-14">Allow Popups</span>
            <label class="ms-switch float-right">
              <input type="checkbox" checked>
              <span class="ms-switch-slider round"></span>
            </label>
          </div>
          <h6>Log Settings</h6>
          <div class="ms-form-group">
            <span class="ms-option-name fs-14">Enable Logging</span>
            <label class="ms-switch float-right">
              <input type="checkbox" checked>
              <span class="ms-switch-slider round"></span>
            </label>
          </div>
          <div class="ms-form-group">
            <span class="ms-option-name fs-14">Audit Logs</span>
            <label class="ms-switch float-right">
              <input type="checkbox">
              <span class="ms-switch-slider round"></span>
            </label>
          </div>
          <div class="ms-form-group">
            <span class="ms-option-name fs-14">Error Logs</span>
            <label class="ms-switch float-right">
              <input type="checkbox" checked>
              <span class="ms-switch-slider round"></span>
            </label>
          </div>
          <h6>Advanced Settings</h6>
          <div class="ms-form-group">
            <span class="ms-option-name fs-14">Enable Logging</span>
            <label class="ms-switch float-right">
              <input type="checkbox" checked>
              <span class="ms-switch-slider round"></span>
            </label>
          </div>
          <div class="ms-form-group">
            <span class="ms-option-name fs-14">Audit Logs</span>
            <label class="ms-switch float-right">
              <input type="checkbox">
              <span class="ms-switch-slider round"></span>
            </label>
          </div>
          <div class="ms-form-group">
            <span class="ms-option-name fs-14">Error Logs</span>
            <label class="ms-switch float-right">
              <input type="checkbox" checked>
              <span class="ms-switch-slider round"></span>
            </label>
          </div>
        </div>
      </div>
    </div>
  </aside>
  <!-- Main Content -->
  <main class="body-content">