<!--
=========================================================
Material Dashboard - v2.1.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>

    <?php $this->load->view('includes/validation') ?>

<html lang="en">

<head>
  <?php $this->load->view('includes/head')?>
</head>

<body class="">
    <div class="wrapper ">

        <!-- SIDEBAR -->
        <?php $this->load->view('includes/adminsidebar') ?>
        <!-- END OF SIDEBAR -->

        <!-- NAVBAR -->
        <?php $this->load->view('includes/adminnavbar') ?>
        <!-- END OF NAVBAR -->

        <!-- MAIN CONTENT -->
        <div class="content">
            <div class="container-fluid">
                <div class="col-md-4">
                    
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->

    </div>
  
    <!-- CORE JS -->
    <?php $this->load->view('includes/corejs')?>
    <?php $this->load->view('includes/notification')?>
    <!-- END OF CORE JS -->
  
</body>

</html>