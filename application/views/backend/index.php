<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ; ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ;?>vendor/template/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ;?>vendor/template/assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="<?= base_url() ;?>vendor/template/assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="<?= base_url() ;?>vendor/template/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url() ;?>vendor/template/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url() ;?>vendor/template/assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.css') ?>">
    
    <link rel="stylesheet" href="<?= base_url('assets/datatable/dataTables.bootstrap4.min.css') ?>" type="text/css">
    
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ;?>vendor/template/assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url() ;?>vendor/template/assets/css/demo_1/style.css">
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="<?= base_url('Dashboard') ; ?>">
            <h3 class="mt-2">IKAN CERDAS</h3>
          <a class="navbar-brand brand-logo-mini" href="<?= base_url('Dashboard') ; ?>">
            <img class="img-xs rounded-circle" src="<?= base_url() ;?>assets/uploads/ikan.jpg" alt="logo" /> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav ml-auto">
           
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="<?= base_url() ;?>assets/uploads/ikan.jpg" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="<?= base_url('assets/uploads/'. $this->session->userdata('foto') .'') ; ?>"" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold"><?= $this->session->userdata('nama') ; ?></p>
                </div>
                <a href="<?= base_url('Dashboard/profile') ; ?>" class="dropdown-item">My Profile <span class="badge badge-pill badge-danger"></span><i class="dropdown-item-icon ti-dashboard"></i></a>
                <a href="<?= base_url('Auth/logout') ; ?>" class="dropdown-item">Logout<i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-category mt-3">Main Menu</li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Dashboard') ;?>">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Dashboard/rekap') ;?>">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Data Rekap</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Dashboard/grafik') ;?>">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Grafik</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Dashboard/jadwal') ;?>">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Jadwal Pakan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Auth/logout') ;?>">
                <i class="menu-icon typcn typcn-user-outline"></i>
                <span class="menu-title">Logout</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">

          <div class="flash-sukses" data-flashdata="<?= $this->session->flashdata('flash-sukses') ; ?>"></div>
          <div class="flash-error" data-flashdata="<?= $this->session->flashdata('flash-error') ; ?>"></div>

          <?php $this->view($page) ;?>

          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i>
              </span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url() ;?>vendor/template/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url() ;?>vendor/template/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="<?= base_url() ;?>vendor/template/assets/js/shared/off-canvas.js"></script>
    <script src="<?= base_url() ;?>vendor/template/assets/js/shared/misc.js"></script>

    <script src="<?= base_url() ;?>vendor/template/assets/js/demo_1/dashboard.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->

    <script src="<?php echo base_url() ;?>assets/fontawesome/js/all.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/js/jquery-3.3.1.js"></script>
    <script src="<?php echo base_url() ;?>assets/datatable/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ;?>assets/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="<?= base_url('assets/js/sweetalert2.all.js') ; ?> "></script>
  
    <script src="<?= base_url('assets/js/new_script.js') ; ?> "></script>

    <script type="text/javascript" src="<?php echo base_url('assets/highchart/highcharts.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/highchart/exporting.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/highchart/highcharts-3d.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url ('assets/highchart/export-data.js') ;?>"></script>

  </body>
</html>

<script>
  $(document).ready(function() {
    $('#example').DataTable();
  } );
</script>