<aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="<?php echo base_url(); ?>assets/images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="<?php echo base_url(); ?>index.php/User/index">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/User/add_property"><i class="fa fa-plus"></i>Add Property</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/User/all_properties"><i class="fa fa-home"></i>View All Properties</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fa fa-group"></i>Extra</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/User/all_clients">Clients</a>
                                </li>
                            </ul>
                        </li>
                       
                    </ul>
                </nav>
            </div>
        </aside>