<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
    <a href="<?= base_url('users/index'); ?>" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>MedCare</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="<?= base_url('users/index'); ?>" class="nav-item nav-link <?= ($this->uri->segment(2) == 'index' || $this->uri->segment(2) == '') ? 'active' : '' ?>">Home</a>
            <a href="<?= base_url('users/about'); ?>" class="nav-item nav-link <?= ($this->uri->segment(2) == 'about') ? 'active' : '' ?>">About</a>

            <a href="<?= base_url('users/services'); ?>" class="nav-item nav-link <?= ($this->uri->segment(2) == 'services') ? 'active' : '' ?>">Services</a>
           
            <a href="<?= base_url('users/ourDoctor'); ?>" class="nav-item nav-link <?= ($this->uri->segment(2) == 'ourDoctor') ? 'active' : '' ?>">Doctors</a>
            
           
                
            <a href="<?= base_url('users/Contacts'); ?>" class="nav-item nav-link <?= ($this->uri->segment(2) == 'Contacts') ? 'active' : '' ?>">Query</a>
        </div>
        <a href="<?= base_url('users/Appointments'); ?>" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block <?= ($this->uri->segment(2) == 'Appointments') ? 'active' : '' ?>">Appointment<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
    <?php if ($this->session->userdata('user_id')): ?>

        <a href="<?= base_url('users/appointment_history'); ?>" class="nav-item nav-link history-icon fs-5">
            <i class="fas fa-history"></i> History
        </a>
    <?php else: ?>
        
        <a href="<?= base_url('users/login'); ?>" class="btn login-btn ms-3">Login</a>
        <a href="<?= base_url('users/register'); ?>" class="btn register-btn ms-2">Register</a>
    <?php endif; ?>
</nav>
<!-- Navbar End -->
<style>
    /* Common Button Styling */
    .login-btn,
    .register-btn,
    .logout-btn {
        display: inline-block;
        padding: 5px 15px;
        /* Clean padding for clarity */
        font-size: 14px;
        font-weight: 700;
        /* Bold text for a premium feel */
        text-transform: uppercase;
        border-radius: 15px;
        /* Sharp rounded edges for a modern feel */
        background-color: transparent;
        color: #333;
        /* Neutral text color */
        text-align: center;
        letter-spacing: 1px;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        position: relative;
        /* For glow effect positioning */
        margin-right: 3px;
        /* Minimal space between buttons */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
        line-height: 4;
        /* Ensure the text is vertically centered */
    }

    /* Login Button */
    .login-btn {
        color: #007bff;
    }

    .login-btn:hover {
        color: #fff;
        background-color: #007bff;
        box-shadow: 0 0 20px rgba(0, 123, 255, 0.6);
        /* Blue glowing effect */
        transform: translateY(-3px);
        /* Slight upward movement on hover */
    }

    /* Register Button */
    .register-btn {
        color: #28a745;
    }

    .register-btn:hover {
        color: #fff;
        background-color: #28a745;
        box-shadow: 0 0 20px rgba(40, 167, 69, 0.6);
        /* Green glowing effect */
        transform: translateY(-3px);
        /* Slight upward movement on hover */
    }

    /* Logout Button */
    .logout-btn {
        color: #dc3545;
    }

    .logout-btn:hover {
        color: #fff;
        background-color: #dc3545;
        box-shadow: 0 0 20px rgba(220, 53, 69, 0.6);
        /* Red glowing effect */
        transform: translateY(-3px);
        /* Slight upward movement on hover */
    }
    
    .history-icon {
        font-size: 24px;
        font-weight: 600;
        color: #007bff;
        transition: 0.3s ease-in-out;
        padding: 8px 15px;
        border-radius: 8px;
        display: flex;
        align-items: center;
    }

    .history-icon i {
        margin-right: 5px;
        font-size: 18px;
    }

    .history-icon:hover {
        background-color: #007bff;
        color: white;
        box-shadow: 0px 0px 10px rgba(0, 123, 255, 0.5);
    }

</style>