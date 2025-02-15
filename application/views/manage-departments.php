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
      <!-- partial -->
      <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
          <div class="col-lg-12 p-4">
            <div class="card border-0">
              <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell--span-12">
                  <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-success" id="msg">
                      <?php echo $this->session->flashdata('error'); ?>
                    </div>
                  <?php endif; ?>
                  <form class="mdc-card" method="post" action="<?php echo isset($department) ? base_url('Hospital/updatedepart/' . $department->id) : base_url('Hospital/adddepart'); ?>" enctype="multipart/form-data">
                    <h4 class="card-title" style="color: #4b3a6e;">
                      <?php echo isset($department) ? 'Update Department' : 'Add Department'; ?>
                    </h4>
                    <div class="template-demo">
                      <div class="mdc-layout-grid__inner">

                        <!-- Name Select Field Styled Consistently -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <select class="mdc-text-field__input" name="name" required>
                              <option value="" disabled <?php echo !isset($department) || empty($department->name) ? 'selected' : ''; ?>></option>
                              <option value="Emergency (ER)" <?php echo (isset($department) && $department->name == 'Emergency (ER)') ? 'selected' : ''; ?>>Emergency (ER)</option>
                              <option value="Surgery" <?php echo (isset($department) && $department->name == 'Surgery') ? 'selected' : ''; ?>>Surgery</option>
                              <option value="Cardiology" <?php echo (isset($department) && $department->name == 'Cardiology') ? 'selected' : ''; ?>>Cardiology</option>
                              <option value="Neurology" <?php echo (isset($department) && $department->name == 'Neurology') ? 'selected' : ''; ?>>Neurology</option>
                              <option value="Orthopedics" <?php echo (isset($department) && $department->name == 'Orthopedics') ? 'selected' : ''; ?>>Orthopedics</option>
                              <option value="Pediatrics" <?php echo (isset($department) && $department->name == 'Pediatrics') ? 'selected' : ''; ?>>Pediatrics</option>
                              <option value="Gynecology & Obstetrics" <?php echo (isset($department) && $department->name == 'Gynecology & Obstetrics') ? 'selected' : ''; ?>>Gynecology & Obstetrics</option>
                              <option value="Oncology" <?php echo (isset($department) && $department->name == 'Oncology') ? 'selected' : ''; ?>>Oncology</option>
                              <option value="Radiology" <?php echo (isset($department) && $department->name == 'Radiology') ? 'selected' : ''; ?>>Radiology</option>
                              <option value="Anesthesiology" <?php echo (isset($department) && $department->name == 'Anesthesiology') ? 'selected' : ''; ?>>Anesthesiology</option>
                              <option value="Urology" <?php echo (isset($department) && $department->name == 'Urology') ? 'selected' : ''; ?>>Urology</option>
                              <option value="Nephrology" <?php echo (isset($department) && $department->name == 'Nephrology') ? 'selected' : ''; ?>>Nephrology</option>
                              <option value="Gastroenterology" <?php echo (isset($department) && $department->name == 'Gastroenterology') ? 'selected' : ''; ?>>Gastroenterology</option>
                              <option value="Endocrinology" <?php echo (isset($department) && $department->name == 'Endocrinology') ? 'selected' : ''; ?>>Endocrinology</option>
                              <option value="Pulmonology" <?php echo (isset($department) && $department->name == 'Pulmonology') ? 'selected' : ''; ?>>Pulmonology</option>
                              <option value="Psychiatry" <?php echo (isset($department) && $department->name == 'Psychiatry') ? 'selected' : ''; ?>>Psychiatry</option>
                              <option value="Dermatology" <?php echo (isset($department) && $department->name == 'Dermatology') ? 'selected' : ''; ?>>Dermatology</option>
                              <option value="Ophthalmology" <?php echo (isset($department) && $department->name == 'Ophthalmology') ? 'selected' : ''; ?>>Ophthalmology</option>
                              <option value="ENT (Ear, Nose, Throat)" <?php echo (isset($department) && $department->name == 'ENT (Ear, Nose, Throat)') ? 'selected' : ''; ?>>ENT (Ear, Nose, Throat)</option>
                              <option value="Pathology" <?php echo (isset($department) && $department->name == 'Pathology') ? 'selected' : ''; ?>>Pathology</option>
                              <option value="Physiotherapy & Rehabilitation" <?php echo (isset($department) && $department->name == 'Physiotherapy & Rehabilitation') ? 'selected' : ''; ?>>Physiotherapy & Rehabilitation</option>
                              <option value="ICU (Intensive Care Unit)" <?php echo (isset($department) && $department->name == 'ICU (Intensive Care Unit)') ? 'selected' : ''; ?>>ICU (Intensive Care Unit)</option>
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

                        <!-- Description Field -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" id="text-field-hero-input" name="description" required value="<?php echo isset($department) ? $department->description : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="text-field-hero-input" class="mdc-floating-label">Department Description</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>

                    <button class="mdc-button mdc-button--raised mdc-ripple-upgraded mt-4" type="submit">
                      <?php echo isset($department) ? 'Update Record' : 'Add Record'; ?>
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


  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
      <?php echo $this->session->flashdata('error'); ?>
    </div>
  <?php endif; ?>

  <?php $this->load->view('inc/bottom'); ?>
  <script>
    function updateFileName() {
      const fileInput = document.getElementById('file-upload-input');
      const fileNameDisplay = document.getElementById('file-name-display');
      if (fileInput.files.length > 0) {
        fileNameDisplay.value = fileInput.files[0].name;
      }
    }
  </script>
</body>

</html>