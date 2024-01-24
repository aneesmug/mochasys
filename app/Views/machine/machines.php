<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Machines List
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

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/cryptocoins/cryptocoins.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/pages/card-statistics.css">


    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/plugins/forms/switch.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/colors/palette-switch.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/forms/toggle/switchery.min.css">

    <!-- END: Page CSS-->

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/pages/app-contacts.css">

    <!-- END: Vendor CSS-->

<?php

    $request = \Config\Services::request();

    if ($request->uri->getSegment(2) == "applied") {
        $status = (session()->get('user')['user_type'] == 'dept_user') ? 'apply' : 'dept_approve' ;
    }elseif ($request->uri->getSegment(2) == "approved") {
        $status = 'approve';
    }elseif ($request->uri->getSegment(2) == "rejected") {
        $status = 'not_approve';
    }

?>


<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<!-- BEGIN: Content-->
<div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

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

            <div class="content-header row">
            </div>
            <div class="content-detached">
                <div class="content-body">
                    <div class="content-overlay"></div>
                    <section class="row all-contacts">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header card-head-inverse bg-blue">
                                    <h4 class="card-title text-white">Item's List</h4>
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
                                        <!-- Task List table -->
                                        <div class="table-responsive">

                            <table id="users-list-datatable" class="table fileexport">
                            <thead>
                                <tr>
									<th>Sr.</th>
									<th>Location</th>
									<th>Machine Name</th>
						            <th>M. ID</th>
									<th>Serial</th>
									<th>Model</th>
									<th>Remarks</th>
						            <th>Issue Date</th>
                                    <th>Total Inv.</th>
									<th width="60">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($machines as $machine) : ?>
                                <tr>
									<td><?=$machine['iid']?></td>
									<td><?=$machine['mlocation']?></td>
									<td><?=$machine['name_mach']?></td>
									<td><?=$machine['m_id']?></td>
									<td><?=$machine['serial']?></td>
									<td><?=$machine['maker_name']?></td>
									<td><?=$machine['remarks']?></td>
									<td><?=$machine['made_year']?></td>
                                    <td><?=$machine['totalInv']?></td>
                                    <td>
                                    	<?php  ?>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="<?=base_url('machine/view')."/".$machine['iid']?>" class="btn btn-dark"><i class='ft ft-eye'></i></a>
                                            <a href="javascript:void(0);" class="btn btn-info editMachineAttr" data-toggle="modal" data-target="#editMachineModal" data-id="<?=$machine['iid']?>" data-m_name_mach="<?=$machine['name_mach']?>" data-m_m_id="<?=$machine['m_id']?>" data-m_serial="<?=$machine['serial']?>" data-m_maker_name="<?=$machine['maker_name']?>" data-m_remarks="<?=$machine['remarks']?>" data-m_made_year="<?=$machine['made_year']?>" data-location_id="<?=$machine['location_id']?>" data-m_status="<?=$machine['mstatus']?>" ><i class='ft ft-edit'></i></a>
                                        <?php  ?>
                                            <a href="javascript:void(0);" class="btn btn-danger machineDelete" data-id="<?=$machine['iid']?>">
                                                <i class='ft ft-trash-2'></i>
                                            </a>
                                        </div>
                                    	<?php  ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
									<th>Sr.</th>
									<th>Location</th>
									<th>Machine Name</th>
						            <th>M. ID</th>
									<th>Serial</th>
									<th>Model</th>
									<th>Remarks</th>
						            <th>Issue Date</th>
                                    <th>Total Inv.</th>
									<th width="60">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                </div>
            </div>


        </div>
    </div>
<!-- END: Content-->

<!-- START: Model Content-->
<div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form action="<?=base_url('/item/brand/register/')?>" method="post" enctype="multipart/form-data">
                	<?=csrf_field()?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Add Brand</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Brand Name</label>
                                <input type="text" name="name" class="form-control" required data-validation-required-message="This field is required">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <input type="hidden" id="idmud" name="id"> -->
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit_register" class="btn btn-info">Add Brand</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>


