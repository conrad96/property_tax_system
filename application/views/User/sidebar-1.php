<header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="<?php echo base_url(); ?>assets/images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="<?php echo base_url(); ?>index.php/Admin/index">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/User/add_property">Add Property</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/User/all_properties">View All Properties</a>
                                </li>
                            </ul>
                        </li>
                         
                        <li class="has-sub">
                            <a class="js-arrow" href="<?php echo base_url(); ?>index.php/User/all_clients">
                                <i class="fas fa-copy"></i>Registered Clients</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Records</a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </header>