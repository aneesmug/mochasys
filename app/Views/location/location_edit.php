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

<?= $this->endSection(); ?>

<?php 

    /*echo "<pre>";
    print_r ($location);
    echo "</pre>";
    exit();*/

?>

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

                <div class="card">
                    <div class="card-header card-head-inverse bg-blue">
                        <h4 class="card-title text-white">Edit Location - <?=$location['section_name']?></h4>
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

                            <form action="<?=base_url('/location/edit/'.$location['id'])?>" method="post">
                                <!-- CSRF token -->
                                <?= csrf_field() ?>
                                <!-- CSRF token -->
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="section_name">Location Name<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['section_name']) ? 'is-invalid' : ''; ?>" id="section_name" placeholder="Enter location name" type="text"name="section_name" value="<?=(old('section_name')!==null)?old('section_name'):$location['section_name']?>">
                                                <?php if(isset($errors['section_name'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['section_name'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="latitude">Latitude<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['latitude']) ? 'is-invalid' : ''; ?>" id="latitude" placeholder="Enter google Latitude" type="text" name="latitude" value="<?=(old('latitude')!==null)?old('latitude'):$location['latitude']?>">
                                                <?php if(isset($errors['latitude'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['latitude'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="longitude">Longitude<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['longitude']) ? 'is-invalid' : ''; ?>" id="longitude" placeholder="Enter google longitude" type="text" name="longitude" value="<?=(old('longitude')!==null)?old('longitude'):$location['longitude']?>">
                                                <?php if(isset($errors['longitude'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['longitude'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="t_bulding_size">Total Bulding Size (M)</label>
                                                <input class="form-control" id="t_bulding_size" placeholder="Enter total bulding base in metters" type="text" name="t_bulding_size" value="<?=(old('t_bulding_size')!==null)?old('t_bulding_size'):$location['t_bulding_size']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dept">Select Department Name<span class="text-danger">*</span></label>
                                                <select class="custom-select <?= isset($errors['dept']) ? 'is-invalid' : ''; ?>" id="dept" name="dept">
                                                    <?php if ($location['dept']): ?>
                                                    <option value="<?=$location['dept']?>"><?=$location['dept']?></option>
                                                    <?php else : ?>
                                                        <option value="">Select Department</option>
                                                    <?php endif ?>

                                                    <?php foreach ($departments as $dept) : ?>
                                                    <option value="<?=$dept->dep_nme?>" <?=($dept->dep_nme==old('dept'))?"selected='selected'":""?> ><?=$dept->dep_nme?></option>
                                                    <?php endforeach; ?>
                                                    
                                                </select>
                                                <?php if(isset($errors['dept'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['dept'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="camera_in">Camera (IN)</label>
                                                <input class="form-control" id="camera_in" placeholder="Enter camera inside" type="text" name="camera_in" value="<?=(old('camera_in')!==null)?old('camera_in'):$location['camera_in']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="camera_out">Camera (OUT)</label>
                                                <input class="form-control" id="camera_out" placeholder="Enter camera outside" type="text" name="camera_out" value="<?=(old('camera_out')!==null)?old('camera_out'):$location['camera_out']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bulding_base">Bulding Base</label>
                                                <input class="form-control" id="bulding_base" placeholder="Enter bulding base" type="text" name="bulding_base" value="<?=(old('bulding_base')!==null)?old('bulding_base'):$location['bulding_base']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="bulding_size">Bulding Size (L * W)</label>
                                                <input class="form-control" id="bulding_size" placeholder="Enter Bulding Size (L * W)" type="text" name="bulding_size" value="<?=(old('bulding_size')!==null)?old('bulding_size'):$location['bulding_size']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="location_dist">District<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['location_dist']) ? 'is-invalid' : ''; ?>" id="location_dist" placeholder="Enter District name" type="text"name="location_dist" value="<?=(old('location_dist')!==null)?old('location_dist'):$location['location_dist']?>">
                                                <?php if(isset($errors['location_dist'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['location_dist'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="b_license_no">Balady License No.<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['b_license_no']) ? 'is-invalid' : ''; ?>" id="b_license_no" placeholder="Enter Balady License No." type="text"name="b_license_no" value="<?=(old('b_license_no')!==null)?old('b_license_no'):$location['b_license_no']?>">
                                                <?php if(isset($errors['b_license_no'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['b_license_no'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="b_license_exp">Balady License Exp.<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['b_license_exp']) ? 'is-invalid' : ''; ?>" id="b_license_exp" placeholder="Enter Balady License Exp." type="text"name="b_license_exp" value="<?=(old('b_license_exp')!==null)?old('b_license_exp'):$location['b_license_exp']?>">
                                                <?php if(isset($errors['b_license_exp'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['b_license_exp'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="location_owner">Location Owner<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['location_owner']) ? 'is-invalid' : ''; ?>" id="location_owner" placeholder="Enter Location owner" type="text"name="location_owner" value="<?=(old('location_owner')!==null)?old('location_owner'):$location['location_owner']?>">
                                                <?php if(isset($errors['location_owner'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['location_owner'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="municipality">Municipality</label>
                                                <input class="form-control" id="municipality" placeholder="Enter Municipality name" type="text"name="municipality" value="<?=(old('municipality')!==null)?old('municipality'):$location['municipality']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sub_municipality">Sub-municipality</label>
                                                <input class="form-control" id="sub_municipality" placeholder="Enter sub municipality name" type="text"name="sub_municipality" value="<?=(old('sub_municipality')!==null)?old('sub_municipality'):$location['sub_municipality']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="location_name">Location Address<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['location_name']) ? 'is-invalid' : ''; ?>" id="location_name" placeholder="Enter location address" type="text"name="location_name" value="<?=(old('location_name')!==null)?old('location_name'):$location['location_name']?>">
                                                <?php if(isset($errors['location_name'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['location_name'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-actions right">
                                        <a href="<?= base_url('/location/list') ?>"  class="btn btn-warning mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            <i class="la la-check-square-o"></i> Update
                                        </button>
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

    jQuery(document).ready(function () {

        $("#b_license_exp").hijriDatePicker({
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

        /******************************************/
    })

    </script>

<?= $this->endSection(); ?>
<!-- End: Script-->