<div class="modal fade" id="addMachineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form action="<?=base_url('/machine/register/')?>" method="post" enctype="multipart/form-data">
                    <?=csrf_field()?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Add Machine Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    	<a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#addBrandModal" data-dismiss="modal" ><i class="mdi mdi-settings"></i> Add Brand</a>	
                    	<br><br>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name_mach">Machine Name</label>
                                <input type="text" name="name_mach" class="form-control" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="m_id">Machine ID</label>
                                <input type="text" name="m_id" class="form-control" required="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="serial">Serial No.</label>
                                <input type="text" name="serial" class="form-control" required="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="made_year">Made Year</label>
                                <input type="text" name="made_year" class="form-control" required="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="remarks">Remarks</label>
                                <input type="text" name="remarks" class="form-control" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="maker_name">Select Model Name</label>
                                <select class="form-control" name="maker_name" required="">
                                    <option value="">Select</option>
                                <?php  foreach ($brand_list as $brand): ?>
                                    <option value="<?=$brand["name"] ?>"><?=str_replace(' ', '', $brand["name"]) ?></option>
                                <?php endforeach;  ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="location">Select Location</label>
                                <select class="form-control" name="location" required="">
                                    <option value="">Select</option>
                                <?php  foreach ($location_list as $location): ?>
                                    <option value="<?=$location["id"] ?>"><?=str_replace(' ', '', $location["section_name"]) ?></option>
                                <?php endforeach;  ?>
                                </select>
                            </div>

                            

                        </div>
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit_item_register" class="btn btn-info">Register</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<div class="modal fade" id="editMachineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form action="<?=base_url('/machine/edit/')?>" method="post" enctype="multipart/form-data">
                    <?=csrf_field()?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Edit Item Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name_mach">Machine Name</label>
                                <input type="text" name="name_mach" id="m_name_mach" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="m_id">Machine ID</label>
                                <input type="text" name="m_id" id="m_m_id" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="serial">Serial No.</label>
                                <input type="text" name="serial" id="m_serial" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="made_year">Made Year</label>
                                <input type="text" name="made_year" id="m_made_year" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="remarks">Remarks</label>
                                <input type="text" name="remarks" id="m_remarks" class="form-control">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="maker_name" class="col-form-label">Select Model Name</label>
                                <select class="form-control" name="maker_name" id="maker_name" required="">
                                    <option value="">Select</option>
                                <?php  foreach ($brand_list as $brand): ?>
                                    <option value="<?=$brand["name"] ?>"><?=str_replace(' ', '', $brand["name"]) ?></option>
                                <?php endforeach;  ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="location_id" class="col-form-label">Select Category</label>
                                <select class="form-control" name="location" id="location_id" required="">
                                    <option value="">Select</option>
                                <?php  foreach ($location_list as $location): ?>
                                    <option value="<?=$location["id"] ?>"><?=str_replace(' ', '', $location["section_name"]) ?></option>
                                <?php endforeach;  ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <br><br>
                                <div class="d-inline-block custom-control custom-radio">
                                    <input type="radio" class="custom-control-input " name="status" id="radio5" value="1">
                                    <label class="custom-control-label" for="radio5">Active</label>
                                </div>
                                <div class="d-inline-block custom-control custom-radio">
                                    <input type="radio" class="custom-control-input " name="status" id="radio6" value="0">
                                    <label class="custom-control-label" for="radio6">Inactive</label>
                                </div>
                                    <!-- <input type="checkbox" name="status" /> -->
                            </div>

                        </div>
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="machineid" name="machineid">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit_item_edit" class="btn btn-info">Update Details</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>




<!-- END: Model Content-->
<?= $this->endSection(); ?>
<!-- END: Content-->

