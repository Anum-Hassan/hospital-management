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
                  <form class="mdc-card" method="post" action="<?php echo base_url('addDoctor') ?>" enctype="multipart/form-data">
                    <h4 class="card-title " style="color: #4b3a6e;">Text Field</h4>
                    <div class="template-demo">
                      <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" id="text-field-hero-input" name="name" required>
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="text-field-hero-input" class="mdc-floating-label">Name</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined" onclick="document.getElementById('file-upload-input').click()">
                            <input class="mdc-text-field__input" id="file-name-display" type="text" readonly placeholder="Upload Image"  name="image" required>
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="file-upload-input" class="mdc-floating-label">Upload Image</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                          <input type="file" id="file-upload-input" name="image" style="display: none;" onchange="updateFileName()" required>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" id="text-field-hero-input"  name="specialization" required>
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="text-field-hero-input" class="mdc-floating-label">Specialization</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" id="text-field-hero-input"  name="consultation_fee" required>
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
                            <input class="mdc-text-field__input" id="text-field-hero-input" name="phone" required>
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="text-field-hero-input" class="mdc-floating-label">Phone</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" id="text-field-hero-input" name="address" required>
                            <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label for="text-field-hero-input" class="mdc-floating-label">Address</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button class="mdc-button mdc-button--raised mdc-ripple-upgraded mt-4" style="--mdc-ripple-fg-size: 57px; --mdc-ripple-fg-scale: 1.9677611127891828; --mdc-ripple-fg-translate-start: 62.5px, -16.5px; --mdc-ripple-fg-translate-end: 19.3046875px, -10.5px;" type="submit">
                      Add record
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