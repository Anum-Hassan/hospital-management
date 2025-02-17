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
                <h3 class="h4 mb-0" style="color: #2a1c5a;">Billing</h3>
                <a href="<?php echo base_url('manage-billing'); ?>" class="btn btn-primary btn-sm">
                  <i class="bi bi-plus-lg"></i> Add New Record
                </a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered text-left" id="myTable">
                    <thead class="text-capitalize">
                      <tr>
                        <th>#</th>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Room Charges</th>
                        <th>Doctor Fee</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Pending Amount</th>
                        <th>Payment Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($billing)): ?>
                        <?php $serial_number = 1; ?>
                        <?php foreach ($billing as $bill): ?>
                          <tr>
                            <td><?php echo $serial_number++; ?></td>
                            <td><?php echo $bill->patient_name; ?></td>
                            <td><?php echo $bill->doctor_name; ?></td>
                            <td><?php echo $bill->room_charges; ?></td>
                            <td><?php echo $bill->doctor_fee; ?></td>
                            <td><?php echo $bill->total_amount; ?></td>
                            <td><?php echo $bill->paid_amount; ?></td>
                            <td><?php echo $bill->pending_amount; ?></td>
                            <td>
                              <span class="badge 
                                <?php echo ($bill->payment_status == 'Paid') ? 'bg-success text-white' : (($bill->payment_status == 'Pending') ? 'bg-warning text-dark' : 'bg-danger text-white'); ?>">
                                <?php echo $bill->payment_status; ?>
                              </span>
                            </td>

                            <td>
                              <a href="<?php echo base_url('manage-billing/' . $bill->id); ?>" class="btn btn-sm btn-outline-primary">
                                <span class="fa-regular fa-pen-to-square"></span>
                              </a>
                              <a href="<?php echo base_url('generateBillingPdf/' . $bill->id); ?>" class="btn btn-sm btn-outline-success">
                                <i class="fa-solid fa-file-pdf"></i>
                              </a>
                              <a href="<?php echo base_url('Hospital/deleteRecord/billing/' . $bill->id); ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this record?');">
                                <span class="fa-solid fa-trash"></span>
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="10" class="text-center">No records found.</td>
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