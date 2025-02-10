<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Material Dash</title>
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
                  <div class="container mt-5">
                    <h2>User Registration</h2>

                    <?php if ($this->session->flashdata('error')) { ?>
                      <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('success')) { ?>
                      <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php } ?>

                    <?php echo form_open_multipart('hospital/register'); ?>

                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" name="username" class="form-control" value="<?php echo set_value('username'); ?>">
                      <?php echo form_error('username'); ?>
                    </div>

                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>">
                      <?php echo form_error('email'); ?>
                    </div>

                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control">
                      <?php echo form_error('password'); ?>
                    </div>

                    <div class="form-group">
                      <label>Role</label>
                      <select name="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="doctor">Doctor</option>
                        <option value="staff">Staff</option>
                      </select>
                      <?php echo form_error('role'); ?>
                    </div>

                    <div class="form-group">
                      <label>Profile Image</label>
                      <input type="file" name="image" class="form-control">
                      <?php echo form_error('image'); ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>

                    <?php echo form_close(); ?>
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