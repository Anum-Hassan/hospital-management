<aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
  <div class="mdc-drawer__header">
    <a href="<?php echo base_url('index.php') ?>" class="brand-logo">
      <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="logo">

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
            Patients
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'schedule' || $this->uri->segment(1) == 'manage-schedule') ? 'active' : '' ?>" href="<?php echo base_url('schedule') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">event_note</i>
            Doctors Schedule
          </a>
        </div>
        <?php
        $current_segment1 = $this->uri->segment(1);
        $current_segment2 = $this->uri->segment(2);
        $is_reschedule = isset($_GET['action']) && $_GET['action'] == 'reschedule';

        $is_active = ($current_segment1 == 'appointments' ||
          $current_segment1 == 'manage-appointments' ||
          ($current_segment1 == 'Hospital' && $current_segment2 == 'editAppt' && $is_reschedule));
        ?>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo $is_active ? 'active' : '' ?>" href="<?php echo base_url('appointments') ?>">
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
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'billing' || $this->uri->segment(1) == 'manage-billing') ? 'active' : '' ?>" href="<?php echo base_url('billing') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">attach_money </i>
            Billing
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'prescriptions' || $this->uri->segment(1) == 'manage-prescriptions') ? 'active' : '' ?>" href="<?php echo base_url('prescriptions') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">assignment</i>
            Prescriptions
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'users' || $this->uri->segment(1) == 'manage-users') ? 'active' : '' ?>" href="<?php echo base_url('users') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">person_outline</i>
            Users
          </a>
        </div>
        <div class="mdc-list-item mdc-drawer-item">
          <a class="mdc-drawer-link <?php echo ($this->uri->segment(1) == 'contacts') ? 'active' : '' ?>" href="<?php echo base_url('contacts') ?>">
            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">chat</i>
            Queries
          </a>
        </div>
      </nav>
    </div>
  </div>
</aside>