<!-- Start: Script-->
<?= $this->section('script'); ?>

    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <!-- BEGIN: Vendor JS-->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- <script src="<?// base_url('/') ?>/app-assets/js/scripts/jquery.min.js"></script> -->
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/material-vendors.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> -->
    <!-- BEGIN Vendor JS-->

    <script src="<?= base_url('/') ?>/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/extensions/polyfill.min.js"></script>


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

    <script src="<?= base_url('/') ?>/app-assets/vendors/js/extensions/jquery.raty.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="<?= base_url('/') ?>/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/forms/toggle/switchery.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js"></script>

    <script src="<?= base_url('/') ?>/app-assets/js/scripts/forms/switch.js"></script>

    <!-- END: Page JS-->
    <script type="text/javascript">
        $('.editMachineAttr').click(function() {
            var m_status      = $(this).data('m_status');
            var location_id     = $(this).data('location_id');
            var maker_name     = $(this).data('m_maker_name');
            $('#machineid')      .val($(this).data('id')); 
            $('#m_name_mach')     .val($(this).data('m_name_mach'));
            $('#m_m_id')     .val($(this).data('m_m_id'));
            $('#m_serial')     .val($(this).data('m_serial'));
            $('#m_maker_name')     .val($(this).data('m_maker_name'));
            $('#m_remarks')     .val($(this).data('m_remarks'));
            $('#m_made_year')     .val($(this).data('m_made_year'));
            $('input[name="status"][value="'+m_status+'"]').prop('checked', true);
            $('#maker_name option[value="'+maker_name+'"]').prop("selected", "selected");
            $('#location_id option[value="'+location_id+'"]').prop("selected", "selected");
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', '.machineDelete', function (e) {
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
                        url: '<?=base_url("machine/delete/")?>/'+itemId,
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

        $(document).ready(function(){

            var buttonConfig = [];
            var columnsConfig = [ 1, 2, 3, 4, 5, 6, 7, 8 ];
            var exportTitle = "All Machines";

            buttonConfig.push({extend:'excel',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-success'});
            buttonConfig.push({extend:'pdf',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-danger'});
            buttonConfig.push({extend:'print' ,exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-dark'});
            /*buttonConfig.push({text: '<i class="fa fa-plus"></i> Add Category', action: function ( e, dt, button, config ) {$('#addModuleModal').modal('show') } ,className: 'btn-success'});*/
            buttonConfig.push({text: '<i class="fa fa-plus"></i> Add Machine', action: function ( e, dt, button, config ) {$('#addMachineModal').modal('show') } ,className: 'btn-info'});
        	/*buttonConfig.push({text: '<i class="fa fa-plus"></i> Add Item', action: function ( e, dt, button, config ) {window.location = './add_item.php' } ,className: 'btn-info'});*/

            $('.fileexport').DataTable( {
                dom: 'Bfrtip',
                responsive: true,
                pageLength: 8,
                buttons: buttonConfig,
                order: [[ 0, "desc" ]],
            });

            /*var buttonConfigSub = [];
            var colConfigSub = [ 1, 2, 3, 4, 5, 6, 7, 8 ];
            var exptTieSub = "All Sub-Modules Employees";

            buttonConfigSub.push({extend:'excel',exportOptions: {columns: colConfigSub} ,title: exptTieSub,className: 'btn-success'});
            buttonConfigSub.push({extend:'pdf',exportOptions: {columns: colConfigSub} ,title: exptTieSub,className: 'btn-danger'});
            buttonConfigSub.push({extend:'print' ,exportOptions: {columns: colConfigSub} ,title: exptTieSub,className: 'btn-dark'});
            buttonConfigSub.push({text: 'Add Sub-Module', action: function ( e, dt, button, config ) {$('#addSubModuleModal').modal('show') } ,className: 'btn-info'});

            $('.SubModules').DataTable( {
                dom: 'Bfrtip',
                responsive: true,
                pageLength: 8,
                buttons: buttonConfigSub,
                order: [[ 0, "desc" ]],
            });*/

        });

    </script>


<?= $this->endSection(); ?>
<!-- End: Script-->