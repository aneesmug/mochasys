<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Customer Register
<?= $this->endSection(); ?>

<?= $this->section('pageCSS'); ?>
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/material-vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/menu/menu-types/material-vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/colors/material-palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/fonts/mobiriseicons/24px/mobirise/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/plugins/forms/wizard.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/plugins/pickers/daterange/daterange.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri_css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri_css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/bootstrap-timepicker.min.css">

    <!-- END: Vendor CSS-->
    <style type="text/css">.noneDIV { display:none; }, .showDIV { display:block; } </style>

<?php

    //session()->get('user')['emp_data']['emp_id'];

    /*echo "<pre>";
    print_r (session()->get('user'));
    echo "</pre>";
    exit();*/
    $employee = session()->get('user')['emp_data'];

?>    

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>



    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-header row">
        </div>
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- eCommerce statistic -->
<section id="add-patient">
    <div class="icon-tabs">
        <div class="row">
            <div class="col-12">

                <?php 
                    $errors = [];
                    if(session()->getFlashData('errors') != null): 
                      $errors = session()->getFlashData('errors');
                    endif;
                ?>
                <?php if (session()->getFlashData('success') != null) : ?>
                    <div class="alert bg-success alert-icon-left alert-dismissible mb-2" role="alert">
                        <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                        <strong>Well done!</strong> <?= session()->getFlashData('success') ?>
                    </div>
                    <?php elseif (session()->getFlashData('error') != null) : ?>
                    <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
                        <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                        <strong>Oh snap!</strong> <?= session()->getFlashData('error') ?>
                    </div>
                <?php endif ?>

                <?php if ($status == 'A'): ?>
                    <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
                        <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                        <strong>Oh snap!</strong> You have already applied Vacation.
                    </div>
                <?php endif ?>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Apply New Leave
                        </h4>
                        <a class="heading-elements-toggle" href="#">
                            <i class="la la-ellipsis-h font-medium-3"> </i>
                        </a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">                          

                            <form action="<?=base_url('/vacation/apply')?>" class="add-patient-tabs steps-validation wizard-notification" method="post">
                                <!-- step 1 => Personal Details -->

                                <!-- CSRF token -->
                                <?= csrf_field() ?>
                                <?php /* ?>
                                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <?php */ ?>
                                <!-- CSRF token -->
                                <fieldset>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Employee Name</label>
                                            <input type="text" value="<?=$employee['name']?>" class="form-control" name="emp_name" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="emp_id">Employee ID.</label>
                                            <input type="text" value="<?=$employee['emp_id']?>" class="form-control" name="emp_id" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="type">Department</label>
                                            <input type="text" value="<?=$employee['dept']?>" class="form-control" name="dept" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="date_select" >Vacation Date<span class="text-danger">*</span></label>
                                            <input type="text" name="vac_strt_date" parsley-trigger="change" placeholder="yyyy-mm-dd" class="form-control" id="date_select" autocomplete="off">
                                        </div>
                                       
                                       <div class="form-group col-md-6">
                                            <label for="inlineRadio3" class="radioalign">Remarks<span class="text-danger">*</span></label>
                                            <div class="radio radio-info form-check-inline">
                                                <input type="radio" id="inlineRadio3" value="Local Vacation" name="vac_type" class="LocalVacation" >
                                                <b for="inlineRadio3"><i class="fa fa-odnoklassniki"></i> Local Vacation</b>
                                            </div>
                                            <?php //if($row->country <> "Saudi Arabia" && $row->country <> "Myanmar" ){?>
                                            <div class="radio radio-info form-check-inline">
                                                <input type="radio" id="inlineRadio1" value="Fly" name="vac_type" class="showFly" />
                                                <b for="inlineRadio1"><i class="fa fa-plane"></i> Fly </b>
                                            </div>
                                            <?php //} ?>
                                            <div class="radio radio-info form-check-inline">
                                                <input type="radio" id="inlineRadio2" value="Encashed" name="vac_type" class="showEncashed">
                                                <b for="inlineRadio2"><i class="mdi mdi-square-inc-cash"></i> Encashed</b>
                                            </div>                                              
                                        </div> 
                                        
                                    </div>
                                        <div class="form-row noneDIV" id="LocalVacationDIV">
                                        <div class="form-group col-md-6">
                                            <label for="return_date_v">Return Date<span class="text-danger">*</span></label>
                                            <input type="text" name="return_date" id="return_date_v" parsley-trigger="change" placeholder="yyyy-mm-dd" class="form-control" autocomplete="off">
                                        </div>

                                        </div>
                                    
                                        <div class="form-row noneDIV" id="FlyDIV">
                                       
                                       
                                        <div class="form-group col-md-6">
                                            <label for="return_dated" >Return Date<span class="text-danger">*</span></label>
                                            <input type="text" name="return_date" parsley-trigger="change" placeholder="yyyy-mm-dd" class="form-control" id="return_dated" autocomplete="off" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                        <label for="type" class="radioalign">Select Vacation Type<span class="text-danger">*</span></label>
                                            <div class="radio radio-info form-check-inline">
                                                <input type="radio" id="vac_type1" value="annual" name="fly_type">
                                                <b for="vac_type1"><i class="mdi mdi-all-inclusive"></i> Annual Vacation</b>
                                            </div>
                                            <div class="radio radio-info form-check-inline">
                                                <input type="radio" id="vac_type2" value="emergency" name="fly_type">
                                                <b for="vac_type2"><i class="mdi mdi-chemical-weapon"></i> Emergency Vacation</b>
                                            </div>  
                                        </div>
                                        </div>

                                    <input type="hidden" name="joining_date" value="<?=$employee['joining_date']?>" />
                                    <input type="hidden" name="vac_period" value="<?=$employee['vac_period']?>" />

                                    <?php if ($status !== 'A'): ?>
                                    <div class="form-actions right">
                                        <a href="<?= base_url('/employeedash') ?>"  class="btn btn-warning mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            <i class="la la-check-square-o"></i> Register
                                        </button>
                                    </div>
                                    <?php endif ?>

                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
                <!--/ Recent Transactions -->

            </div>
        </div>
    </div>
    
