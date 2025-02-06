<!-- plugins:js -->
<script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js'); ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?php echo base_url('assets/vendors/chartjs/Chart.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendors/jvectormap/jquery-jvectormap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php echo base_url('assets/js/material.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/misc.js'); ?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo base_url('assets/js/dashboard.js'); ?>"></script>
  <!-- End custom js for this page-->
   
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function() {
    $('#myTable').DataTable({
      paging: true,
      searching: true,
      info: true,
      lengthMenu: [5, 10, 25, 50]
    });
  });

</script>