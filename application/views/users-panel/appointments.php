<?php $this->load->view('inc/users_top'); ?>

<body>

    <!-- Topbar Start -->
    <?php $this->load->view('inc/users_topbar'); ?>
    <!-- Topbar end-->

    <!-- Navbar Start -->
    <?php $this->load->view('inc/users_navbar'); ?>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Appointment</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Appointment</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Appointment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Appointment</p>
                    <h1 class="mb-4">Make An Appointment To Visit Our Doctor</h1>
                    <p class="mb-4">Book an appointment with our specialists for the best medical care.</p>
                    <div class="contact-box p-4 mb-4">
                        <i class="fa fa-phone-alt text-primary"></i>
                        <div>
                            <p class="mb-2">Call Us Now</p>
                            <h5 class="mb-0">+012 345 6789</h5>
                        </div>
                    </div>
                    <div class="contact-box p-4">
                        <i class="fa fa-envelope-open text-primary"></i>
                        <div>
                            <p class="mb-2">Mail Us Now</p>
                            <h5 class="mb-0">info@example.com</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-light rounded p-5">
                        <form action="<?= base_url('users/book_appointment'); ?>" method="POST">
                        <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label class="form-label">Age</label>
                                    <input type="number" name="age" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" class="form-select">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <select name="department_id" id="department_id" class="form-select">
                                    <option value="">Select Department</option>
                                    <?php foreach ($departments as $dept) { ?>
                                        <option value="<?= htmlspecialchars($dept['id']); ?>">
                                            <?= htmlspecialchars($dept['name']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Doctor</label>
                                <select name="doctor_id" id="doctor_id" class="form-select">
                                    <option value="">Select Doctor</option>
                                </select>
                            </div>
                            <div class="mb-3">
    <label class="form-label">Days Slot</label>
    <select name="appointment_day" id="available_days" class="form-select">
        <option value="">Select Day</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Appointment Date</label>
    <input type="text" name="appointment_date" id="appointment_date" class="form-control" readonly>
</div>

<div class="mb-3">
    <label class="form-label">Time Slot</label>
    <select name="appointment_time" id="available_time" class="form-select">
        <option value="">Select Time</option>
    </select>
</div>


                            <button type="submit" class="btn btn-primary w-100">Book Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .contact-box {
            display: flex;
            align-items: center;
            gap: 15px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .contact-box i {
            font-size: 24px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 50%;
        }
    </style>

    <!-- Appointment End -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#department').change(function() {
                var department_id = $(this).val();
                if (department_id) {
                    $.ajax({
                        url: "<?php echo base_url('users/get_doctors'); ?>",
                        type: "POST",
                        data: {
                            department_id: department_id
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#doctor').html('<option value="">Select Doctor</option>');
                            $.each(response, function(index, doctor) {
                                $('#doctor').append('<option value="' + doctor.id + '">' + doctor.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#doctor').html('<option value="">Select Doctor</option>');
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#department_id').change(function() {
                var department_id = $(this).val();
                if (department_id) {
                    $.ajax({
                        url: "<?= base_url('users/get_doctors') ?>",
                        type: "POST",
                        data: {
                            department_id: department_id
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#doctor_id').html('<option value="">Select Doctor</option>');
                            if (response.length > 0) {
                                $.each(response, function(index, doctor) {
                                    $('#doctor_id').append('<option value="' + doctor.id + '">' + doctor.name + '</option>');
                                });
                            } else {
                                $('#doctor_id').append('<option value="">No Doctors Available</option>');
                            }
                        }
                    });
                } else {
                    $('#doctor_id').html('<option value="">Select Doctor</option>');
                }
            });
        });
    </script>
   <script>
    $(document).ready(function() {
        // Jab doctor select ho to available days laayen
        $('#doctor_id').change(function() {
            var doctor_id = $(this).val();
            if (doctor_id) {
                $.ajax({
                    url: "<?= base_url('users/get_doctor_schedule') ?>",
                    type: "POST",
                    data: { doctor_id: doctor_id },
                    dataType: "json",
                    success: function(response) {
                        $('#available_days').html('<option value="">Select Day</option>');
                        $('#available_time').html('<option value="">Select Time</option>');

                        if (response.days) {
                            $.each(response.days, function(index, day) {
                                $('#available_days').append('<option value="' + day + '">' + day + '</option>');
                            });
                        } else {
                            $('#available_days').append('<option value="">No Days Available</option>');
                        }
                    }
                });
            } else {
                $('#available_days').html('<option value="">Select Day</option>');
                $('#available_time').html('<option value="">Select Time</option>');
            }
        });

        // Jab user available day select kare to time slot fetch karein
        $('#available_days').change(function() {
            var doctor_id = $('#doctor_id').val();
            var selected_day = $(this).val();
            
            if (doctor_id && selected_day) {
                $.ajax({
                    url: "<?= base_url('users/get_time_slots') ?>", // New function to fetch time slots
                    type: "POST",
                    data: { doctor_id: doctor_id, day: selected_day },
                    dataType: "json",
                    success: function(response) {
                        $('#available_time').html('<option value="">Select Time</option>');

                        if (response.start_time && response.end_time) {
                            var timeRange = response.start_time + ' - ' + response.end_time;
                            $('#available_time').append('<option value="' + timeRange + '">' + timeRange + '</option>');
                        } else {
                            $('#available_time').append('<option value="">No Time Available</option>');
                        }
                    }
                });
            } else {
                $('#available_time').html('<option value="">Select Time</option>');
            }
        });
    });
</script>
<script>
$(document).ready(function() {
    $('#doctor_id').change(function() {
        var doctor_id = $(this).val();
        
        $.ajax({
            url: "<?= base_url('users/getAvailableDates/') ?>" + doctor_id,
            method: "GET",
            dataType: "json",
            success: function(data) {
                $('#available_days').empty();
                $('#appointment_time').empty();

                if (data.length > 0) {
                    $.each(data, function(index, value) {
                        $('#available_days').append('<option value="' + value.day + '">' + value.day + '</option>');
                    });
                } else {
                    $('#available_days').append('<option value="">No Available Days</option>');
                }
            }
        });
    });

    $('#available_days').change(function() {
        var selectedDay = $(this).val();
        
        $.ajax({
            url: "<?= base_url('users/getNextDate/') ?>" + selectedDay,
            method: "GET",
            dataType: "json",
            success: function(response) {
                if (response.next_date) {
                    $('#appointment_date').val(response.next_date);
                } else {
                    $('#appointment_date').val("Error Fetching Date");
                }
            },
            error: function() {
                $('#appointment_date').val("Error Fetching Date");
            }
        });
    });
});
</script>




    <?php $this->load->view('inc/users_footer'); ?>
    <?php $this->load->view('inc/users_bottom'); ?>
</body>

</html>