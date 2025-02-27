<?php $this->load->view('inc/users_top'); ?>

<body class="bg-light">
    
 
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary"><i class="fas fa-calendar-alt"></i> My Appointments</h2>
            <a href="<?= base_url('users/logout'); ?>" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

        <div class="card shadow">
            <div class="card-body">
            <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($appointments)) : ?>
                            <?php $i = 1;
                            foreach ($appointments as $appointment): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td>
                                        <?= !empty($appointment['appointment_date']) && $appointment['appointment_date'] != '0000-00-00'
                                            ? date('d M Y', strtotime($appointment['appointment_date']))
                                            : 'Not Set'; ?>
                                    </td>
                                    <td><?= $appointment['patient_name']; ?></td>
                                    <td><?= $appointment['doctor_name']; ?></td>
                                    <td><?= $appointment['department_name']; ?></td>
                                    <td>
                                        <?php if (strtolower($appointment['status']) == 'pending'): ?>
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        <?php elseif (strtolower($appointment['status']) == 'approved'): ?>
                                            <span class="badge bg-success">Approved</span>
                                        <?php elseif (strtolower($appointment['status']) == 'canceled'): ?>
                                            <span class="badge bg-danger">Canceled</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Unknown</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (strtolower($appointment['status']) == 'pending'): ?>
                                            <a href="javascript:void(0);"
                                                onclick="confirmDelete(<?= $appointment['appointment_id']; ?>)"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-secondary" disabled><i class="fas fa-lock"></i> Locked</button>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-muted">No Appointments Found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(appointmentId) {
            if (confirm("Are you sure you want to delete this appointment?")) {
                window.location.href = "<?= base_url('users/deleteAppointment/') ?>" + appointmentId;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>