<?= $this->endSection(); ?>
<!-- END: Content-->

<!-- Start: Script-->
<?= $this->section('script'); ?>

    <!-- BEGIN: Vendor JS-->
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/material-vendors.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pages/material-app.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/forms/wizard-steps.js"></script>
    <!-- END: Page JS-->

    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/bootstrap-timepicker.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri/bootstrap-hijri-datetimepicker.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri/bootstrap-hijri-datetimepicker.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>

    <script src="<?= base_url('/') ?>/app-assets/js/scripts/jquery.custom.validation.js"></script>

    <script type="text/javascript">
/***************************/

$(".LocalVacation").click(function() {
    $("#LocalVacationDIV").removeClass("noneDIV");
    $("#LocalVacationDIV").addClass("showDIV");

    //Make sure schoolDIV is not visible
    $("#FlyDIV").removeClass("showDIV");
    $("#EncashedDIV").removeClass("showDIV");
    $("#FlyDIV").addClass("noneDIV");
    $("#EncashedDIV").addClass("noneDIV");

    $("#LocalVacationDIV :input").prop('required',true);
    $("#FlyDIV :input").prop('required',null);
    $("#EncashedDIV :input").prop('required',null);
    
    $("input#return_date_v:text").attr('name','return_date');
    $("input#return_dated:text").removeAttr('name');
    $("select#replacement_per_fly").removeAttr('name');
    $("select#replacement_per_local").attr('name','replacement_per');
    
});

$(".showFly").click(function() {
    $("#FlyDIV").removeClass("noneDIV");
    $("#FlyDIV").addClass("showDIV");

    //Make sure bankDIV is not visible
    $("#LocalVacationDIV").removeClass("showDIV");
    $("#EncashedDIV").removeClass("showDIV");
    $("#LocalVacationDIV").addClass("noneDIV");
    $("#EncashedDIV").addClass("noneDIV");

    $("#FlyDIV :input").prop('required',true);
    $("#LocalVacationDIV :input").prop('required',null);
    $("#EncashedDIV :input").prop('required',null);
    
    $("input#return_dated:text").attr('name','return_date');
    $("input#return_date_v:text").removeAttr('name');
    $("select#replacement_per_local").removeAttr('name');
    $("select#replacement_per_fly").attr('name','replacement_per');
    
});
    
$(".showEncashed").click(function() {
    $("#EncashedDIV").removeClass("noneDIV");
    $("#EncashedDIV").addClass("showDIV");

    //Make sure bankDIV is not visible
    $("#FlyDIV").removeClass("showDIV");
    $("#LocalVacationDIV").removeClass("showDIV");
    $("#FlyDIV").addClass("noneDIV");
    $("#LocalVacationDIV").addClass("noneDIV");

    $("#FlyDIV :input").prop('required',null);
    $("#LocalVacationDIV :input").prop('required',null);
    
    $("input#return_dated:text").attr('name','');
    $("input#return_date_v:text").attr('name','');
    $("input#remarks:text").attr('name','');
    $("select#replacement_per_local").attr('name','');
    $("select#replacement_per_fly").attr('name','');
});
    /***************************/

    jQuery(document).ready(function () {
        $('#date_select').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            startDate: '+0d',
        });
        $('#return_date_v').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            // startDate: '+0d',
        });
        $('#return_dated').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            // startDate: '+0d',
        });

    });

    </script>

<?= $this->endSection(); ?>
<!-- End: Script-->