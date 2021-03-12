<div class="sidebar" data-color="purple" data-background-color="white" data-image="<?php echo base_url() ?>/resources/img/sidebar-1.jpg">
<div class="logo"><a href="<?php echo base_url()?>admin/dashboard" class="simple-text logo-normal">
          Daniel GTV Dayo
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li <?php if($this->router->fetch_class() == 'dashboard') {?> class="nav-item active" <?php } ?>>
            <a class="nav-link" href="<?php echo base_url()?>admin/dashboard">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li <?php if($this->router->fetch_class() == 'request') {?> class="nav-item active" <?php } ?>>
            <a class="nav-link" href="<?php echo base_url()?>admin/request">
              <i class="material-icons">calendar_today</i>
              <p>Schedule Request</p>
            </a>
          </li>
          <li <?php if($this->router->fetch_class() == 'approved') {?> class="nav-item active" <?php } ?>>
            <a class="nav-link" href="<?php echo base_url()?>admin/approved">
              <i class="material-icons">grading</i>
              <p>Approved Schedule</p>
            </a>
          </li>
          <li <?php if($this->router->fetch_class() == 'userrole') {?> class="nav-item active" <?php } ?>>
            <a class="nav-link" href="<?php echo base_url()?>admin/userrole">
              <i class="material-icons">person</i>
              <p>User Role</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">