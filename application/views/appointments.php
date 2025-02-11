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
                <h3 class="h4 mb-0" style="color: #2a1c5a;">Appointment List</h3>
                <a href="<?php echo base_url('manage-appointments'); ?>" class="btn btn-primary btn-sm">
                  <i class="bi bi-plus"></i> New
                </a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered text-left" id="myTable">
                    <thead class="text-capitalize">
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Specialization</th>
                        <th>Consultation Fee</th>
                        <th>Phone</th>
                        <th>Availability</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($doctor_details)): ?>
                        <?php $serial_number = 1; ?>
                        <?php foreach ($doctor_details as $doctor): ?>
                          <tr>
                            <td><?php echo $serial_number++; ?></td>
                            <td >
                              <img src="<?php echo base_url($doctor->image); ?>" alt="Doctor" class="rounded-circle" width="35px" height="35px" style="float: left;">
                              <?php echo $doctor->name; ?>
                            </td>
                            <td><?php echo $doctor->specialization; ?></td>
                            <td><?php echo $doctor->consultation_fee; ?></td>
                            <td><?php echo $doctor->phone; ?></td>
                            <td><?php echo $doctor->availability; ?></td>
                            <td><?php echo $doctor->address; ?></td>
                            <td>
                              <a href="<?php echo base_url('manage-doctors/' . $doctor->id); ?>" class="btn btn-sm btn-outline-primary">
                                <span class="fa-regular fa-pen-to-square"></span>
                              </a>
                              <a href="<?php echo base_url('Hospital/deleteDoctor/' . $doctor->id); ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this doctor?');">
                                <span class="fa-solid fa-trash"></span>
                              </a>

                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="8" class="text-center">No records found.</td>
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