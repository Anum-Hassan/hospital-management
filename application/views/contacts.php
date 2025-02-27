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
                <h3 class="h4 mb-0" style="color: #2a1c5a;">Contacts</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered text-left" id="myTable">
                    <thead class="text-capitalize">
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($contacts)): ?>
                        <?php $serial_number = 1; ?>
                        <?php foreach ($contacts as $contact): ?>
                          <tr>
                            <td><?php echo $serial_number++; ?></td>
                            <td><?php echo $contact->name; ?></td>
                            <td><?php echo $contact->email; ?></td>
                            <td><?php echo $contact->subject; ?></td>
                            <td><?php echo $contact->message; ?></td>
                            <td>
                              <a href="<?php echo base_url('Hospital/deleteRecord/contacts/' . $contact->id); ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this contact?');">
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
