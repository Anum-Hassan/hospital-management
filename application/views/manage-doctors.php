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
                  <form class="mdc-card" method="post" action="<?php echo isset($doctor) ? base_url('Hospital/updateDoctor/' . $doctor->id) : base_url('Hospital/addDoctor'); ?>" enctype="multipart/form-data">
                    <h4 class="card-title" style="color: #4b3a6e;">
                      <?php echo isset($doctor) ? 'Update Doctor' : 'Add Doctor'; ?>
                    </h4>
                    <div class="template-demo">
                      <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="name" required value="<?php echo isset($doctor) ? $doctor->name : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Name</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined" onclick="document.getElementById('file-upload-input').click()">
                            <input class="mdc-text-field__input" id="file-name-display" type="text" readonly placeholder="Upload Image" value="<?php echo isset($doctor) ? $doctor->image : ''; ?>" required>
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="file-upload-input" class="mdc-floating-label">Upload Image</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                          <input type="file" id="file-upload-input" name="image" style="display: none;" onchange="updateFileName()">
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="qualification" required value="<?php echo isset($doctor) ? $doctor->qualification : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Qualification</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="specialization" required value="<?php echo isset($doctor) ? $doctor->specialization : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Specialization</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <select class="mdc-text-field__input" name="department_id" required>
                              <option value="" disabled></option>
                              <?php foreach ($departments as $dept): ?>
                                <option value="<?php echo $dept->id; ?>" <?php echo isset($doctor) && $doctor->department_id == $dept->id ? 'selected' : ''; ?>>
                                  <?php echo $dept->name; ?>
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

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="experience" type="number" required value="<?php echo isset($doctor) ? $doctor->experience : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Experience (Years)</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" type="number" id="decimal" name="consultation_fee" required value="<?php echo isset($doctor) ? $doctor->consultation_fee : ''; ?>">
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="text-field-hero-input" class="mdc-floating-label">Consultation Fee</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>


                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="email" type="email" required value="<?php echo isset($doctor) ? $doctor->email : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Email</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="phone" type="text" required value="<?php echo isset($doctor) ? $doctor->phone : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Phone</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="address" required value="<?php echo isset($doctor) ? $doctor->address : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Address</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <button class="mdc-button mdc-button--raised mdc-ripple-upgraded mt-4" type="submit">
                      <?php echo isset($doctor) ? 'Update Record' : 'Add Record'; ?>
                    </button>
                  </form>
                  <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger msg">
                      <?php echo $this->session->flashdata('error'); ?>
                    </div>
                  <?php endif; ?>
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