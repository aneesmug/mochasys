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
                            <li class="breadcrumb-item"><a href="">Edit</a></li>
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
                    <div class="card-header card-head-inverse bg-blue">
                        <h4 class="card-title text-white">Edit Employee</h4>
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
                            

                            <form action="<?= base_url('/employee/edit/'.$employee['id']) ?>" class="add-patient-tabs steps-validation wizard-notification" method="post" id="registration">
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
                                                <input class="form-control <?= isset($errors['name']) ? 'is-invalid' : ''; ?>" id="name" placeholder="Please enter full name" type="text"name="name" value="<?= $employee['name'] ?>">
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
                                                <input class="form-control <?= isset($errors['iqama']) ? 'is-invalid' : ''; ?>" id="iqama" placeholder="Please enter iqama / ID" type="text" name="iqama" parsley-trigger="change" data-mask="9999999999" value="<?= $employee['iqama'] ?>">
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
                                                <label for="passport">Passport</label>
                                                <input class="form-control" id="passport" placeholder="Please enter passport no" type="text" name="passport" value="<?= $employee['passport'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="passport_exp">Passport Exp.</label>
                                                <input class="form-control" id="passport_exp" placeholder="Please enter passport expiry" type="text" name="passport_exp" autocomplete="off" value="<?= $employee['passport_exp'] ?>">
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
                                                <select class="custom-select <?= isset($errors['country']) ? 'is-invalid' : ''; ?>" id="country" name="country">
                                                
                                                <?php if ($employee['country']): ?>
                                                    <option value="<?= $employee['country'] ?>"><?= $employee['country'] ?></option>
                                                <?php else : ?>
                                                    <option value="">Select Country</option>
                                                <?php endif ?>

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
                                                        <input type="radio" name="sex" class="custom-control-input" id="male" value="male" <?= ($employee['sex'] == 'male') ? 'checked' : "" ; ?> >
                                                        <label class="custom-control-label" for="male">Male</label>
                                                    </div>
                                                    <div class="d-inline-block custom-control custom-radio">
                                                        <input type="radio" name="sex" class="custom-control-input" id="female" value="female" <?= ($employee['sex'] == 'female') ? 'checked' : "" ; ?> >
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
                                                        <input type="radio" name="mar_status" class="custom-control-input" id="married" value="married" <?= ($employee['mar_status'] == 'married') ? 'checked' : "" ; ?>>
                                                        <label class="custom-control-label" for="married">Married</label>
                                                    </div>
                                                    <div class="d-inline-block custom-control custom-radio">
                                                        <input type="radio" name="mar_status" class="custom-control-input" id="single" value="single" <?= ($employee['mar_status'] == 'single') ? 'checked' : "" ; ?> >
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
                                        <div class="col-md-8">
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
                                        <?php /* ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address"></label>
                                                <button type="button" class="btn btn-outline-success btn-icon btn-lg mr-1 mb-1 btn-block"><?=($employee['avatar']!=="./assets/emp_pics/defult.png")?"Change Picture":"Add New Picture"; ?></button>
                                            </div>
                                        </div>
                                        <?php */ ?>
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
                                                <input class="form-control" type="text" value="<?= $employee['emp_id'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="joining_date">Joining Date<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['joining_date']) ? 'is-invalid' : ''; ?>" id="joining_date" placeholder="Please select joining date" type="text" name="joining_date" value="<?= $employee['joining_date'] ?>">
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

                                                <?php if ($employee['dept']): ?>
                                                    <option value="<?=$employee['dept']?>"><?=$employee['dept']?></option>
                                                <?php else : ?>
                                                    <option value="">Select Department</option>
                                                <?php endif ?>

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
                                                <select class="custom-select" name="sectin_nme" id="sectin_nme" >
                                                <?php if ($employee['sectin_nme']): ?>
                                                    <option value="<?=$employee['sectin_nme']?>"><?=$employee['sectin_nme']?></option>
                                                <?php endif ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="emptype">Employee Role<span class="text-danger">*</span></label>
                                                <select class="custom-select <?= isset($errors['emptype']) ? 'is-invalid' : ''; ?>" name="emptype">
                                                
                                                <?php if ($employee['emptype']): ?>
                                                    <option value="<?=$employee['emptype']?>"><?=$employee['emptype']?></option>
                                                <?php else : ?>
                                                    <option value="">Select Employee Role</option>
                                                <?php endif ?>

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
                                                <input class="form-control <?= isset($errors['salary']) ? 'is-invalid' : ''; ?> autonumber" id="salary" name="salary" type="text" data-v-max="30000" data-v-min="0" placeholder="Please enter full salary" value="<?= $employee['salary'] ?>" />
                                                <?php if(isset($errors['salary'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['salary'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="vac_period">Contract Period<span class="text-danger">*</span></label>
                                                <select class="custom-select <?= isset($errors['vac_period']) ? 'is-invalid' : ''; ?>" name="vac_period" id="vac_period">

                                                <?php if ($employee['vac_period']): ?>
                                                    <option value="<?=$employee['vac_period']?>"><?=$employee['vac_period']?></option>
                                                <?php else : ?>
                                                    <option value="">Select Contract Period</option>
                                                <?php endif ?>

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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="vacation_days">Vacation Days<span class="text-danger">*</span></label>
                                                <input type="text" name="vacation_days" class="form-control" id="vacation_days" readonly value="<?= ($employee['vacation_days']) ? $employee['vacation_days'] : "" ; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="insurance_no">Insurance No.</label>
                                                <input type="text" name="insurance_no" class="form-control " id="insurance_no" placeholder="Please enter insurance no." value="<?= $employee['insurance_no'] ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="insurance_exp">Insurance Expire</label>
                                                <input type="text" name="insurance_exp" parsley-trigger="change" class="form-control" id="insurance_exp" autocomplete="off" value="<?= $employee['insurance_exp'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="bank_name">Bank Name<span class="text-danger">*</span></label>
                                                <select class="custom-select <?= isset($errors['bank_name']) ? 'is-invalid' : ''; ?>" name="bank_name" id="bank_name">

                                                <?php if ($employee['bank_name']): ?>
                                                    <option value="<?=$employee['bank_name']?>"><?=$employee['bank_name']?></option>
                                                <?php else : ?>
                                                    <option value="">Select Bank</option>
                                                <?php endif ?>

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
                                                <input type="text" name="iban" class="form-control <?= isset($errors['iban']) ? 'is-invalid' : ''; ?>"  id="iban" data-mask="SA99 9999 9999 9999 9999 9999" value="<?= $employee['iban'] ?>" />
                                                <?php if(isset($errors['iban'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['iban'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                    <?php /* ?>
                                <div class="form-actions right">
                                        <a href="<?= base_url('/employeedash') ?>"  class="btn btn-warning mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                    </div>
                                <?php */ ?>
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