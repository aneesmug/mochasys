<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co. | Location List
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

// dd($locations);

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
                                    <h4 class="card-title text-white">Locations List</h4>
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
                                    <th>ID</th>
                                    <th>Section Name</th>
									<th>Department</th>
									<th>Bulding Base</th>
						            <th>Bulding Size</th>
						            <th>Address</th>
					                <th>Devices</th>
					                <th>Status</th>
									<th width="60">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($locations as $location) : ?>
                                <tr>
                                    <td><?=$location['id']?></td>
                                    <td><?=$location['section_name']?></td>
									<td><?=$location['dept']?></td>
									<td><?=$location['camera_in']?></td>
						            <td><?=$location['camera_out']?></td>
						            <td><?=$location['location_name']?></td>
					                <td><?=$location['totalDvc']?></td>
					                <td><?=($location['status'] == "A") ? "<span class='badge badge-success'>Active</span>":"<span class='badge badge-danger'>Closed</span>";?></td>
									<td width="60">
										<div class="btn-group" role="group" aria-label="Basic example">
                                            <?php if ($permission->method('/location/list','read')->access()) { ?>
                                            <a href="<?=base_url('location/view')."/".$location['id']?>" class="btn btn-dark"><i class='ft ft-eye'></i></a>
                                            <?php } if ($permission->method('/employee/list','update')->access()) { ?>
                                            <a href="<?=base_url('location/edit')."/".$location['id']?>" class="btn btn-info"><i class='ft ft-edit'></i></a>
                                            <?php } if ($permission->method('/employee/list','delete')->access()) { ?>
                                            <a href="javascript:void(0);" class="btn btn-danger delete" data-id="<?=$location['id']?>">
                                                <i class='ft ft-trash-2'></i>
                                            </a>
                                            <?php } ?>
                                        </div>
									</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Section Name</th>
									<th>Department</th>
									<th>Bulding Base</th>
						            <th>Bulding Size</th>
						            <th>Address</th>
					                <th>Devices</th>
					                <th>Status</th>
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
<div class="modal fade" id="addModuleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form class="contact-input" method="POST" action="<?=base_url('/permission/module/moduleadd')?>">
                    <?=csrf_field()?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Add Module</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="icons">Icon</label>
                                <input type="text" name="icon" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="directory">Directory</label>
                                <input type="text" name="directory" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                        </div>
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <!-- <input type="hidden" id="idmud" name="id"> -->
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Update Details</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<div class="modal fade" id="editModuleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form class="contact-input" method="POST" action="<?=base_url('/permission/module/moduleedit')?>">
                    <?=csrf_field()?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Edit Module Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="icons">Icon</label>
                                <input type="text" id="icons" name="icon" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="directory">Directory</label>
                                <input type="text" id="directory" name="directory" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="description">Description</label>
                                <input type="text" id="description" name="description" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <br><br>
                                <div class="d-inline-block custom-control custom-radio mr-1">
                                    <input type="radio" class="custom-control-input" name="status" id="radio1" value="1">
                                    <label class="custom-control-label" for="radio1">Active</label>
                                </div>
                                <div class="d-inline-block custom-control custom-radio mr-1">
                                    <input type="radio" class="custom-control-input" name="status" id="radio2" value="0">
                                    <label class="custom-control-label" for="radio2">Inactive</label>
                                </div>
                            </div>
                        </div>
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="idmid" name="id">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Update Details</button>
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

        $('.editModuleAttr').click(function() {
            var status          = $(this).data('status');
            $('#idmid')         .val($(this).data('id')); 
            $('#name')          .val($(this).data('name'));
            $('#icons')         .val($(this).data('icons'));
            $('#directory')     .val($(this).data('directory'));
            $('#description')   .val($(this).data('description'));
            $('input[name="status"][value="'+status+'"]').prop('checked', true);
            // // $('input[name="status"]').prop('checked', true);
            // // $("input[name='status']:checked").val(status);
            // // $('input[name="status"]').prop(":checked");
            // // $('input[name="status"][value="'+status+'"]').prop("checked", true);
            // $(status == 1) ? $('input[name="status"][value="'+status+'"]').attr("checked", true) : $('input[name="status"]').removeAttr("checked");
        });

        $('.editSubModuleAttr').click(function() {
            var status      = $(this).data('status');
            var mmodule     = $(this).data('mmodule');
            $('#smid')      .val($(this).data('id')); 
            $('#sname')     .val($(this).data('name'));
            $('#sicon')     .val($(this).data('sicon'));
            $('#sdirectory').val($(this).data('directory'));
            $('input[name="status"][value="'+status+'"]').prop('checked', true);
            $('#smodule option[value="'+mmodule+'"]').prop("selected", "selected");
        });
    

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var buttonConfig = [];
            var columnsConfig = [ 1, 2, 3, 4, 5, 6, 7 ];
            var exportTitle = "All Locations";
            buttonConfig.push({extend:'excel',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-success'});
            buttonConfig.push({extend:'pdf',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-danger'});
            buttonConfig.push({extend:'print' ,exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-dark'});
            /*buttonConfig.push({text: 'Add Module', action: function ( e, dt, button, config ) {$('#addModuleModal').modal('show') } ,className: 'btn-info'});*/
            $('.fileexport').DataTable( {
                dom: 'Bfrtip',
                responsive: true,
                pageLength: 8,
                buttons: buttonConfig,
                order: [[ 0, "desc" ]],
                    "columnDefs": [
                                 {
                                 targets: [ 0 ],
                                 visible: false,
                                 searchable: false
                                 },
                             ],
            });

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
                    url: '<?=base_url("location/delete/")?>/'+itemId,
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

    </script>


<?= $this->endSection(); ?>
<!-- End: Script-->