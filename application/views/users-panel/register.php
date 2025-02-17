<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register - Clinic Website Template</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/mdi/css/materialdesignicons.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css'); ?>">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/demo/style.css'); ?>">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>" />

  <style>
    /* Ensure everything is aligned correctly */
    .mdc-layout-grid__cell {
      display: flex;
      flex-direction: column;
    }

    .mdc-text-field {
      width: 100%;
    }

    .custom-file-upload {
      margin-top: 10px;
      display: block;
      /* Ensures the button is below the input */
    }

    .btn-upload {
      display: inline-block;
      background-color: #6200ea;
      color: white;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      text-align: center;
    }

    .file-input {
      display: none;
    }

    #imagePreview {
      margin-top: 10px;
      text-align: center;
    }

    #imagePreviewImg {
      width: 100px;
      height: 100px;
      object-fit: cover;
    }
    .mdc-text-field input:focus,
    .mdc-text-field input:valid {
      border-color: #5c6bc0; /* Highlight color for input focus */
    }

    .mdc-button {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: #fff;
      font-weight: bold;
      border-radius: 40px;
      transition: all 0.3s ease;
    }

    .mdc-button:hover {
      background: linear-gradient(135deg, #2575fc, #6a11cb);
      transform: scale(1.05);
    }

    .mdc-card {
      padding: 20px;
    }

    .mdc-text-field__input {
      font-size: 14px;
      padding: 10px;
    }

    .mdc-layout-grid__cell a {
      color: #2575fc;
    }

    .mdc-layout-grid__cell a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <script src="<?php echo base_url('assets/js/preloader.js'); ?>"></script>
  <div class="body-wrapper">
    <div class="body-wrapper">
      <div class="main-wrapper">
        <div class="page-wrapper full-page-wrapper d-flex align-items-center justify-content-center">
          <main class="auth-page">
            <div class="mdc-layout-grid">
              <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-1-tablet"></div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-6-tablet">
                  <div class="mdc-card">
                    <?php if ($this->session->flashdata('success')): ?>
                      <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                    <?php elseif ($this->session->flashdata('error')): ?>
                      <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>

                    <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <form action="<?= base_url('Users/register'); ?>" method="post" enctype="multipart/form-data">
                      <div class="mdc-layout-grid">
                        <div class="mdc-layout-grid__inner">
                          <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                            <div class="mdc-text-field w-100">
                              <input type="text" name="username" class="mdc-text-field__input" value="<?= set_value('username'); ?>" required>
                              <div class="mdc-line-ripple"></div>
                              <label class="mdc-floating-label">Username</label>
                            </div>
                          </div>
                          <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                            <div class="mdc-text-field w-100">
                              <input type="email" class="mdc-text-field__input" name="email" value="<?= set_value('email'); ?>" required>
                              <div class="mdc-line-ripple"></div>
                              <label class="mdc-floating-label">Email</label>
                            </div>
                          </div>
                          <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                            <div class="mdc-text-field w-100">
                              <input type="password" class="mdc-text-field__input" name="password" required>
                              <div class="mdc-line-ripple"></div>
                              <label class="mdc-floating-label">Password</label>
                            </div>
                          </div>
                          
                        

                          <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                            <button type="submit" class="mdc-button mdc-button--raised w-100">Register</button>
                          </div>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex align-items-center">
                          <p>Already have an account? <a href="<?= base_url('users/login'); ?>">login</a></p>
                        </div>

                      </div>
                      <?= form_close() ?>
                  </div>
                </div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-1-tablet"></div>
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>
    <script>
      document.getElementById('fileInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(event) {
            const imagePreview = document.getElementById('imagePreviewImg');
            imagePreview.src = event.target.result;
            imagePreview.style.display = 'block';
          }
          reader.readAsDataURL(file);
        }
      });
    </script>
    <!-- plugins:js -->
    <script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js'); ?>"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?php echo base_url('assets/js/material.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/misc.js'); ?>"></script>
    <!-- endinject -->
</body>

</html>