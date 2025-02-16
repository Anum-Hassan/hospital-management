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
                            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                <h3 class="h4 mb-0" style="color: #2a1c5a;">Prescriptions List</h3>
                                <a href="<?php echo base_url('manage-prescriptions'); ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus"></i> New Prescription
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
                                                <th>Diagnosis</th>
                                                <th>Medications</th>
                                                <th>Notes</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($prescriptions)): ?>
                                                <?php $serial_number = 1; ?>
                                                <?php foreach ($prescriptions as $pres): ?>
                                                    <tr>
                                                        <td><?php echo $serial_number++; ?></td>
                                                        <td><?php echo htmlspecialchars($pres['patient_name']); ?></td>
                                                        <td><?php echo htmlspecialchars($pres['doctor_name']); ?></td>
                                                        <td><?php echo htmlspecialchars($pres['diagnosis']); ?></td>
                                                        <td><?php echo htmlspecialchars($pres['medications']); ?></td>
                                                        <td><?php echo htmlspecialchars($pres['notes']); ?></td>
                                                        <td>
                                                            <a href="<?php echo base_url('hospital/download_pdf/' . $pres['id']); ?>" class="btn btn-sm btn-outline-info">
                                                                <i class="fa-solid fa-download"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('hospital/editPres/' . $pres['id']); ?>" class="btn btn-sm btn-outline-primary">
                                                                <i class="fa-regular fa-pen-to-square"></i>
                                                            </a>
                                                            <a href="<?php echo base_url('hospital/deleteRecord/prescriptions/' . $pres['id']); ?>"
                                                                class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('Are you sure you want to delete this prescription?');">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr id="noRecordsRow">
                                                    <td colspan="7" class="text-center font-weight-bold text-danger">No records found.</td>
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