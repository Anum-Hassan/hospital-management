<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/mdi/css/materialdesignicons.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css'); ?>">
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/demo/style.css'); ?>">
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>" />
  <style>
 body {
  background: linear-gradient(135deg, #FF9A8B, #FFC3A0, #FF677D, #D4A5A5); /* Beautiful gradient */
  font-family: 'Roboto', sans-serif;
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
  <script src="../assets/js/preloader.js"></script>
  <div class="body-wrapper">
    <div class="main-wrapper">
      <div class="page-wrapper full-page-wrapper d-flex align-items-center justify-content-center">
        <main class="auth-page">
          <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
              <div class="stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-1-tablet"></div>
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-6-tablet">
                <div class="mdc-card">
                  <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                  <?php elseif ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                  <?php endif; ?>

                  <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                  <form action="<?= base_url('Users/login'); ?>" method="post" enctype="multipart/form-data">
                    <div class="mdc-layout-grid">
                      <div class="mdc-layout-grid__inner">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <div class="mdc-text-field w-100">
                            <input type="text" name="email" class="mdc-text-field__input" id="text-field-hero-input" value="<?= set_value('email'); ?>" required>
                            <div class="mdc-line-ripple"></div>
                            <label for="text-field-hero-input" class="mdc-floating-label">Email</label>
                          </div>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <div class="mdc-text-field w-100">
                            <input class="mdc-text-field__input" type="password" name="password" id="text-field-hero-input">
                            <div class="mdc-line-ripple"></div>
                            <label for="text-field-hero-input" class="mdc-floating-label">Password</label>
                          </div>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-form-field">
                            <div class="mdc-checkbox">
                              <input type="checkbox"
                                class="mdc-checkbox__native-control"
                                id="checkbox-1" />
                              <div class="mdc-checkbox__background">
                                <svg class="mdc-checkbox__checkmark"
                                  viewBox="0 0 24 24">
                                  <path class="mdc-checkbox__checkmark-path"
                                    fill="none"
                                    d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                </svg>
                                <div class="mdc-checkbox__mixedmark"></div>
                              </div>
                            </div>
                            <label for="checkbox-1">Remember me</label>
                          </div>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex align-items-center justify-content-end">
                          <a href="">Forgot Password</a>
                        </div>

                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                          <button type="submit" class="mdc-button mdc-button--raised w-100">
                            Login
                          </button>
                        </div>
                      </div>
                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex align-items-center">
                        <p>Don't have an account? <a href="<?= base_url('users/register'); ?>">Create account</a></p>
                      </div>
                    </div>
                    <?= form_close() ?>
                </div>
              </div>
              <div class="stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-1-tablet"></div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>
  <!-- plugins:js -->
  <script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/material.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/misc.js'); ?>"></script>
</body>

</html>
