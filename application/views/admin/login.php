<!--
=========================================================
Material Kit - v2.0.7
=========================================================

Product Page: https://www.creative-tim.com/product/material-kit
Copyright 2020 Creative Tim (https://www.creative-tim.com/)

Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>

<?php 

if (isset($this->session->userdata['logged_in'])) {
    header("location: ".base_url()."admin/dashboard");
} 

?>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url()?>resources/home/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo base_url()?>resources/home/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin Login
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?php echo base_url()?>resources/home/assets/css/material-kit.css?v=2.0.7" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url()?>resources/home/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
  
  <div class="page-header header-filter" style="background-image: url('<?php echo base_url()?>resources/home/assets/img/bgbball.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form id="login_form" method="POST">
              <div class="card-header card-header-danger text-center">
                <h4 class="card-title">Admin Login</h4>
                
              </div>
              <p class="description text-center">Login here</p>
              <div class="card-body">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">face</i>
                    </span>
                  </div>
                  <input type="text" class="form-control" id="userName" name="userName" placeholder="Username...">
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Password...">
                </div>
              </div>
              <div class="text-center" style="padding:20px">
                 <input value="Login" type="submit" id="btn_login" class="btn btn-danger">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <!--   Core JS Files   -->
  <script src="<?php echo base_url()?>resources/home/assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>resources/home/assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>resources/home/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>resources/home/assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="<?php echo base_url()?>resources/home/assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="<?php echo base_url()?>resources/home/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url()?>resources/home/assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
  <?php $this->load->view('includes/corejs')?>
    <?php $this->load->view('includes/notification')?>
</body>

</html>

<script>
$('#login_form').on('submit', function(e){
    e.preventDefault();
    $("#btn_login").val("Logging in...").attr("disabled", true);

    var userName = $('#userName').val()
    var userPassword = $('#userPassword').val()


    if(userName == "" || userPassword == ""){
        Swal.fire({
                    title: 'Failed!',
                    text: 'Fill required fields!.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                    }).then((result) => {
                            $("#btn_login").val("Submit").attr("disabled", false);
                            $('#login_form')[0].reset();
                    })
                    $("#btn_login").val("Submit").attr("disabled", false);
                    $('#login_form')[0].reset();
    }
    else{
        var form = $('#login_form');                                
        // ajax post
        $.ajax({
            url: '<?php echo base_url()?>admin/login/submit',
            type: 'post',
            data: form.serialize(),

                success: function(data){
                        var data = jQuery.parseJSON(data)
                        if(data.result == 'Error'){
                            Swal.fire({
                            title: 'Failed!',
                            text: 'Invalid Username or Password.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                            }).then((result) => {
                                    $("#btn_login").val("Submit").attr("disabled", false);
                                    $('#login_form')[0].reset();
                            })
                            // End of Swal
                        }
                        if(data.result == 'Success'){
                            window.location.href = "<?php echo base_url()?>admin/dashboard";
                        }
                    
                    }
                // End of success function
        })
        // End of ajax post
    }
    
})
</script>