<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
    <a href="<?= base_url('users/index'); ?>" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>Klinik</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="<?= base_url('users/index'); ?>" class="nav-item nav-link <?= ($this->uri->segment(2) == 'index' || $this->uri->segment(2) == '') ? 'active' : '' ?>">Home</a>
            <a href="<?= base_url('users/about'); ?>" class="nav-item nav-link <?= ($this->uri->segment(2) == 'about') ? 'active' : '' ?>">About</a>
            <a href="<?= base_url('users/services'); ?>" class="nav-item nav-link <?= ($this->uri->segment(2) == 'services') ? 'active' : '' ?>">Service</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?= (in_array($this->uri->segment(2), ['Features', 'Our Doctor', 'Appointment', 'Testimonial', '404 Page'])) ? 'active' : '' ?>" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                    <a href="<?= base_url('users/Features'); ?>" class="dropdown-item <?= ($this->uri->segment(2) == 'Features') ? 'active' : '' ?>">Features</a>
                    <a href="<?= base_url('users/ourDoctor'); ?>" class="dropdown-item <?= ($this->uri->segment(2) == 'ourDoctor') ? 'active' : '' ?>">Our Doctor</a>
                    <a href="<?= base_url('users/Appointments'); ?>" class="dropdown-item <?= ($this->uri->segment(2) == 'Appointments') ? 'active' : '' ?>">Appointments</a>
                    <a href="<?= base_url('users/Testimonial'); ?>" class="dropdown-item <?= ($this->uri->segment(2) == 'Testimonial') ? 'active' : '' ?>">Testimonial</a>
                    <a href="<?= base_url('users/404 Page'); ?>" class="dropdown-item <?= ($this->uri->segment(2) == '404 Page') ? 'active' : '' ?>">404 Page</a>
                </div>
            </div>
            <a href="<?= base_url('users/Contacts'); ?>" class="nav-item nav-link <?= ($this->uri->segment(2) == 'Contacts') ? 'active' : '' ?>">Contacts</a>
        </div>
        <a href="<?= base_url('users/Appointments'); ?>" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block <?= ($this->uri->segment(2) == 'Appointments') ? 'active' : '' ?>">Appointment<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>
<!-- Navbar End -->
