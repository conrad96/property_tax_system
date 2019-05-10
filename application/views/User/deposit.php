<head>
    <?php $this->load->view("dependencies/header-css"); ?>
<title>Debt Collector: Make Deposit</title>
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
                                <?php 
                                if(isset($msg) && $msg == TRUE):
                                    print '<div class="row" style="width: 100%;">'.
                                    '<span class="alert alert-success">Deposit registered successfully.</span>'.
                                    '</div>';
                                elseif(isset($msg) && $msg == FALSE):
                                    print '<div class="row" style="width: 100%;">'.
                                    '<span class="alert alert-danger">Error! Deposit not added.</span>'.
                                    '</div>';
                                endif;
                                ?>
                            </div>
                            <div class="col-md-12">
                            
                                <div class="overview-wrap">
                                    <center><h6>&nbsp;</h6></center>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <?php if(!empty($properties)): 
                                $i = 0;
                                    foreach($properties as $property):

                                        $data = json_decode($property->data);
                                         
                                        print '<div class="col-md-4">
                                <div class="card border border-primary">
                                    <div class="card-header">
                                    <a href="#" data-backdrop="static" data-toggle="modal" data-target="#mediumModal-'.$i.'">
                                        <strong class="card-title">'.$property->title.'</strong>
                                        <span class="fa fa-plus" title="Add Deposit Entry" style="padding-left: 25px;"></span>
                                    </a>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                        <b>Names:</b> '.$data->surname_contact.' '.$data->firstname_contact.'<br />
                                        <b>Address:</b> '.(!empty($data->parish_property) || !empty($data->village_property)? $data->parish_property.','.$data->village_property : " "  ).'<br />
                                        <b>Contact:</b> '.$data->mobile_contact.'<br />
                                        <b>Registered By:</b> '.$property->registered_by.'<br />
                                        <b>Date Registered:</b> '.$property->dateadded.'
                                        </p>
                                    </div>
                                </div>
                                  </div>';
                                        $i++;

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
            <!-- Modals-->
            <?php 
                        if(!empty($properties)):
                            $x = 0;
                            foreach($properties as $property):
                                ?>
                                <div class="modal fade" id="mediumModal-<?php echo $x; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel"><?php echo !empty($property->title)? $property->title : ""; ?> : Add Deposit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                <form role="form" action="<?php echo base_url(); ?>index.php/User/deposit" method="POST">
                                    <div class="form-group">
                                        <input type="hidden" name="property_id" value="<?php echo $property->id; ?>">
                                        <label class="col-md-5">Amount:</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="deposit_amount" placeholder="Enter Amount Deposited">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Financial Year</label>
                                        <div class="col-md-5">
                                            <select name="financial_year" class="form-control">
                                                <option>2016/17</option>
                                                <option>2017/18</option>
                                                <option>2018/19</option>
                                                <option>2019/20</option>
                                                <option>2020/21</option>
                                                <option>2021/22</option>
                                                <option>2022/23</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Details</label>
                                        <textarea name="details" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
                                <?php 
                                $x++;
                            endforeach;
                        endif;
                        ?>
        </div>

    </div>

<?php  $this->load->view("dependencies/js-dependencies"); ?>

</body>

</html>
<!-- end document-->
