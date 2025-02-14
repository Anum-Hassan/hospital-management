<?php $this->load->view('inc/top'); ?>

<body>
  <script src="<?php echo base_url('assets/js/preloader.js'); ?>"></script>
  <div class="body-wrapper">
    <!-- Sidebar -->
    <?php $this->load->view('inc/sidebar'); ?>

    <div class="main-wrapper mdc-drawer-app-content">
      <!-- Navbar -->
      <?php $this->load->view('inc/navbar'); ?>

      <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
          <div class="col-lg-12 p-4">
            <div class="card border-0">
              <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell--span-12">
                  <form class="mdc-card" method="post" action="<?php echo isset($staff) ? base_url('Hospital/updateStaff/' . $staff->id) : base_url('Hospital/addStaff'); ?>" enctype="multipart/form-data">
                    <h4 class="card-title" style="color: #4b3a6e;">
                      <?php echo isset($staff) ? 'Update Staff' : 'Add Staff'; ?>
                    </h4>
                    <div class="template-demo">
                      <div class="mdc-layout-grid__inner">

                        <!-- Name -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="name" required value="<?php echo isset($staff) ? $staff->name : ''; ?>">
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Name</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Email -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="email" type="email" required value="<?php echo isset($staff) ? $staff->email : ''; ?>">
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Email</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Phone -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="phone" required value="<?php echo isset($staff) ? $staff->phone : ''; ?>">
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Phone</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Role -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <select class="mdc-text-field__input" name="role" required>
                              <option value="" disabled <?php echo !isset($staff) || empty($staff->role) ? 'selected' : ''; ?>></option>
                              <option value="nurse" <?php echo (isset($staff) && $staff->role == 'nurse') ? 'selected' : ''; ?>>Nurse</option>
                              <option value="technician" <?php echo (isset($staff) && $staff->role == 'technician') ? 'selected' : ''; ?>>Technician</option>
                              <option value="watchman" <?php echo (isset($staff) && $staff->role == 'watchman') ? 'selected' : ''; ?>>Watchman</option>
                              <option value="receptionist" <?php echo (isset($staff) && $staff->role == 'receptionist') ? 'selected' : ''; ?>>Receptionist</option>
                              <option value="lab_technician" <?php echo (isset($staff) && $staff->role == 'lab_technician') ? 'selected' : ''; ?>>Lab Technician</option>
                              <option value="housekeeper" <?php echo (isset($staff) && $staff->role == 'housekeeper') ? 'selected' : ''; ?>>Housekeeper</option>
                              <option value="other" <?php echo (isset($staff) && $staff->role == 'other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Role</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Salary -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="salary" type="number" required value="<?php echo isset($staff) ? $staff->salary : ''; ?>">
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Salary</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Address -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="address" required value="<?php echo isset($staff) ? $staff->address : ''; ?>">
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Address</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Status -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <select class="mdc-text-field__input" name="status" required>
                              <option value="Active" <?php echo isset($staff) && $staff->status == 'Active' ? 'selected' : ''; ?>>Active</option>
                              <option value="Inactive" <?php echo isset($staff) && $staff->status == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
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

                    <!-- Submit Button -->
                    <button class="mdc-button mdc-button--raised mdc-ripple-upgraded mt-4" type="submit">
                      <?php echo isset($staff) ? 'Update Staff' : 'Add Staff'; ?>
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

  <!-- Error Message Display -->
  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
      <?php echo $this->session->flashdata('error'); ?>
    </div>
  <?php endif; ?>

  <?php $this->load->view('inc/bottom'); ?>
</body>

</html>