<?php $this->load->view('inc/top'); ?>

<body>
  <script src="<?php echo base_url('assets/js/preloader.js'); ?>"></script>
  <div class="body-wrapper">
    <?php $this->load->view('inc/sidebar'); ?>
    <div class="main-wrapper mdc-drawer-app-content">
      <?php $this->load->view('inc/navbar'); ?>
      <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
          <div class="col-lg-12 p-4">
            <div class="card border-0">
              <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell--span-12">
                  <form class="mdc-card" method="post" action="<?php echo isset($prescription) ? base_url('hospital/editPres/' . $prescription->id) : base_url('hospital/addPres'); ?>">
                    <h4 class="card-title" style="color: #4b3a6e;">
                      <?php echo isset($prescription) ? 'Update Prescription' : 'Add Prescription'; ?>
                    </h4>
                    <div class="template-demo">
                      <div class="mdc-layout-grid__inner">

                        <!-- Patient Selection -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <select class="mdc-text-field__input" name="patient_id" required>
                              <option value="">Select Patient</option>
                              <?php foreach ($patients as $patient): ?>
                                <option value="<?php echo $patient->id; ?>" <?php echo isset($prescription) && $prescription->patient_id == $patient->id ? 'selected' : ''; ?>>
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
                            <select class="mdc-text-field__input" name="doctor_id" required>
                              <option value="">Select Doctor</option>
                              <?php foreach ($doctors as $doctor): ?>
                                <option value="<?php echo $doctor->id; ?>" <?php echo isset($prescription) && $prescription->doctor_id == $doctor->id ? 'selected' : ''; ?>>
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

                        <!-- Diagnosis -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input type="text" class="mdc-text-field__input" name="diagnosis" required value="<?php echo isset($prescription) ? $prescription->diagnosis : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Diagnosis</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Medications -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <textarea class="mdc-text-field__input" name="medications" required><?php echo isset($prescription) ? $prescription->medications : ''; ?></textarea>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Medications</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Notes -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <textarea class="mdc-text-field__input" name="notes"><?php echo isset($prescription) ? $prescription->notes : ''; ?></textarea>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Notes</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>

                    <button class="mdc-button mdc-button--raised mdc-ripple-upgraded mt-4" type="submit">
                      <?php echo isset($prescription) ? 'Update Prescription' : 'Add Prescription'; ?>
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
