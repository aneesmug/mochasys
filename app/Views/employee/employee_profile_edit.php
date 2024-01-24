<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Employee Register
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

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-header row">
            
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Employee's</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=base_url('/employee/list')?>">Employees List</a></li>
                            <li class="breadcrumb-item"><a href="<?=base_url('/employee/view/')."/".$employee['id']?>">View</a></li>
                            <li class="breadcrumb-item active"><?=$employee['name']?></li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            <div class="content-body">
                <!-- eCommerce statistic -->
<section id="add-patient">
    <!-- users view media object start -->
    <div class="row">
        <div class="col-12 col-sm-7">
            <div class="media mb-2">
                <a class="mr-1" href="#">
                    <img src="<?=base_url($employee['avatar'])?>" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="90" width="90">
                </a>
                <div class="media-body pt-25">
                    <h4 class="media-heading"><span class="users-view-name"><?= $employee['name'] ?></span></h4>
                    <span>Employee ID:</span>
                    <span class="users-view-id"><?= $employee['emp_id'] ?></span>
                </div>
            </div>
        </div>
    </div>
    <!-- users view media object ends -->
    <div class="icon-tabs">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Edit Employee
                        </h4>
                        <a class="heading-elements-toggle" href="#">
                            <i class="la la-ellipsis-h font-medium-3"> </i>
                        </a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
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
                            

                            <form action="<?= base_url('/employee/profile/edit') ?>" class="add-patient-tabs steps-validation wizard-notification" method="post" id="registration">
                                <!-- step 1 => Personal Details -->
                                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <!-- CSRF token -->
                                <h6>
                                    <i class="step-icon la la-user font-medium-3"> </i>
                                    Personal Details
                                </h6>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Full Name<span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" value="<?=$employee['name']?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="iqama">Iqama / ID<span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" value="<?=$employee['iqama']?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="iqama_exp_hijri">Iqama / ID Exp.<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['iqama_exp']) ? 'is-invalid' : ''; ?>" id="iqama_exp_hijri" placeholder="Please enter iqama / ID expiry" type="text" name="iqama_exp" value="<?= $employee['iqama_exp'] ?>">
                                                <?php if(isset($errors['iqama_exp'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['iqama_exp'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="passport">Passport<?=($employee['country']<>'Saudi Arabia' && $employee['country']<>'Myanmar')?"<span class='text-danger'>*</span>":""?></label>
                                                <input class="form-control" id="passport" placeholder="Please enter passport no" type="text" name="passport" value="<?=$employee['passport']?>" <?=($employee['country']<>'Saudi Arabia' && $employee['country']<>'Myanmar')?"required":""?> >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="passport_exp">Passport Exp.<?=($employee['country']<>'Saudi Arabia' && $employee['country']<>'Myanmar')?"<span class='text-danger'>*</span>":""?></label>
                                                <input class="form-control" id="passport_exp" placeholder="Please enter passport expiry" type="text" name="passport_exp" autocomplete="off" value="<?= $employee['passport_exp'] ?>" <?=($employee['country']<>'Saudi Arabia' && $employee['country']<>'Myanmar')?"required":""?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="mobile">Mobile<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['mobile']) ? 'is-invalid' : ''; ?>" id="mobile" placeholder="Please enter employee mobile no" type="text" name="mobile" parsley-trigger="change" data-mask="0599999999" value="<?= $employee['mobile'] ?>">
                                                <?php if(isset($errors['mobile'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['mobile'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="country">Nationality<span class="text-danger">*</span></label>
                                                <select class="custom-select">
                                                    <option value="<?= $employee['country'] ?>"><?= $employee['country'] ?></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['dob']) ? 'is-invalid' : ''; ?>" id="dob" placeholder="Please select date of birth" type="text" name="dob" autocomplete="off" value="<?= $employee['dob'] ?>">
                                                <?php if(isset($errors['dob'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['dob'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <div class="input-group">
                                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                                        <input type="radio" class="custom-control-input" id="male" <?= ($employee['sex'] == 'male') ? 'checked' : "" ; ?> >
                                                        <label class="custom-control-label" for="male">Male</label>
                                                    </div>
                                                    <div class="d-inline-block custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="female" <?= ($employee['sex'] == 'female') ? 'checked' : "" ; ?> >
                                                        <label class="custom-control-label" for="female">Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Marital Status</label>
                                                <div class="input-group">
                                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                                        <input type="radio" class="custom-control-input" id="married" <?= ($employee['mar_status'] == 'married') ? 'checked' : "" ; ?>>
                                                        <label class="custom-control-label" for="married">Married</label>
                                                    </div>
                                                    <div class="d-inline-block custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="single" <?= ($employee['mar_status'] == 'single') ? 'checked' : "" ; ?> >
                                                        <label class="custom-control-label" for="single">Single</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="blood_type">Blood Type<span class="text-danger">*</span></label>
                                                <select class="custom-select <?= isset($errors['blood_type']) ? 'is-invalid' : ''; ?>" name="blood_type">
                                                <?php if ($employee['blood_type']): ?>
                                                    <option value="<?=$employee['blood_type']?>"><?=$employee['blood_type']?></option>
                                                <?php else : ?>
                                                    <option value="">Select Blood Type</option>
                                                <?php endif ?>
                                                    <option value="A+">A+</option>
                                                    <option value="B+">B+</option>
                                                    <option value="O+">O+</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B-">B-</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                                <?php if(isset($errors['blood_type'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['blood_type'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="t_shirt_size">T-Shirt Size<span class="text-danger">*</span></label>
                                                <input type="text" name="t_shirt_size" parsley-trigger="change" class="form-control <?= isset($errors['dob']) ? 'is-invalid' : ''; ?>" id="t_shirt_size" value="<?= $employee['t_shirt_size'] ?>">
                                                <?php if(isset($errors['t_shirt_size'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['t_shirt_size'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">Email Address</label>
                                                <input class="form-control" id="email" placeholder="Please enter employee email" type="text" name="email" value="<?= $employee['email'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address">Home Address<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['address']) ? 'is-invalid' : ''; ?>" id="address" placeholder="Please enter employee complete address" type="text" name="address" value="<?= $employee['address'] ?>">
                                                <?php if(isset($errors['address'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['address'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address"></label>
                                                <button type="button" class="btn btn-outline-success btn-icon btn-lg mr-1 mb-1 btn-block"><?=($employee['avatar']!=="./assets/emp_pics/defult.png")?"Change Picture":"Add New Picture"; ?></button>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>
                                <!-- Step 2 => Emergency Details-->
                                <h6>
                                    <i class="step-icon la la-ambulance font-medium-3"> </i>
                                    In Case Of Emergency
                                </h6>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="emg_name">Emergency Contact Name<span class="danger">*</span></label>
                                                <input class="form-control <?= isset($errors['emg_name']) ? 'is-invalid' : ''; ?>" id="emg_name" name="emg_name" type="text" value="<?= $employee['emg_name'] ?>" />
                                                <?php if(isset($errors['emg_name'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['emg_name'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="emp_relation">Relation By<span class="text-danger">*</span></label>
                                                <select class="custom-select <?= isset($errors['emp_relation']) ? 'is-invalid' : ''; ?>" name="emp_relation">
                                                <?php if ($employee['emp_relation']): ?>
                                                    <option value="<?=$employee['emp_relation']?>"><?=$employee['emp_relation']?></option>
                                                <?php else : ?>
                                                    <option value="">Select Relation Type</option>
                                                <?php endif ?>
                                                    <option value="Father">Father</option>
                                                    <option value="Mother">Mother</option>
                                                    <option value="Brother">Brother</option>
                                                    <option value="Sister">Sister</option>
                                                    <option value="Wife">Wife</option>
                                                    <option value="Son">Son</option>
                                                    <option value="Daughter">Daughter</option>
                                                </select>
                                                <?php if(isset($errors['emp_relation'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['emp_relation'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="emg_mobile">Emergency Mobile No.<span class="danger">*</span></label>
                                                <input class="form-control <?= isset($errors['emg_mobile']) ? 'is-invalid' : ''; ?>" id="emg_mobile" name="emg_mobile" type="text" value="<?= $employee['emg_mobile'] ?>" />
                                                <?php if(isset($errors['emg_mobile'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['emg_mobile'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="emg_address">Home Country Address<span class="danger">*</span></label>
                                                <input class="form-control <?= isset($errors['emg_address']) ? 'is-invalid' : ''; ?>" id="emg_address" name="emg_address" type="text" value="<?= $employee['emg_address'] ?>" />
                                                <?php if(isset($errors['emg_address'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['emg_address'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- Step 3 => Symptoms -->
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

    <script src="<?= base_url('/') ?>/app-assets/js/scripts/forms/custom-file-input.js"></script>

    <script type="text/javascript">

    jQuery(function($) {
        $('.autonumber').autoNumeric('init');
    });
    jQuery.browser = {};
    (function () {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
            jQuery.browser.msie = true;
            jQuery.browser.version = RegExp.$1;
        }
    })();

    jQuery(document).ready(function () {
        $('#passport_exp').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            startDate: '+0d',
    //      ignoreReadonly: true,
        });
        $("#iqama_exp_hijri").hijriDatePicker({
    //        showTodayButton: true,
    //        showClear:true,
    //        useCurrent:false
            locale: "ar-sa",
            hijri:true,
            showSwitcher:false,
            hijriFormat:"iDD/iMM/iYYYY",
            hijriDayViewHeaderFormat: "iMMMM iYYYY",
            showTodayButton: true,
        });
        $('#dob').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            endDate: '+0d',
        });
        $('#insurance_exp').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            startDate: '+0d',
        });
        $('#joining_date').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            endDate: '+0d',
    //      ignoreReadonly: true,
        });

        /******************************************/
        $("#dept").on("change", function() {
            var department = $(this).val();
            // CSRF Hash
            var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
            var csrfHash = $('.txt_csrfname').val(); // CSRF hash
             $.ajax({
                 url: "<?=base_url('employee/getSection')?>",
                 type: "POST",
                 data: {department: department, [csrfName]: csrfHash},
                 dataType: 'json',
                 success: function(response) {
                    // Update CSRF hash
                    $('.txt_csrfname').val(response.token);
                    // Remove options
                    // $("#sectin_nme").append('<option value="">Select Section</option>');
                    $("#sectin_nme").empty();
                    $(response.section).each(function(key,value){
                        $("#sectin_nme").append('<option value="'+this.section_name+'">'+this.section_name+'</option>');
                    });
                 }
             });
         });
        /******************************************/
        $("#vac_period").bind("change", function() {
            var vac_period = $(this).val();
            // CSRF Hash
            var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
            var csrfHash = $('.txt_csrfname').val(); // CSRF hash
            $.ajax({
                type: "POST", 
                url: "<?=base_url('employee/getContractPeriod')?>",
                data: {vac_period: vac_period, [csrfName]: csrfHash},
                dataType: 'json',
                success: function(response) {
                    $('.txt_csrfname').val(response.tokenCP);
                    $(response.cperiod).each(function(key,value){
                        $("#vacation_days").val(this.vac_period);
                        // alert(this.vac_period);
                    });
                }
             });
         });
        /******************************************/

    })

    </script>

<?= $this->endSection(); ?>
<!-- End: Script-->