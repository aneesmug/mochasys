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
        </div>
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- eCommerce statistic -->
<section id="add-patient">
    <div class="icon-tabs">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-head-inverse bg-blue">
                        <h4 class="card-title text-white">Register New Employee</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
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
                            

                            <form action="<?=base_url('/employee/register')?>" class="add-patient-tabs steps-validation wizard-notification" method="post" id="registration">
                                <!-- step 1 => Personal Details -->

                                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <!-- CSRF token -->
                                <?php  ?>
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
                                                <input class="form-control <?= isset($errors['name']) ? 'is-invalid' : ''; ?>" id="name" placeholder="Please enter full name" type="text"name="name" value="<?= old('name') ?>">
                                                <?php if(isset($errors['name'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['name'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="iqama">Iqama<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['iqama']) ? 'is-invalid' : ''; ?>" id="iqama" placeholder="Please enter iqama / ID" type="text" name="iqama" parsley-trigger="change" data-mask="9999999999" value="<?= old('iqama') ?>">
                                                <?php if(isset($errors['iqama'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['iqama'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="iqama_exp_hijri">Iqama Exp.<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['iqama_exp']) ? 'is-invalid' : ''; ?>" id="iqama_exp_hijri" placeholder="Please enter iqama / ID expiry" type="text" name="iqama_exp" value="<?= old('iqama_exp') ?>">
                                                <?php if(isset($errors['iqama_exp'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['iqama_exp'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="passport">Passport</label>
                                                <input class="form-control" id="passport" placeholder="Please enter passport no" type="text" name="passport" value="<?= old('passport') ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="passport_exp">Passport Exp.</label>
                                                <input class="form-control" id="passport_exp" placeholder="Please enter passport expiry" type="text" name="passport_exp" autocomplete="off" value="<?= old('passport_exp') ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="mobile">Mobile<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['mobile']) ? 'is-invalid' : ''; ?>" id="mobile" placeholder="Please enter employee mobile no" type="text" name="mobile" parsley-trigger="change" data-mask="0599999999" value="<?= old('mobile') ?>">
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
                                                <select class="custom-select <?= isset($errors['country']) ? 'is-invalid' : ''; ?>" id="country" name="country">
                                                    <option value="">Select Country</option>
                                                    <?php foreach ($emp_country as $value) : ?>
                                                    <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                                    <?php endforeach; ?>
                                                    
                                                </select>
                                                <?php if(isset($errors['country'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['country'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['dob']) ? 'is-invalid' : ''; ?>" id="dob" placeholder="Please select date of birth" type="text" name="dob" autocomplete="off" value="<?= old('dob') ?>">
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
                                                        <input type="radio" name="sex" class="custom-control-input" id="male" value="male" checked onclick="CallMe()">
                                                        <label class="custom-control-label" for="male">Male</label>
                                                    </div>
                                                    <div class="d-inline-block custom-control custom-radio">
                                                        <input type="radio" name="sex" class="custom-control-input" id="female" value="female" onclick="CallMe()">
                                                        <label class="custom-control-label" for="female">Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <input type="hidden" name="avatar" id="avatar" value="app-assets/assets/emp_pics/defult.png" readonly="">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Marital Status</label>
                                                <div class="input-group">
                                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                                        <input type="radio" name="mar_status" class="custom-control-input" id="married" value="married">
                                                        <label class="custom-control-label" for="married">Married</label>
                                                    </div>
                                                    <div class="d-inline-block custom-control custom-radio">
                                                        <input type="radio" name="mar_status" class="custom-control-input" id="single" value="single" checked>
                                                        <label class="custom-control-label" for="single">Single</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="blood_type">Blood Type<span class="text-danger">*</span></label>
                                                <select class="custom-select <?= isset($errors['blood_type']) ? 'is-invalid' : ''; ?>" name="blood_type">
                                                    <option value="">Select Blood Type</option>
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
                                                <input type="text" name="t_shirt_size" parsley-trigger="change" class="form-control <?= isset($errors['dob']) ? 'is-invalid' : ''; ?>" id="t_shirt_size" value="<?= old('t_shirt_size') ?>">
                                                <?php if(isset($errors['t_shirt_size'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['t_shirt_size'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email Address</label>
                                                <input class="form-control" id="email" placeholder="Please enter employee email" type="text" name="email" value="<?= old('email') ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">Home Address<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['address']) ? 'is-invalid' : ''; ?>" id="address" placeholder="Please enter employee complete address" type="text" name="address" value="<?= old('address') ?>">
                                                <?php if(isset($errors['address'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['address'] ?>
                                                    </p>
                                                <?php endif ?>
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
                                                <input class="form-control <?= isset($errors['emg_name']) ? 'is-invalid' : ''; ?>" id="emg_name" name="emg_name" type="text" value="<?= old('emg_name') ?>" />
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
                                                    <option value="">Select Relation Type</option>
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
                                                <input class="form-control <?= isset($errors['emg_mobile']) ? 'is-invalid' : ''; ?>" id="emg_mobile" name="emg_mobile" type="text" value="<?= old('emg_mobile') ?>" />
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
                                                <input class="form-control <?= isset($errors['emg_address']) ? 'is-invalid' : ''; ?>" id="emg_address" name="emg_address" type="text" value="<?= old('emg_address') ?>" />
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
                                <!-- Step 4 => Insaurance Details -->
                                <h6>
                                    <i class="step-icon font-medium-3 ft-file-text"> </i>
                                    Other Details
                                </h6>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="emp_id">Employee ID<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['emp_id']) ? 'is-invalid' : ''; ?>" id="emp_id" placeholder="Please enter employee id" type="text" name="emp_id" value="<?= old('emp_id') ?>">
                                                <?php if(isset($errors['emp_id'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['emp_id'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="joining_date">Joining Date<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['joining_date']) ? 'is-invalid' : ''; ?>" id="joining_date" placeholder="Please select joining date" type="text" name="joining_date" value="<?= old('joining_date') ?>">
                                                <?php if(isset($errors['joining_date'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['joining_date'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dept">Department<span class="text-danger">*</span></label>
                                                <select class="custom-select <?= isset($errors['dept']) ? 'is-invalid' : ''; ?>" id="dept" name="dept">
                                                    <option value="">Select Department</option>
                                                    <?php foreach ($department as $value) : ?>
                                                    <option value="<?= $value->dep_nme ?>"><?= $value->dep_nme ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if(isset($errors['dept'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['dept'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sectin_nme">Section<span class="text-danger">*</span></label>
                                                <select class="custom-select" name="sectin_nme" id="sectin_nme" ></select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="emptype">Employee Role<span class="text-danger">*</span></label>
                                                <select class="custom-select <?= isset($errors['emptype']) ? 'is-invalid' : ''; ?>" name="emptype">
                                                    <option value="">Select Employee Role</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Supporter">Supporter</option>
                                                </select>
                                                <?php if(isset($errors['emptype'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['emptype'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="salary">Salary<span class="danger">*</span></label>
                                                <input class="form-control <?= isset($errors['salary']) ? 'is-invalid' : ''; ?> autonumber" id="salary" name="salary" type="text" data-v-max="30000" data-v-min="0" placeholder="Please enter full salary" value="<?= old('salary') ?>" />
                                                <?php if(isset($errors['salary'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['salary'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="emp_sup_type">Sponsorship<span class="text-danger">*</span></label>
                                                <select class="custom-select <?= isset($errors['emp_sup_type']) ? 'is-invalid' : ''; ?>" name="emp_sup_type" id="emp_sup_type">
                                                    <option value="">Select</option>
                                                    <option value="man_power">Man-Power</option>
                                                    <option value="mocha">Mochachino Co.</option>
                                                </select>
                                                <?php if(isset($errors['emp_sup_type'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['emp_sup_type'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="vac_period">Contract Period<span class="text-danger">*</span></label>
                                                <select class="custom-select <?= isset($errors['vac_period']) ? 'is-invalid' : ''; ?>" name="vac_period" id="vac_period">
                                                    <option value="">Select</option>
                                                    <?php foreach ($cperiod as $value) : ?>
                                                        <option value="<?= $value->period ?>"><?= $value->period ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if(isset($errors['vac_period'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['vac_period'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="vacation_days">Vacation Days<span class="text-danger">*</span></label>
                                                <input type="text" name="vacation_days" class="form-control" id="vacation_days" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="insurance_no">Insurance No.</label>
                                                <input type="text" name="insurance_no" class="form-control " id="insurance_no" placeholder="Please enter insurance no." value="<?= old('insurance_no') ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="insurance_exp">Insurance Expire</label>
                                                <input type="text" name="insurance_exp" parsley-trigger="change" class="form-control" id="insurance_exp" autocomplete="off" value="<?= old('insurance_exp') ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="bank_name">Bank Name<span class="text-danger">*</span></label>
                                                <select class="custom-select <?= isset($errors['bank_name']) ? 'is-invalid' : ''; ?>" name="bank_name" id="bank_name">
                                                    <option value="">Select</option>
                                                    <?php foreach ($banks as $value) : ?>
                                                        <option value="<?= $value->name ?>"><?= $value->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if(isset($errors['bank_name'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['bank_name'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="iban">IBAN No.<span class="text-danger">*</span></label>
                                                <input type="text" name="iban" class="form-control <?= isset($errors['iban']) ? 'is-invalid' : ''; ?>"  id="iban" data-mask="SA99 9999 9999 9999 9999 9999" value="<?= old('iban') ?>" />
                                                <?php if(isset($errors['iban'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['iban'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>

                                    </div>
                                    
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


    function CallMe() {  
        if ($("#male").prop("checked")) {
            // alert("Male clicked");
            $("#avatar").val('./app-assets/assets/emp_pics/defult.png');
        }
        if ($("#female").prop("checked")) {
            // alert("Female clicked");
            $("#avatar").val('./app-assets/assets/emp_pics/defultFemale.jpg');
        }
    }


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
<?php /* ?>
var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
("#avatar").change(function(){
    var link = $("#avatar").val();

    var dataJson = { [csrfName]: csrfHash, id: "hello", link: link };

    $.ajax({
        url : "<?php echo base_url('main/test'); ?>",
        type: 'post',
        data: dataJson,            
        success : function(data)
        {   
            csrfName = data.csrfName;
            csrfHash = data.csrfHash;
            alert(data.message);
        }  
    });
});
<?php */ ?>

            /*ajax: {
            url:"<?php //site_url('/employee/getEmployeeIDExp')?>",
            data: function(data){
               // CSRF Hash
               var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
               var csrfHash = $('.txt_csrfname').val(); // CSRF hash
               return {
                  data: data,
                  [csrfName]: csrfHash // CSRF Token
               };
            },
            dataSrc: function(data){

              // Update token hash
              $('.txt_csrfname').val(data.token);
              // Datatable data
              return data.aaData;
            }*/

        /******************************************/
    // $('#sel_user').change(function(){
    //     // CSRF Hash
    //     var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
    //     var csrfHash = $('.txt_csrfname').val(); // CSRF hash
    //     // Username
    //     var username = $(this).val();
    //     // AJAX request
    //     $.ajax({
    //         url: "<?//site_url('users/userDetails')?>",
    //         method: 'post',
    //         data: {username: username,[csrfName]: csrfHash },
    //         dataType: 'json',
    //         success: function(response){
    //             // Update CSRF hash
    //             $('.txt_csrfname').val(response.token);
    //             // Empty the elements
    //             $('#suname,#sname,#semail').text('');
    //             if(response.success == 1){
    //                 // Loop on response
    //                 $(response.user).each(function(key,value){
    //                     var uname = value.username;
    //                     var name = value.name;
    //                     var email = value.email;
    //                     $('#suname').text(uname);
    //                     $('#sname').text(name);
    //                     $('#semail').text(email);
    //                 });
    //             }else{
    //             // Error
    //             alert(response.error);
    //             }
    //         }
    //     });
    // });
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