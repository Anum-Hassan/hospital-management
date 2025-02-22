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
                <h3 class="h4 mb-0" style="color: #2a1c5a;">Appointment List</h3>

                <div>
                  <button class="btn btn-sm btn-primary" onclick="toggleFilterDropdown()">Filter</button>
                  <div id="filterDropdown" class="dropdown-menu p-2" style="display: none; position: absolute;">
                    <select id="doctorFilter" class="form-control form-control-sm mt-2" onchange="filterAppointments()">
                      <option value="">Select Doctor</option>
                      <?php foreach ($doctor_details as $doctor): ?>
                        <?php if ($doctor->status == 1): ?>
                          <option value="<?php echo strtolower($doctor->name); ?>"><?php echo $doctor->name; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                    <select id="statusFilter" class="form-control form-control-sm mt-2" onchange="filterAppointments()">
                      <option value="">Select Status</option>
                      <option value="Pending">Pending</option>
                      <option value="Approved">Approved</option>
                      <option value="Canceled">Canceled</option>
                      <option value="Completed">Completed</option>
                    </select>
                  </div>
                </div>

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
                        <th>Patient Name</th>
                        <th>Doctor</th>
                        <th>Department</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="appointmentTable">
                      <?php if (!empty($appointments)): ?>
                        <?php $serial_number = 1; ?>
                        <?php foreach ($appointments as $appointment): ?>
                          <tr>
                            <td><?php echo $serial_number++; ?></td>
                            <td><?php echo $appointment->patient_name; ?></td>
                            <td class="doctor-name text-capitalize"><?php echo strtolower($appointment->doctor_name); ?></td>
                            <td><?php echo $appointment->department_name; ?></td>
                            <td><?php echo $appointment->appointment_date; ?></td>
                            <td><?php echo $appointment->appointment_time; ?></td>
                            <td class="appointment-status">
                              <?php
                              $statusColor = '';
                              switch (strtolower($appointment->status)) {
                                case 'pending':
                                  $statusColor = 'background-color: orange; color: white;';
                                  break;
                                case 'approved':
                                  $statusColor = 'background-color: green; color: white;';
                                  break;
                                case 'canceled':
                                  $statusColor = 'background-color: red; color: white;';
                                  break;
                                case 'completed':
                                  $statusColor = 'background-color: blue; color: white;';
                                  break;
                                default:
                                  $statusColor = 'background-color: gray; color: white;';
                              }
                              ?>
                              <span class="badge" style="padding: 5px 10px; border-radius: 12px; font-weight: bold; text-transform: capitalize; <?php echo $statusColor; ?>">
                                <?php echo ucfirst($appointment->status); ?>
                              </span>
                            </td>
                            <td>
                              <?php if (strtolower($appointment->status) == 'canceled'): ?>
                                <a href="<?php echo base_url('Hospital/editAppt/' . $appointment->id . '?action=reschedule'); ?>"
                                  class="btn btn-sm btn-outline-warning">
                                  <span class="fa-solid fa-calendar-plus"></span> Reschedule
                                </a>

                              <?php endif; ?>

                              <a href="<?php echo base_url('manage-appointments/' . $appointment->id); ?>" class="btn btn-sm btn-outline-primary">
                                <span class="fa-regular fa-pen-to-square"></span>
                              </a>

                              <a href="<?php echo base_url('Hospital/deleteRecord/appointments/' . $appointment->id); ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this appointment?');">
                                <span class="fa-solid fa-trash"></span>
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr id="noRecordsRow">
                          <td colspan="8" class="text-center font-weight-bold text-danger">No records found.</td>
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

  <script>
    function toggleFilterDropdown() {
      let dropdown = document.getElementById('filterDropdown');
      dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }

    function filterAppointments() {
      let doctorFilter = document.getElementById('doctorFilter').value.toLowerCase();
      let statusFilter = document.getElementById('statusFilter').value.toLowerCase();
      let rows = document.querySelectorAll('#appointmentTable tr');
      let noRecordsRow = document.getElementById('noRecordsRow');

      let found = false;
      rows.forEach(row => {
        if (!row.id.includes('noRecordsRow')) {
          let doctor = row.querySelector('.doctor-name')?.textContent.toLowerCase() || '';
          let status = row.querySelector('.appointment-status')?.textContent.toLowerCase() || '';
          if ((doctorFilter === '' || doctor.includes(doctorFilter)) &&
            (statusFilter === '' || status.includes(statusFilter))) {
            row.style.display = '';
            found = true;
          } else {
            row.style.display = 'none';
          }
        }
      });

      if (!found) {
        if (!noRecordsRow) {
          noRecordsRow = document.createElement('tr');
          noRecordsRow.id = 'noRecordsRow';
          noRecordsRow.innerHTML = '<td colspan="8" class="text-center font-weight-bold text-danger">No records found.</td>';
          document.getElementById('appointmentTable').appendChild(noRecordsRow);
        } else {
          noRecordsRow.style.display = '';
        }
      } else if (noRecordsRow) {
        noRecordsRow.style.display = 'none';
      }
    }
  </script>
</body>

</html>