<?php $this->load->view('inc/top'); ?>

<body>
  <script src="<?php echo base_url('assets/js/preloader.js'); ?>"></script>
  <div class="body-wrapper">
    <?php $this->load->view('inc/sidebar'); ?>
    <div class="main-wrapper mdc-drawer-app-content">
      <?php $this->load->view('inc/navbar'); ?>
      <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
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
          <div class="col-lg-12 p-4">
            <div class="card border-0">
              <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell--span-12">
                  <form class="mdc-card" method="post" action="<?php echo isset($patient) ? base_url('Hospital/updatePatient/' . $patient->id) : base_url('Hospital/addPatient'); ?>">
                    <h4 class="card-title" style="color: #4b3a6e;">
                      <?php echo isset($patient) ? 'Update Patient' : 'Add Patient'; ?>
                    </h4>
                    <div class="template-demo">
                      <div class="mdc-layout-grid__inner">

                        <!-- Patient Name -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" id="name" name="name" value="<?php echo isset($patient) ? $patient->name : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="name" class="mdc-floating-label">Patient Name</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- User -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined <?php echo isset($patient) && !empty($patient->user_id) ? 'mdc-text-field--focused' : ''; ?>">
                            <select class="mdc-text-field__input" name="user_id">
                              <?php if (isset($patient) && empty($patient->user_id)): ?>
                                <option value="" selected>N/A</option>
                              <?php else: ?>
                                <option value="" disabled selected></option>
                              <?php endif; ?>
                              <?php foreach ($users as $user): ?>
                                <option value="<?php echo $user->id; ?>" <?php echo isset($patient) && $patient->user_id == $user->id ? 'selected' : ''; ?>>
                                  <?php echo $user->name; ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">User</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Doctor -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined  <?php echo isset($patient) && !empty($patient->doctor_id) ? 'mdc-text-field' : ''; ?>">
                            <select class="mdc-text-field__input" name="doctor_id">
                              <?php if (!isset($patient)): ?>
                                <option value="" disabled selected></option> <!-- Show empty placeholder for new record -->
                              <?php endif; ?>
                              <?php foreach ($doctors as $doctor): ?>
                                <option value="<?php echo $doctor->id; ?>" <?php echo isset($patient) && $patient->doctor_id == $doctor->id ? 'selected' : ''; ?>>
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

                        <!-- Room -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined ">
                            <select class="mdc-text-field__input" name="room_id">
                              <?php if (isset($patient) && empty($patient->room_id)): ?>
                                <option value="" selected>N/A</option>
                              <?php else: ?>
                                <option value="" disabled selected></option>
                              <?php endif; ?>
                              <?php foreach ($rooms as $room): ?>
                                <option value="<?php echo $room->id; ?>" <?php echo isset($patient) && $patient->room_id == $room->id ? 'selected' : ''; ?>><?php echo $room->room_number; ?></option>
                              <?php endforeach; ?>
                            </select>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Room</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Check-in -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" id="check_in" name="check_in" type="datetime-local" value="<?php echo isset($patient) ? date('Y-m-d\TH:i', strtotime($patient->check_in)) : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="check_in" class="mdc-floating-label">Check-In Date</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Check-out -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" id="check_out" name="check_out" type="datetime-local" value="<?php echo isset($patient) ? date('Y-m-d\TH:i', strtotime($patient->check_out)) : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="check_out" class="mdc-floating-label">Check-Out Date</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Age -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" id="age" name="age" type="number" value="<?php echo isset($patient) ? $patient->age : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="age" class="mdc-floating-label">Age</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Gender -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined  <?php echo isset($patient) && !empty($patient->gender) ? 'mdc-text-field' : ''; ?>">
                            <select class="mdc-text-field__input" name="gender">
                              <option value="" disabled selected></option>
                              <option value="male" <?php echo isset($patient) && $patient->gender == 'male' ? 'selected' : ''; ?>>Male</option>
                              <option value="female" <?php echo isset($patient) && $patient->gender == 'female' ? 'selected' : ''; ?>>Female</option>
                              <option value="other" <?php echo isset($patient) && $patient->gender == 'other' ? 'selected' : ''; ?>>Other</option>
                            </select>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Gender</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Phone -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" id="phone" name="phone" type="text" value="<?php echo isset($patient) ? $patient->phone : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="phone" class="mdc-floating-label">Phone</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Address -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" id="address" name="address" type="text" value="<?php echo isset($patient) ? $patient->address : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="address" class="mdc-floating-label">Address</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Status -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined ">
                            <select class="mdc-text-field__input" name="status">
                              <option value="outpatient" <?php echo !isset($patient) || $patient->status == 'outpatient' ? 'selected' : ''; ?>>Outpatient (Default)</option>
                              <option value="admitted" <?php echo isset($patient) && $patient->status == 'admitted' ? 'selected' : ''; ?>>Admitted</option>
                              <option value="discharged" <?php echo isset($patient) && $patient->status == 'discharged' ? 'selected' : ''; ?>>Discharged</option>
                            </select>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Status</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button class="mdc-button mdc-button--raised mdc-ripple-upgraded mt-4" type="submit">
                      <?php echo isset($patient) ? 'Update Record' : 'Add Record'; ?>
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