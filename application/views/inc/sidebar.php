<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
  <div class="mdc-drawer__header">
    <a href="<?php echo base_url('index.php') ?>" class="brand-logo">
      <img src="assets/images/logo.svg" alt="logo">
    </a>
  </div>
  <div class="mdc-drawer__content">
    <div class="mdc-list-group">
      <nav class="mdc-list mdc-drawer-menu">
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'index' || $this->router->fetch_class() == $this->config->item('default_controller')) ? 'active' : '' ?>" href="<?php echo base_url('index') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
            Dashboard
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
        <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'doctor' || $this->router->fetch_class() == $this->config->item('default_controller')) ? 'active' : '' ?>" href="<?php echo base_url('doctor') ?>">
            <i class="fas fa-stethoscope pr-3"></i>
            Doctors
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
        <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'index' || $this->router->fetch_class() == $this->config->item('default_controller')) ? 'active' : '' ?>" href="<?php echo base_url('index') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">group</i>
            Staff
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
        <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'index' || $this->router->fetch_class() == $this->config->item('default_controller')) ? 'active' : '' ?>" href="<?php echo base_url('index') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">person</i>
            Patients
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
        <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'index' || $this->router->fetch_class() == $this->config->item('default_controller')) ? 'active' : '' ?>" href="<?php echo base_url('index') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">local_hospital</i>
            Laboratary
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
        <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'index' || $this->router->fetch_class() == $this->config->item('default_controller')) ? 'active' : '' ?>" href="<?php echo base_url('index') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">track_changes</i>
            Patients
          </a>
        </div>
      </nav>
    </div>
    <div class="profile-actions">
      <a href="javascript:;">Settings</a>
      <span class="divider"></span>
      <a href="javascript:;">Logout</a>
    </div>
  </div>
</aside>