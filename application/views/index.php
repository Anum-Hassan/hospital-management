
<?php $this->load->view('inc/top'); ?>

<body>
<script src="<?php echo base_url('assets/js/preloader.js'); ?>"></script>
  <div class="body-wrapper">
    <!-- partial:partials/_sidebar -->
    <?php $this->load->view('inc/sidebar'); ?>
    <!-- partial -->
    <div class="main-wrapper mdc-drawer-app-content">
      <!-- partial:partials/_navbar.html -->
      <?php $this->load->view('inc/navbar'); ?>
      <!-- partial -->
      <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
          <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--success">
                  <div class="card-inner">
                    <h5 class="card-title pb-4 border-bottom">Doctors</h5>
                    <h5 class="font-weight-light pt-1 pb-2 mb-1"><?= count($doctors);?></h5>
                    <div class="card-icon-wrapper">
                      <i class="fas fa-stethoscope pr-3"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--success">
                  <div class="card-inner">
                    <h5 class="card-title pb-4 border-bottom">Admitted Patients</h5>
                    <h5 class="font-weight-light pt-1 pb-2 mb-1"><?= $patients['admitted'];?></h5>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">hotel</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--warning">
                  <div class="card-inner">
                    <h5 class="card-title pb-4 border-bottom">Discharged Patients</h5>
                    <h5 class="font-weight-light pt-1 pb-2 mb-1"><?= $patients['discharged'];?></h5>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">accessible</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--dark">
                  <div class="card-inner">
                    <h5 class="card-title pb-4 border-bottom">OutPatients</h5>
                    <h5 class="font-weight-light pt-1 pb-2 mb-1"><?= $patients['outpatients'];?></h5>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">elderly</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--danger">
                  <div class="card-inner">
                    <h5 class="card-title pb-4 border-bottom">Pending Appointments</h5>
                    <h5 class="font-weight-light pt-1 pb-2 mb-1"><?= count($pending_appointments); ?></h5>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">schedule</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--info">
                  <div class="card-inner">
                    <h5 class="card-title pb-4 border-bottom">Approved Appointments</h5>
                    <h5 class="font-weight-light pt-1 pb-2 mb-1"><?= count($approved_appointments); ?></h5>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">verified</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--success">
                  <div class="card-inner">
                    <h5 class="card-title pb-4 border-bottom">Completed Appointments</h5>
                    <h5 class="font-weight-light pt-1 pb-2 mb-1"><?= count($completed_appointments); ?></h5>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">check_circle</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--danger">
                  <div class="card-inner">
                    <h5 class="card-title pb-4 border-bottom">Canceled Appointments</h5>
                    <h5 class="font-weight-light pt-1 pb-2 mb-1"><?= count($canceled_appointments); ?></h5>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">cancel</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--primary">
                  <div class="card-inner">
                    <h5 class="card-title pb-4 border-bottom">Rooms</h5>
                    <h5 class="font-weight-light pt-1 pb-2 mb-1"><?= count($rooms);?></h5>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">meeting_room</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--success">
                  <div class="card-inner">
                    <h5 class="card-title pb-4 border-bottom">Total Profit</h5>
                    <h5 class="font-weight-light pt-1 pb-2 mb-1">Rs. <?= number_format($total_profit, 2); ?></h5>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">attach_money</i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--info">
                  <div class="card-inner">
                    <h5 class="card-title pb-4 border-bottom">Pending Amount</h5>
                    <h5 class="font-weight-light pt-1 pb-2 mb-1">Rs. <?= number_format($pending_amount, 2); ?></h5>
                    <div class="card-icon-wrapper">
                      <i class="material-icons">attach_money</i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
        
        <?php $this->load->view('inc/footer'); ?>
        
      </div>
    </div>
  </div>
  
  <?php $this->load->view('inc/bottom'); ?>
</body>
</html> 