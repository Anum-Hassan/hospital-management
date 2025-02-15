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
                <h3 class="h4 mb-0" style="color: #2a1c5a;">Patients</h3>
                <a href="<?php echo base_url('manage-patients'); ?>" class="btn btn-primary btn-sm">
                  <i class="bi bi-plus"></i> New
                </a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered text-left" id="myTable">
                    <thead class="text-capitalize">
                      <tr>
                        <th>#</th>
                        <th>Patient Name</th>
                        <th>User ID</th>
                        <th>Doctor</th>
                        <th>Room</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($patient_details)): ?>
                        <?php $serial_number = 1; ?>
                        <?php foreach ($patient_details as $patient): ?>
                          <tr>
                            <td><?php echo $serial_number++; ?></td>
                            <td><?php echo $patient->name; ?></td>
                            <!-- <td><?php //echo "User " . $patient->user_id; 
                                      ?></td> -->
                            <td><?php echo !empty($patient->user_name) ? $patient->user_name : "N/A"; ?></td>
                            <td>
                              <?php echo $patient->doctor_name; ?>
                            </td>
                            <td><?php echo !empty($patient->room_number) ? $patient->room_number : 'N/A'; ?></td>
                            <td><?php echo $patient->check_in; ?></td>
                            <td>
                              <?php echo ($patient->check_out !== '0000-00-00 00:00:00' && !empty($patient->check_out))
                                ? $patient->check_out : 'N/A'; ?>
                            </td>
                            <td><?php echo $patient->age; ?></td>
                            <td><?php echo ucfirst($patient->gender); ?></td>
                            <td><?php echo $patient->phone; ?></td>
                            <td><?php echo $patient->address; ?></td>
                            <td class="text-capitalize"><?php echo $patient->status; ?></td>
                            <td>
                              <a href="<?php echo base_url('manage-medical-history/' . $patient->id); ?>" class="btn btn-sm btn-outline-info">
                                <span class="fa-solid fa-file-medical"></span> History
                              </a>
                              <a href="<?php echo base_url('manage-patients/' . $patient->id); ?>" class="btn btn-sm btn-outline-primary">
                                <span class="fa-regular fa-pen-to-square"></span>
                              </a>
                              <a href="<?php echo base_url('Hospital/deleteRecord/patients/' . $patient->id); ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this patient?');">
                                <span class="fa-solid fa-trash"></span>
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="11" class="text-center">No records found.</td>
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