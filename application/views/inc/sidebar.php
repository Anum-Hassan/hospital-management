<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
  <div class="mdc-drawer__header">
    <a href="<?php echo base_url('index.php') ?>" class="brand-logo">
      <img src="<?php echo base_url('assets/images/logo.svg?v=1'); ?>" alt="logo">

    </a>
  </div>
  <div class="mdc-drawer__content">
    <div class="mdc-list-group">
      <nav class="mdc-list mdc-drawer-menu">
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'index') ? 'active' : '' ?>" href="<?php echo base_url('dashboard') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
            Dashboard
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'departments' || $this->uri->segment(1) == 'manage-departments') ? 'active' : '' ?>" href="<?php echo base_url('departments') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">business</i>
            Departments
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'doctors' || $this->uri->segment(1) == 'manage-doctors') ? 'active' : '' ?>" href="<?php echo base_url('doctors') ?>">
            <i class="fas fa-stethoscope pr-3"></i>
            Doctors
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'staff' || $this->uri->segment(1) == 'manage-staff') ? 'active' : '' ?>" href="<?php echo base_url('staff') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">group</i>
            Staff
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'patients' || $this->uri->segment(1) == 'manage-patients' || $this->uri->segment(1) == 'manage-medical-history') ? 'active' : '' ?>" href="<?php echo base_url('patients') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">elderly</i>
            <!-- personal_injury -->
            Patients
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'schedule' || $this->uri->segment(1) == 'manage-schedule') ? 'active' : '' ?>" href="<?php echo base_url('schedule') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">event_note</i>
            Doctors Schedule
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'appointments' || $this->uri->segment(1) == 'manage-appointments') ? 'active' : '' ?>" href="<?php echo base_url('appointments') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">alarm</i>
            Appointments
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'rooms' || $this->uri->segment(1) == 'manage-rooms') ? 'active' : '' ?>" href="<?php echo base_url('rooms') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">hotel</i>
            Rooms
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'laboratary' || $this->uri->segment(1) == 'manage-laboratary') ? 'active' : '' ?>" href="<?php echo base_url('laboratary') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">local_hospital</i>
            Laboratary
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