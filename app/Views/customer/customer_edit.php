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
                        <h4 class="card-title text-white">Edit Customer</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-header">
                        <h4 class="card-title">
                            Edit Customer Information
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
                            
                            <form action="<?= base_url('/customer/edit/'.$customer['id']) ?>" class="add-patient-tabs steps-validation wizard-notification" method="post" id="registrationz">
                                <!-- step 1 => Personal Details -->
                                <!-- CSRF token -->
                                <?= csrf_field() ?>
                                <?php /* ?>
                                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <?php */ ?>
                                <!-- CSRF token -->
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="full_name">Customer Name<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['full_name']) ? 'is-invalid' : ''; ?>" id="full_name" placeholder="Please enter full name" type="text"name="full_name" value="<?=$customer['full_name']?>">
                                                <?php if(isset($errors['full_name'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['full_name'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="injazat_no">Injazat No.<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['injazat_no']) ? 'is-invalid' : ''; ?>" id="injazat_no" placeholder="Please enter injazat no " type="text" name="injazat_no" value="<?= $customer['injazat_no'] ?>">
                                                <?php if(isset($errors['injazat_no'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['injazat_no'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mobile">Mobile<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['mobile']) ? 'is-invalid' : ''; ?>" id="mobile" placeholder="Please enter employee mobile no" type="text" name="mobile" parsley-trigger="change" data-mask="0599999999" value="<?=$customer['mobile']?>">
                                                <?php if(isset($errors['mobile'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['mobile'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="acc_no">Account No.<span class="text-danger">*</span></label>
                                                <input type="text" name="acc_no" placeholder="Please enter account no. " class="form-control <?= isset($errors['acc_no']) ? 'is-invalid' : ''; ?>" id="acc_no" value="<?=$customer['acc_no']?>">
                                                <?php if(isset($errors['acc_no'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['acc_no'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exp_date">Card Expire<span class="text-danger">*</span></label>
                                                <input class="form-control <?= isset($errors['exp_date']) ? 'is-invalid' : ''; ?>" id="exp_date" placeholder="Please select date of expiry" type="text" name="exp_date" autocomplete="off" value="<?=$customer['exp_date']?>">
                                                <?php if(isset($errors['exp_date'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['exp_date'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="shop_no">For Shop<span class="text-danger">*</span></label>
                                                <select class="custom-select <?= isset($errors['shop_no']) ? 'is-invalid' : ''; ?>" id="shop_no" name="shop_no">

                                                <?php if ($customer['shop_no']): ?>
                                                    <option value="<?= $customer['shop_no'] ?>"><?= $customer['shop_no'] ?></option>
                                                <?php else : ?>
                                                    <option value="">Select Section</option>
                                                <?php endif ?>
                                                    <?php foreach ($sections as $section) : ?>
                                                    <option value="<?= $section['section_name'] ?>"><?= $section['section_name'] ?></option>
                                                    <?php endforeach; ?>
                                                    
                                                </select>
                                                <?php if(isset($errors['shop_no'])) : ?>
                                                    <p class="invalid-feedback">
                                                      <?= $errors['shop_no'] ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions right">
                                        <a href="<?= base_url("/customer/view")."/".$customer['id']?>"  class="btn btn-warning mr-1">
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

        $('#exp_date').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: false,
            startDate: '+2y',
        });

        /******************************************/
    })

    </script>

<?= $this->endSection(); ?>
<!-- End: Script-->