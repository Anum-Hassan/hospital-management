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
          <div class="col-lg-12 p-4">
            <div class="card border-0">
              <div class="card-header border-bottom d-flex justify-content-between">
                <h3 class="h4 mb-0" style="color: #2a1c5a;">Doctors</h3>
                <a href="<?php echo base_url('manage-doctors')?>" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> New</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered text-left" id="myTable">
                    <thead class="text-capitalize">
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>specialization</th>
                        <th>consultation fee</th>
                        <th>phone</th>
                        <th>availability</th>
                        <th>address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($doctor_details)): ?>
                        <?php foreach ($doctor_details as $doctors): ?>
                          <tr>
                            <td>1</td>
                            <td><?php echo $doctors->name;?></td>
                            <td><?php echo $doctors->specialization;?></td>
                            <td><?php echo $doctors->consultation_fee;?></td>
                            <td><?php echo $doctors->phone;?></td>
                            <td><?php echo $doctors->availability;?></td>
                            <td><?php echo $doctors->address;?></td>
                            <td>
                              <a href="" class="btn btn-sm btn-outline-primary"><span class="fa-regular fa-pen-to-square"></span></a>
                              <a href="" class="btn btn-sm btn-outline-danger"><span class="fa-solid fa-trash"></span></a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
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