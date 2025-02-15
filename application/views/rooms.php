<?php $this->load->view('inc/top'); ?>

<body>
  <script src="<?php echo base_url('assets/js/preloader.js'); ?>"></script>
  <div class="body-wrapper">
    <?php $this->load->view('inc/sidebar'); ?>

    <div class="main-wrapper mdc-drawer-app-content">
      <?php $this->load->view('inc/navbar'); ?>
      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" id="msg">
          <?php echo $this->session->flashdata('success'); ?>
        </div>
      <?php endif; ?>
      <?php if ($this->session->flashdata('delete')): ?>
        <div class="alert alert-danger" id="msg">
          <?php echo $this->session->flashdata('delete'); ?>
        </div>
      <?php endif; ?>

      <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
          <div class="col-lg-12 p-4">
            <div class="card border-0">
              <div class="card-header border-bottom d-flex justify-content-between">
                <h3 class="h4 mb-0" style="color: #2a1c5a;">Rooms</h3>
                <div>
                  <button class="btn btn-sm btn-primary" onclick="toggleFilterDropdown()">Filter</button>
                  <div id="filterDropdown" class="dropdown-menu p-2" style="display: none; position: absolute;">
                    <select id="roomTypeFilter" class="form-control form-control-sm mt-2" onchange="filterRooms()">
                      <option value="">Select Room Type</option>
                      <option value="General">General</option>
                      <option value="Private">Private</option>
                      <option value="ICU">ICU</option>
                      <option value="Emergency">Emergency</option>
                      <option value="Maternity Ward">Maternity Ward</option>
                      <option value="Other">Other</option>
                    </select>
                    <select id="statusFilter" class="form-control form-control-sm mt-2" onchange="filterRooms()">
                      <option value="">Select Status</option>
                      <option value="Available">Available</option>
                      <option value="Occupied">Occupied</option>
                      <option value="Under Maintenance">Under Maintenance</option>
                    </select>
                  </div>
                </div>

                <a href="<?php echo base_url('manage-rooms'); ?>" class="btn btn-primary btn-sm">
                  <i class="bi bi-plus"></i> New
                </a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered text-left" id="myTable">
                    <thead class="text-capitalize">
                      <tr>
                        <th>#</th>
                        <th>Room Number</th>
                        <th>Room Type</th>
                        <th>Status</th>
                        <th>Capacity</th>
                        <th>Assigned Doctor</th>
                        <th>Assigned Nurse</th>
                        <th>Floor Number</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="roomTable">
                      <?php if (!empty($room_details)): ?>
                        <?php $serial_number = 1; ?>
                        <?php foreach ($room_details as $room): ?>
                          <tr>
                            <td><?php echo $serial_number++; ?></td>
                            <td><?php echo $room->room_number; ?></td>
                            <td class="room-type"><?php echo $room->room_type; ?></td>
                            <td class="room-status">
                              <?php
                              $status = trim(strtolower($room->status)); // Normalize case & remove spaces
                              $statusColor = '';

                              switch ($status) {
                                case 'available':
                                  $statusColor = 'background-color: #28a745; color: white;'; // Bright Green
                                  break;
                                case 'occupied':
                                  $statusColor = 'background-color: #dc3545; color: white;'; // Deep Red
                                  break;
                                case 'under maintenance':
                                  $statusColor = 'background-color: #fd7e14; color: white;'; // Warm Orange
                                  break;
                                default:
                                  $statusColor = 'background-color: #6c757d; color: white;'; // Cool Gray
                              }
                              ?>
                              <span class="badge" style="padding: 6px 12px; border-radius: 15px; font-weight: bold; text-transform: capitalize; <?php echo $statusColor; ?>">
                                <?php echo ucfirst($status); ?>
                              </span>
                            </td>

                            <td><?php echo $room->capacity; ?></td>
                            <td><?php echo !empty($room->doctor_name) ? $room->doctor_name : 'Not Assigned'; ?></td>
                            <td><?php echo !empty($room->nurse_name) ? $room->nurse_name : 'Not Assigned'; ?></td>
                            <td><?php echo $room->floor_number; ?></td>
                            <td>
                              <a href="<?php echo base_url('manage-rooms/' . $room->id); ?>" class="btn btn-sm btn-outline-primary">
                                <span class="fa-regular fa-pen-to-square"></span>
                              </a>
                              <a href="<?php echo base_url('Hospital/deleteRecord/rooms/' . $room->id); ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this room?');">
                                <span class="fa-solid fa-trash"></span>
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="9" class="text-center">No records found.</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
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
    function toggleFilterDropdown() {
      let dropdown = document.getElementById('filterDropdown');
      dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }

    function filterRooms() {
      let roomTypeFilter = document.getElementById('roomTypeFilter').value.toLowerCase();
      let statusFilter = document.getElementById('statusFilter').value.toLowerCase();
      let rows = document.querySelectorAll('#roomTable tr');
      let noRecordsRow = document.getElementById('noRecordsRow');

      let found = false;
      rows.forEach(row => {
        if (!row.id.includes('noRecordsRow')) {
          let roomType = row.querySelector('.room-type')?.textContent.toLowerCase() || '';
          let status = row.querySelector('.room-status')?.textContent.toLowerCase() || '';
          if ((roomTypeFilter === '' || roomType.includes(roomTypeFilter)) &&
            (statusFilter === '' || status.includes(statusFilter))) {
            row.style.display = '';
            found = true;
          } else {
            row.style.display = 'none';
          }
        }
      });

      if (!found) {
        if (!noRecordsRow) {
          noRecordsRow = document.createElement('tr');
          noRecordsRow.id = 'noRecordsRow';
          noRecordsRow.innerHTML = '<td colspan="5" class="text-center font-weight-bold text-danger">No records found.</td>';
          document.getElementById('roomTable').appendChild(noRecordsRow);
        } else {
          noRecordsRow.style.display = '';
        }
      } else if (noRecordsRow) {
        noRecordsRow.style.display = 'none';
      }
    }
  </script>

</body>

</html>