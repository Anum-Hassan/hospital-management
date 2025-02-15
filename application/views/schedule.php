<?php $this->load->view('inc/top'); ?>

<body>
  <script src="<?php echo base_url('assets/js/preloader.js'); ?>"></script>
  <div class="body-wrapper">
    <?php $this->load->view('inc/sidebar'); ?>

    <div class="main-wrapper mdc-drawer-app-content">
      <?php $this->load->view('inc/navbar'); ?>

      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" id="msg">
          <?php echo $this->session->flashdata('success'); ?>
        </div>
      <?php endif; ?>
      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger" id="msg">
          <?php echo $this->session->flashdata('error'); ?>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('delete')): ?>
        <div class="alert alert-danger" id="msg">
          <?php echo $this->session->flashdata('delete'); ?>
        </div>
      <?php endif; ?>

      <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
          <div class="col-lg-12 p-4">
            <div class="card border-0">
              <div class="card-header border-bottom d-flex justify-content-between">
                <h3 class="h4 mb-0" style="color: #2a1c5a;">Doctor Schedules</h3>
                <a href="<?php echo base_url('manage-schedule'); ?>" class="btn btn-primary btn-sm">
                  <i class="bi bi-plus"></i> Add Schedule
                </a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered text-left" id="myTable">
                    <thead class="text-capitalize">
                      <tr>
                        <th>#</th>
                        <th>Doctor Name</th>
                        <th>Department</th>
                        <th>Available Days</th>
                        <th>Available Time</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($schedules)): ?>
                        <?php $serial_number = 1; ?>
                        <?php foreach ($schedules as $schedule): ?>
                          <tr>
                            <td><?php echo $serial_number++; ?></td>
                            <td><?php echo htmlspecialchars($schedule->doctor_name); ?></td>
                            <td>
                              <?php 
                                echo htmlspecialchars($schedule->department_name);
                              ?>
                            </td>
                            <td>
                              <?php 
                                $days = json_decode($schedule->days, true);
                                echo is_array($days) ? implode(', ', $days) : 'N/A'; 
                              ?>
                            </td>
                            <td><?php echo date('h:i A', strtotime($schedule->start_time)) . ' - ' . date('h:i A', strtotime($schedule->end_time)); ?></td>
                            <td>
                              <a href="<?= base_url('hospital/toggle_status/schedule/' . $schedule->id); ?>"
                                class="btn btn-sm <?= $schedule->status == 1 ? 'btn-outline-success' : 'btn-outline-danger'; ?>">
                                <?= $schedule->status == 1 ? 'Available' : 'Unavailable'; ?>
                              </a>
                            </td>
                            <td>
                              <a href="<?php echo base_url('manage-schedule/' . $schedule->id); ?>" class="btn btn-sm btn-outline-primary">
                                <span class="fa-regular fa-pen-to-square"></span>
                              </a>
                              <a href="<?php echo base_url('Hospital/deleteRecord/schedule/' . $schedule->id); ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this schedule?');">
                                <span class="fa-solid fa-trash"></span>
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="6" class="text-center">No records found.</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
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
