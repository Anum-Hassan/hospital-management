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
      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
          <?php echo $this->session->flashdata('error'); ?>
        </div>
      <?php endif; ?>
      <!-- partial -->
      <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
          <div class="col-lg-12 p-4">
            <div class="card border-0">
              <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell--span-12">
                  <form class="mdc-card" method="post"
                    action="<?php
                            if (!isset($appointment)) {
                              echo base_url('Hospital/addAppt');
                            } elseif (isset($_GET['action']) && $_GET['action'] == 'reschedule') {
                              echo base_url('Hospital/updateAppt/' . $appointment->id . '?action=reschedule');
                            } else {
                              echo base_url('Hospital/updateAppt/' . $appointment->id);
                            }
                            ?>"
                    enctype="multipart/form-data">

                    <h4 class="card-title" style="color: #4b3a6e;">
                      <?php
                      if (!isset($appointment)) {
                        echo 'Add Appointment';
                      } elseif (isset($_GET['action']) && $_GET['action'] == 'reschedule') {
                        echo 'Reschedule Appointment';
                      } else {
                        echo 'Update Appointment';
                      }
                      ?>
                    </h4>

                    <div class="template-demo">
                      <div class="mdc-layout-grid__inner">

                        <!-- Patient Selection -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <select class="mdc-text-field__input" name="patient_id">
                              <?php if (!isset($appointment)): ?>
                                <option value="" disabled selected></option>
                              <?php endif; ?>
                              <?php foreach ($patients as $patient): ?>
                                <option value="<?php echo $patient->id; ?>" <?php echo isset($appointment) && $appointment->patient_id == $patient->id ? 'selected' : ''; ?>>
                                  <?php echo $patient->name; ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Patient</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Doctor Selection -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <select class="mdc-text-field__input" name="doctor_id">
                              <?php if (!isset($appointment)): ?>
                                <option value="" disabled selected></option>
                              <?php endif; ?>
                              <?php foreach ($doctors as $doctor): ?>
                                <option value="<?php echo $doctor->id; ?>" <?php echo isset($appointment) && $appointment->doctor_id == $doctor->id ? 'selected' : ''; ?>>
                                  <?php echo $doctor->name; ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Doctor</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Department Selection -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <select class="mdc-text-field__input" name="department_id">
                              <?php if (!isset($appointment)): ?>
                                <option value="" disabled selected></option>
                              <?php endif; ?>
                              <?php foreach ($departments as $department): ?>
                                <option value="<?php echo $department->id; ?>" <?php echo isset($appointment) && $appointment->department_id == $department->id ? 'selected' : ''; ?>>
                                  <?php echo $department->name; ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Department</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Appointment Date -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" id="appointment_date" type="date" name="appointment_date" required value="<?php echo isset($appointment) ? $appointment->appointment_date : ''; ?>">
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="appointment_date" class="mdc-floating-label">Appointment Date</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Appointment Time -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" id="appointment_time" type="time" name="appointment_time" required value="<?php echo isset($appointment) ? $appointment->appointment_time : ''; ?>">
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="appointment_time" class="mdc-floating-label">Appointment Time</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Status -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <select class="mdc-text-field__input" id="status" name="status" required>
                              <option value="pending" <?php echo isset($appointment) && $appointment->status == 'pending' ? 'selected' : ''; ?>>Pending</option>
                              <option value="Approved" <?php echo isset($appointment) && $appointment->status == 'Approved' ? 'selected' : ''; ?>>Approved</option>
                              <option value="Canceled" <?php echo isset($appointment) && $appointment->status == 'Canceled' ? 'selected' : ''; ?>>Canceled</option>
                              <option value="Completed" <?php echo isset($appointment) && $appointment->status == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                            </select>
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="status" class="mdc-floating-label">Status</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>

                    <button class="mdc-button mdc-button--raised mdc-ripple-upgraded mt-4" type="submit">
                      <?php
                      if (!isset($appointment)) {
                        echo 'Add Record';
                      } elseif (isset($_GET['action']) && $_GET['action'] == 'reschedule') {
                        echo 'Reschedule Record';
                      } else {
                        echo 'Update Record';
                      }
                      ?>
                    </button>
                  </form>

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