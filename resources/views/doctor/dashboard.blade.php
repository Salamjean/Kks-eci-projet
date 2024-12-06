@extends('doctor.layouts.template')

@section('content')

<div class="ms-content-wrapper">
    <div class="row">
      <!-- Notifications Widgets -->
      <div class="col-xl-3 col-md-6 col-sm-6">
        <a href="#">
          <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
            <div class="ms-card-body media">
              <div class="media-body">
                <h6>Total Docteur</h6>
                <p class="ms-card-change"> 4567</p>
              </div>
            </div>
            <i class="fas fa-stethoscope ms-icon-mr"></i>
          </div>
        </a>
      </div>
      <div class="col-xl-3 col-md-6 col-sm-6">
        <a href="#">
          <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
            <div class="ms-card-body media">
              <div class="media-body">
                <h6>Total Naissance</h6>
                <p class="ms-card-change"> 4567</p>
              </div>
            </div>
            <i class="fas fa-user ms-icon-mr"></i>
          </div>
        </a>
      </div>
      <div class="col-xl-3 col-md-6 col-sm-6">
        <a href="#">
          <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
            <div class="ms-card-body media">
              <div class="media-body">
                <h6 class="bold">Total Décès</h6>
                <p class="ms-card-change"> 4567</p>
              </div>
            </div>
            <i class="fa fa-skull ms-icon-mr"></i>
          </div>
        </a>
      </div>
      <div class="col-xl-3 col-md-6 col-sm-6">
        <a href="#">
          <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
            <div class="ms-card-body media">
              <div class="media-body">
                <h6 class="bold">Total Déclaration</h6>
                <p class="ms-card-change"> 4567</p>
              </div>
            </div>
            <i class="fas fa-briefcase-medical ms-icon-mr"></i>
          </div>
        </a>
      </div>

      </div>

     
            </div>
            <div class="progress">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 45.07%" aria-valuenow="45.07" aria-valuemin="0" aria-valuemax="100"></div>
              <div class="progress-bar bg-danger" role="progressbar" style="width: 29.05%" aria-valuenow="29.05" aria-valuemin="0" aria-valuemax="100"></div>
              <div class="progress-bar bg-warning" role="progressbar" style="width: 25.48%" aria-valuenow="25.48" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="d-flex">
      <div class="col-xl-6 col-md-12">
        <div class="ms-panel">
          <div class="ms-panel-header">
            <h6>Patient Total</h6>
          </div>
          <div class="ms-panel-body">
            <canvas id="line-chart"></canvas>
          </div>
        </div>
      </div>


      <div class="col-xl-6 col-md-12">
        <div class="ms-panel">
          <div class="ms-panel-header">
            <h6>Patient In</h6>
          </div>
          <div class="ms-panel-body">
            <canvas id="bar-chart-grouped"></canvas>
          </div>
        </div>
      </div>
    </div>

      <div class="d-flex">
      <div class="col-xl-8 col-md-12">
        <div class="ms-panel">
          <div class="ms-panel-header">
            <h6>Upcoming Appointments</h6>
          </div>
          <div class="ms-panel-body">
            <div class="table-responsive">
              <table class="table table-hover thead-primary">
                <thead>
                  <tr>
                    <th scope="col">Patient</th>
                    <th scope="col">Appointment With</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Timing</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="ms-table-f-w"> <img src="https://via.placeholder.com/270x270" alt="people"> Bernardo Galaviz </td>
                    <td>Dr. Cristina Groves</td>
                    <td>01 Dec 2019</td>
                    <td>5:00 PM</td>
                  </tr>
                  <tr>
                    <td class="ms-table-f-w"> <img src="https://via.placeholder.com/270x270" alt="people"> Jenni </td>
                    <td>Dr. Richard Miles</td>
                    <td>01 Dec 2019</td>
                    <td>8:00 AM</td>
                  </tr>
                  <tr>
                    <td class="ms-table-f-w"> <img src="https://via.placeholder.com/270x270" alt="people"> John Doe </td>
                    <td>Dr. Andrew </td>
                    <td>01 Dec 2019</td>
                    <td>10:00 AM</td>
                  </tr>
                  <tr>
                    <td class="ms-table-f-w"> <img src="https://via.placeholder.com/270x270" alt="people"> Alesdro Guitto </td>
                    <td>Dr. Robert </td>
                    <td>01 Dec 2019</td>
                    <td>2:00 PM</td>
                  </tr>
                  <tr>
                    <td class="ms-table-f-w"> <img src="https://via.placeholder.com/270x270" alt="people"> Richard </td>
                    <td>Dr. Adwerd</td>
                    <td>07 Dec 2019</td>
                    <td>5:00 PM</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-12">
        <div class="ms-panel ms-panel-fh ms-widget">
          <div class="ms-panel-header ms-panel-custome">
            <h6>Doctors List</h6>
          </div>
          <div class="ms-panel-body p-0">
            <ul class="ms-followers ms-list ms-scrollable">
              <li class="ms-list-item media">
                <img src="https://via.placeholder.com/270x270" class="ms-img-small ms-img-round" alt="people">
                <div class="media-body mt-1">
                  <h4>Micheal</h4>
                  <span class="fs-12">MBBS, MD</span>
                </div>
                <button type="button" class="ms-btn-icon btn-success" name="button"><i class="material-icons">check</i> </button>
              </li>
              <li class="ms-list-item media">
                <img src="https://via.placeholder.com/270x270" class="ms-img-small ms-img-round" alt="people">
                <div class="media-body mt-1">
                  <h4>Jennifer</h4>
                  <span class="fs-12">MD</span>
                </div>
                <button type="button" class="ms-btn-icon btn-info" name="button"><i class="material-icons">person_add</i> </button>
              </li>
              <li class="ms-list-item media">
                <img src="https://via.placeholder.com/270x270" class="ms-img-small ms-img-round" alt="people">
                <div class="media-body mt-1">
                  <h4>Adwerd </h4>
                  <span class="fs-12">BMBS</span>
                </div>
                <button type="button" class="ms-btn-icon btn-info" name="button"><i class="material-icons">person_add</i> </button>
              </li>
              <li class="ms-list-item media">
                <img src="https://via.placeholder.com/270x270" class="ms-img-small ms-img-round" alt="people">
                <div class="media-body mt-1">
                  <h4>John Doe</h4>
                  <span class="fs-12">MS, MD</span>
                </div>
                <button type="button" class="ms-btn-icon btn-success" name="button"><i class="material-icons">check</i> </button>
              </li>
              <li class="ms-list-item media">
                <img src="https://via.placeholder.com/270x270" class="ms-img-small ms-img-round" alt="people">
                <div class="media-body mt-1">
                  <h4>Jordan</h4>
                  <span class="fs-12">MBBS</span>
                </div>
                <button type="button" class="ms-btn-icon btn-info" name="button"><i class="material-icons">person_add</i> </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
      <!-- Bitcoin rating graph -->
     
          </div>
        </div>
      </div>
     

@endsection