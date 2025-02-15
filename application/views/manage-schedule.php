<?php $this->load->view('inc/top'); ?>

<body>
  <script src="<?php echo base_url('assets/js/preloader.js'); ?>"></script>
  <div class="body-wrapper">
    <?php $this->load->view('inc/sidebar'); ?>
    <div class="main-wrapper mdc-drawer-app-content">
      <?php $this->load->view('inc/navbar'); ?>
      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger" id="msg">
          <?php echo $this->session->flashdata('error'); ?>
        </div>
      <?php endif; ?>
      <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
          <div class="col-lg-12 p-4">
            <div class="card border-0">
              <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell--span-12">
                  <form class="mdc-card" method="post" action="<?php echo isset($schedule) ? base_url('Hospital/updateSchedule/' . $schedule->id) : base_url('Hospital/addSchedule'); ?>">
                    <h4 class="card-title" style="color: #4b3a6e;">
                      <?php echo isset($schedule) ? 'Update Schedule' : 'Add Schedule'; ?>
                    </h4>
                    <div class="template-demo">
                      <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined  <?php echo isset($schedule) && !empty($schedule->doctor_id) ? 'mdc-text-field' : ''; ?>">
                            <select class="mdc-text-field__input" name="doctor_id" required>
                              <?php if (!isset($schedule)): ?>
                                <option value="" disabled selected></option>
                              <?php endif; ?>
                              <?php foreach ($doctors as $doctor): ?>
                                <option value="<?php echo $doctor->id; ?>" <?php echo isset($schedule) && $schedule->doctor_id == $doctor->id ? 'selected' : ''; ?>>
                                  <?php echo $doctor->name; ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Doctor Name</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined  <?php echo isset($schedule) && !empty($schedule->department_id) ? 'mdc-text-field' : ''; ?>">
                            <select class="mdc-text-field__input" name="department_id" required>
                              <?php if (!isset($schedule)): ?>
                                <option value="" disabled selected></option>
                              <?php endif; ?>
                              <?php foreach ($departments as $department): ?>
                                <option value="<?php echo $department->id; ?>" <?php echo isset($schedule) && $schedule->department_id == $department->id ? 'selected' : ''; ?>>
                                  <?php echo $department->name; ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Department Name</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="start_time" type="time" required value="<?php echo isset($schedule) ? $schedule->start_time : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Start Time</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="end_time" type="time" required value="<?php echo isset($schedule) ? $schedule->end_time : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">End Time</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <label class="mdc-floating-label" style="margin-top: -30PX;">Available Days</label>

                            <!-- Checkboxes Below Available Days -->
                            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;">
                              <?php
                              $selected_days = isset($schedule) ? json_decode($schedule->days, true) : [];
                              $weekdays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

                              foreach ($weekdays as $day):
                              ?>
                                <label style="display: flex; align-items: center; gap: 5px;">
                                  <input type="checkbox" name="days[]" value="<?php echo $day; ?>"
                                    <?php echo in_array($day, $selected_days) ? 'checked' : ''; ?>>
                                  <?php echo $day; ?>
                                </label>
                              <?php endforeach; ?>
                            </div>
                          </div>
                        </div>


                      </div>
                    </div>

                    <button class="mdc-button mdc-button--raised mdc-ripple-upgraded mt-4" type="submit">
                      <?php echo isset($schedule) ? 'Update Schedule' : 'Add Schedule'; ?>
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