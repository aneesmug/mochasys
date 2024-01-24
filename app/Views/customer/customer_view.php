<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Customer View
<?= $this->endSection(); ?>

<?= $this->section('pageCSS'); ?>
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/material-vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/menu/menu-types/material-vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/colors/material-palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/fonts/mobiriseicons/24px/mobirise/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/pages/page-users.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/extensions/sweetalert2.min.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/plugins/pickers/daterange/daterange.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri_css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri_css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/bootstrap-timepicker.min.css">


    <!-- END: Vendor CSS-->

<?php


// if($employee['emp_sup_type'] == 'mocha'){
//     $finalvacd = $employee['vacation_days'] - $vacation['SUMDAYS'];
// }else{
//     $finalvacd = "";
// }


//     $vaclists = $vaclists->where('emp_id',$employee['emp_id'])->findAll();


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
                <!-- users view start -->
                <section class="users-view">
                    <!-- users view media object start -->
                    <div class="row">
                        <div class="col-12 col-sm-7">
                        </div>
                        <?php if ($customer['status'] == "A") { ?>
                        <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">                            
                            <?php if ($customer['injazat_no'] != 0 ) { ?>
                            <a href="" class="btn btn-sm btn-dark mr-25" data-toggle="modal" data-target="#VIPCard"><i class="ft ft-upload"></i> Update VIP Card </a>
                            <?php } ?>
                            <a href="" class="btn btn-sm mr-25 btn-primary" data-toggle="modal" data-target="#NewVIPCard"><i class="ft ft-plus"></i> New VIP Card
                            </a>
                            <a href="<?=base_url('customer/edit')."/".$customer['id']?>" class="btn btn-sm btn-info"><i class="ft ft-edit"></i> Edit</a>

                        </div>
                        <?php } ?>
                    </div>

                    <!-- users view media object ends -->
                    <!-- users view card data start -->
                    <div class="card">
                        <div class="card-content">
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

                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Customer Name:</th>
                                                        <th>No of Renewals:</th>
                                                        <th>Mobile:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $customer['full_name'] ?></td>
                                                        <td><?= count($cards) ?></td>
                                                        <td><?= $customer['mobile'] ?></td>
                                                    </tr>
                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Injazat No.:</th>
                                                        <th>Account No.:</th>
                                                        <th>Expiry Date:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $customer['injazat_no'] ?></td>
                                                        <td><?= $customer['acc_no'] ?></td>
                                                        <td><?= $customer['exp_date'] ?></td>
                                                    </tr>
                                                </tbody>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- users view card data ends -->
                    <!-- users view salary details start -->                    
                </section>
                <!-- account setting page start -->
                <section >
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-head-inverse bg-blue">
                                    <h4 class="card-title text-white">VIP Card's List</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <table class="table table-hover fileexport">
                                            <thead>
                                                <tr>
                                                    <th>Injazat No.</th>
                                                    <th>Expiry Date</th>
                                                    <th>Received from Shop</th>
                                                    <th>Date of Registration</th>
                                                    <th width="30">Status</th>
                                                    <th width="40">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($cards as $value) : ?>
                                                <tr>
                                                    <td><?= $value['injazat_no'] ?></td>
                                                    <td><?= $value['exp_date'] ?></td>
                                                    <td><?= $value['sectin_nme'] ?></td>
                                                    <td><?= $value['created_at'] ?></td>
                                                    <td><?= ($value['status'] == "A") ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Expired</span>" ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="<?=$value['id']?>" class="btn btn-info"><i class='ft ft-edit'></i></a>
                                                            <a href="javascript:void(0);" class="btn btn-danger delete" data-id="<?=$value['id']?>">
                                                                <i class='ft ft-trash-2'></i>
                                                            </a>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Injazat No.</th>
                                                    <th>Expiry Date</th>
                                                    <th>Received from Shop</th>
                                                    <th>Date of Registration</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- account setting page end -->
                <!-- users view ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

