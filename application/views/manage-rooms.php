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
                  <form class="mdc-card" method="post" action="<?php echo isset($room) ? base_url('Hospital/updateRoom/' . $room->id) : base_url('Hospital/addRoom'); ?>">
                    <h4 class="card-title" style="color: #4b3a6e;">
                      <?php echo isset($room) ? 'Update Room' : 'Add Room'; ?>
                    </h4>
                    <div class="template-demo">
                      <div class="mdc-layout-grid__inner">

                        <!-- Room Number -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="room_number" required value="<?php echo isset($room) ? $room->room_number : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Room Number</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Floor Number -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input class="mdc-text-field__input" name="floor_number" required value="<?php echo isset($room) ? $room->floor_number : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Floor Number</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Room Capacity -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input type="number" class="mdc-text-field__input" name="capacity" required value="<?php echo isset($room) ? $room->capacity : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Capacity</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Per Day Fee -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <input type="number" class="mdc-text-field__input" name="per_day_fee" required value="<?php echo isset($room) ? $room->per_day_fee : ''; ?>">
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Per Day Fee</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Room Type Dropdown -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <select class="mdc-text-field__input" name="room_type" required>
                              <option value="">Select Room Type</option>
                              <?php
                                $room_types = ['General', 'Private', 'ICU', 'Emergency', 'Maternity Ward', 'Other'];
                                foreach ($room_types as $type) {
                                  echo '<option value="' . $type . '"' . (isset($room) && $room->room_type == $type ? ' selected' : '') . '>' . $type . '</option>';
                                }
                              ?>
                            </select>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Room Type</label>
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
                                <option value="<?php echo $doctor->id; ?>" <?php echo isset($room) && $room->assigned_doctor_id == $doctor->id ? 'selected' : ''; ?>>
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

                        <!-- Nurse Dropdown -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <select class="mdc-text-field__input" name="nurse_id" required>
                              <option value="">Select Nurse</option>
                              <?php foreach ($nurses as $nurse): ?>
                                <option value="<?php echo $nurse->id; ?>" <?php echo isset($room) && $room->assigned_nurse_id == $nurse->id ? 'selected' : ''; ?>>
                                  <?php echo $nurse->name; ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <div class="mdc-notched-outline">
                              <div class="mdc-notched-outline__leading"></div>
                              <div class="mdc-notched-outline__notch">
                                <label class="mdc-floating-label">Nurse</label>
                              </div>
                              <div class="mdc-notched-outline__trailing"></div>
                            </div>
                          </div>
                        </div>

                        <!-- Room Status Dropdown -->
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                          <div class="mdc-text-field mdc-text-field--outlined">
                            <select class="mdc-text-field__input" name="status" required>
                              <option value="">Select Status</option>
                              <?php
                                $statuses = ['Available', 'Occupied', 'Under Maintenance'];
                                foreach ($statuses as $status) {
                                  echo '<option value="' . $status . '"' . (isset($room) && $room->status == $status ? ' selected' : '') . '>' . $status . '</option>';
                                }
                              ?>
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
                      <?php echo isset($room) ? 'Update Room' : 'Add Room'; ?>
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
