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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Contact Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Our Doctor</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Team Start -->

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Doctors</p>
                <h1>Our Experience Doctors</h1>
            </div>
            <div class="row g-4">
            <?php if (!empty($doctors)) { ?>
                <?php foreach ($doctors as $doctor) { ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                        <img class="img-fluid" src="<?= base_url($doctor['image']); ?>" alt="Doctor Image">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5><?= $doctor['doctor_name']; ?></h5>
                            <p class="text-primary"><?= $doctor['department_name']; ?></p>
                            <p><strong>Fee:</strong> <?= 'PKR ' . number_format($doctor['consultation_fee'], 2); ?></p>  <!-- Fee Show Karna -->
                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php } ?>
                <?php } else { ?>
                    <div class="col-12 text-center">
                        <h5>No doctors found</h5>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Footer Start -->
    <?php $this->load->view('inc/users_footer'); ?>
    <!-- Footer end -->

    <?php $this->load->view('inc/users_bottom'); ?>
</body>

</html>