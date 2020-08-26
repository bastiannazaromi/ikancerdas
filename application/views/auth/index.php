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
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ;?>vendor/template/assets/css/shared/style.css">
    <!-- endinject -->
    
  </head>
  <body>

    <div class="flash-sukses" data-flashdata="<?= $this->session->flashdata('flash-sukses') ; ?>"></div>
    <div class="flash-error" data-flashdata="<?= $this->session->flashdata('flash-error') ; ?>"></div>

    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth bg-dark theme-one">
          <div class="row w-100 ml-0">
            <div class="col-lg-5 mx-auto">
              <div class="auto-form-wrapper">

                <form class="user" id="login-form" action="" onsubmit="ajax_login(); return false">
                  <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Halaman Login</h1>
                    </div>
                  <div class="form-group">
                    <label class="label">Username</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Username" name="email" id="email">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="label">Password</label>
                    <div class="input-group">
                      <input type="password" class="form-control" placeholder="*********" name="password" id="password">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url() ;?>vendor/template/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url() ;?>vendor/template/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?= base_url() ;?>vendor/template/assets/js/shared/off-canvas.js"></script>
    <script src="<?= base_url() ;?>vendor/template/assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js') ; ?> "></script>
    <script src="<?= base_url('assets/js/sweetalert2.all.js') ; ?> "></script>
  </body>
</html>

<script>

  function ajax_login(){
    let email = $("#email").val();
    let password = $("#password").val();
    $.ajax({
        url: "<?= base_url('Auth/login') ; ?>",
        type: "POST",
        data: {
          email: email,
          password: password
        },
        success:function(result){
            if (result == 'Valid')
            {
              
              Swal.fire({
                title: 'Success',
                text: 'Login Sukses',
                icon: 'success'
              }).then((result) => {
                if (result.value) {
                  setTimeout(function ()
                  {
                    document.location.href = "<?= base_url('Dashboard') ; ?>";
                  }, 500)
                }
              });
            }
            else
            {
              Swal.fire({
                title: 'Sorry !!',
                text: result,
                icon: 'warning'
              });

              $('#email').val("");
              $('#password').val("");
            }
        }
    });
  }
  
</script>