<!-- Modal -->
<div class="modal fade text-left" id="VIPCard" tabindex="-1" role="dialog" aria-labelledby="VIPCardUpdate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="VIPCardUpdate">Update VIP Card Expiry</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('/customer/update_card')."/".$customer['id']?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="exp_date">Card Expire<span class="text-danger">*</span></label>
                        <input class="form-control <?= isset($errors['exp_date']) ? 'is-invalid' : ''; ?>" id="exp_date" placeholder="Please select date of expiry" type="text" name="exp_date" autocomplete="off" value="<?= old('exp_date') ?>" required>
                        <?php if(isset($errors['exp_date'])) : ?>
                            <p class="invalid-feedback">
                              <?= $errors['exp_date'] ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="sectin_nme">For Shop<span class="text-danger">*</span></label>
                        <select class="custom-select <?= isset($errors['sectin_nme']) ? 'is-invalid' : ''; ?>" id="sectin_nme" name="sectin_nme" required>
                            <option value="">Select Shop</option>
                            <?php foreach ($sections as $section) : ?>
                            <option value="<?= $section['section_name'] ?>"><?= $section['section_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if(isset($errors['sectin_nme'])) : ?>
                            <p class="invalid-feedback">
                              <?= $errors['sectin_nme'] ?>
                            </p>
                        <?php endif ?>
                    </div> 
                    <input type="hidden" name="cust_no" value="<?=$customer['id']?>">
                    <input type="hidden" name="injazat_no" value="<?=$customer['injazat_no']?>">
                </div>
                <div class="modal-footer">
                    <input type="reset" class="btn btn-danger btn-lg" data-dismiss="modal" value="close">
                    <input type="submit" class="btn btn-info btn-lg" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade text-left" id="NewVIPCard" tabindex="-1" role="dialog" aria-labelledby="VIPCardNew" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="VIPCardNew">Add New VIP Card</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('/customer/add_card')."/".$customer['id']?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="injazat_no">New Injazat No.<span class="text-danger">*</span></label>
                        <input class="form-control <?= isset($errors['injazat_no']) ? 'is-invalid' : ''; ?>" placeholder="Please enter new INJAZAT No." type="text" name="injazat_no" autocomplete="off" value="<?= old('injazat_no') ?>" required>
                        <?php if(isset($errors['injazat_no'])) : ?>
                            <p class="invalid-feedback">
                              <?= $errors['injazat_no'] ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="exp_date_new">Card Expire<span class="text-danger">*</span></label>
                        <input class="form-control <?= isset($errors['exp_date']) ? 'is-invalid' : ''; ?>" id="exp_date_new" placeholder="Please select date of expiry" type="text" name="exp_date" autocomplete="off" value="<?= old('exp_date') ?>" required>
                        <?php if(isset($errors['exp_date'])) : ?>
                            <p class="invalid-feedback">
                              <?= $errors['exp_date'] ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="sectin_nme">For Shop<span class="text-danger">*</span></label>
                        <select class="custom-select <?= isset($errors['sectin_nme']) ? 'is-invalid' : ''; ?>" id="sectin_nme" name="sectin_nme" required>
                            <option value="">Select Shop</option>
                            <?php foreach ($sections as $section) : ?>
                            <option value="<?= $section['section_name'] ?>"><?= $section['section_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if(isset($errors['sectin_nme'])) : ?>
                            <p class="invalid-feedback">
                              <?= $errors['sectin_nme'] ?>
                            </p>
                        <?php endif ?>
                    </div> 
                    <input type="hidden" name="cust_no" value="<?=$customer['id']?>">
                </div>
                <div class="modal-footer">
                    <input type="reset" class="btn btn-danger btn-lg" data-dismiss="modal" value="close">
                    <input type="submit" class="btn btn-info btn-lg" value="Add New">
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>
<!-- END: Content-->

<!-- Start: Script-->
<?= $this->section('script'); ?>

    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

    <!-- BEGIN: Vendor JS-->
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/material-vendors.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <script src="<?= base_url('/') ?>/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/extensions/polyfill.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pages/account-setting.js"></script>


    <!-- BEGIN: Page JS-->
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pages/material-app.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/buttons.flash.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/jszip.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/pdfmake.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/vfs_fonts.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/buttons.html5.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/buttons.print.min.js"></script>

    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/bootstrap-timepicker.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri/bootstrap-hijri-datetimepicker.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri/bootstrap-hijri-datetimepicker.min.js"></script>

    <!-- END: Page JS-->

    <script type="text/javascript">
    $(document).ready(function(){

        var buttonConfig = [];
        var columnsConfig = [ 0, 1, 2, 3, 4 ];
        var exportTitle = "All Expiry ID Employees";

        buttonConfig.push({extend:'excel',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-success'});
        buttonConfig.push({extend:'pdf',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-danger'});
        buttonConfig.push({extend:'print' ,exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-dark'});

        $('.fileexport').DataTable( {
            dom: 'Bfrtip',
            responsive: true,
            buttons: buttonConfig
        } );
    });

    $(document).on('click', '.delete', function (e) {
            e.preventDefault();
            var itemId      = $(this).data('id');
            var csrfName    = $('.txt_csrfname').attr('name'); // CSRF Token name
            var csrfHash    = $('.txt_csrfname').val(); // CSRF hash
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        url: '<?=base_url("customer/delete_card/")?>/'+itemId,
                        type: 'POST',
                        data: {id:itemId, [csrfName]: csrfHash},
                        dataType: 'json'
                    })
                    .done(function(response){
                        $('.txt_csrfname').val(response.token);

                        swal('Deleted!', response.message, response.status);
                        window.location.reload();
                    })
                    .fail(function(){
                        swal('Oops...', 'Something went wrong with ajax!', 'error');
                    });
                });
                },
                    allowOutsideClick: false     
            }); 
        });

        /******************************************/
    jQuery(document).ready(function () {

        $('#exp_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            todayHighlight: false,
            startDate: '+2y',
        });
        $('#exp_date_new').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            todayHighlight: false,
            startDate: '+2y',
        });
    })
        /******************************************/


    </script>

<?= $this->endSection(); ?>
<!-- End: Script-->