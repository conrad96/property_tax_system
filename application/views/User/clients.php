<head>
    <?php $this->load->view("dependencies/header-css"); ?>
<title>Debt Collector</title>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php $this->load->view("User/sidebar-1"); ?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php $this->load->view("User/sidebar-2"); ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
           <?php $this->load->view("User/header-1"); ?>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                            
                                <div class="overview-wrap">
                                    <center><h6>&nbsp;</h6></center>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <?php 
                            if(!empty($clients)):

                                foreach($clients as $user):

                                    print '<div class="col-md-4">
                                <div class="card border border-primary">
                                    <div class="card-header">
                                        <strong class="card-title">'.$user->client.'</strong>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                        <b>Names:</b> '.$user->client.'<br />
                                        <b>Address:</b> '.implode(',', explode(' ',$user->physical_address)).'<br />
                                        <b>Contact:</b> '.$user->contact.'<br />
                                        <b>Registered By:</b> '.$user->author.'<br />
                                        <b>Date Registered:</b> '.$user->dateadded.'
                                        </p>
                                    </div>
                                </div>
                                  </div>';
                                endforeach;

                            endif;
                            ?>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © <?php echo date("Y"); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

<?php  $this->load->view("dependencies/js-dependencies"); ?>

</body>

</html>
<!-- end document-->
