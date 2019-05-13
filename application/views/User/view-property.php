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
                                    <center>&nbsp;</center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php 
                            if(!empty($properties)):

                                foreach($properties as $property):

                                    if(!empty($property->data)):

                                        $property_json = json_decode($property->data);
                                        //get first image
                                        $img = $property_json;
                                        $address = !empty($property_json->village_property) || !empty($property_json->parish_property) || !empty($property_json->division_property)? $property_json->village_property.','.$property_json->parish_property.','.$property_json->division_property : "Location Not Provided";

print '<div class="col-md-4">
    <div class="card">
            <div class="card-header">
                <a target="_blank" href="'.base_url().'index.php/User/property/'.$property->id.'"><strong class="card-title mb-3">'.$property->title.'
                </strong></a><i class="fa fa-eye pull-right"></i>
            </div>
            <div class="card-body">
                <div class="mx-auto d-block">
                    <img class="rounded-circle mx-auto d-block" src="'.base_url().'assets/uploads/property_images/'.(!empty($property_json->photos->images)? $property_json->photos->images[0] : "No Photo Available" ).'" style="width: 100px;height: 100px;" alt="'.$property->title.'">
                    <h5 class="text-sm-center mt-2 mb-1">Type: '.$property_json->type_of_company.' </h5>
                    <div class="location text-sm-center">
                        <i class="fa fa-map-marker"></i>'.$address.'</div>
                </div>
                <hr>
                <div class="card-text ">
                    <ul class="pull-left" style="list-style: none;">
                        <li>Title: '.$property_json->property_title.'</li>
                        <li>Owner: '.$property_json->surname_contact.' '.$property_json->firstname_contact.'</li>
                        <li>Registered By: '.$property->registered_by.' </li>
                    </ul>
                </div>
            </div>
        </div>
</div>';
                                    endif;

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
