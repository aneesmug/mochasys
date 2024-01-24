<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Modules List
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
                                    <h4 class="card-title text-white">Module's List</h4>
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
                                    <th width="50">Module ID</th>
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Directory</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th width="80">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($modules as $module) : ?>
                                <tr>
                                    <td width="50"><?=$module['id']?></td>
                                    <td><?=$module['name']?></td>
                                    <td><i class="<?=$module['icon']?>"></i> <?=$module['icon']?></td>
                                    <td><?=$module['directory']?></td>
                                    <td><?=$module['description']?></td>
                                    <td><?=($module['status']==1) ? "<span class=\"badge badge-success float-right\">Active</span>" : "<span class=\"badge badge-danger float-right\">Inactive</span>" ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="javascript:void(0);" class="btn btn-info editModuleAttr" data-toggle="modal" data-target="#editModuleModal" data-id="<?=$module['id']?>" data-name="<?=$module['name']?>" data-status="<?=$module['status']?>" data-icons="<?=$module['icon']?>" data-directory="<?=$module['directory']?>" data-description="<?=$module['description']?>" data-backdrop="static" ><i class='ft ft-edit'></i></a>
                                            <a href="<?=base_url('/permission/module/moduledelete/'.$module['id'])?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete!')">
                                                <i class='ft ft-trash-2'></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="50">Module ID</th>
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Directory</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th width="80">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header card-head-inverse bg-blue">
                                    <h4 class="card-title text-white">Sub-Module's List</h4>
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

                            <table id="users-list-datatable" class="table SubModules">
                            <thead>
                                <tr>
                                    <th width="20">ID</th>
                                    <th width="30">MID</th>
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Directory</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th width="80">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sub_modules as $module) : ?>
                                <tr>
                                    <td width="20"><?=$module['id']?></td>
                                    <td width="30"><?=$module['mid']?></td>
                                    <td><?=$module['name']?></td>
                                    <td><i class="<?=$module['icon']?>"></i> <?=$module['icon']?></td>
                                    <td><?=$module['directory']?></td>
                                    <td><?=$module['description']?></td>
                                    <td><?=($module['status']==1) ? "<span class=\"badge badge-success float-right\">Active</span>" : "<span class=\"badge badge-danger float-right\">Inactive</span>" ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="javascript:void(0);" class="btn btn-info editSubModuleAttr" data-toggle="modal" data-target="#editSubModuleModal" data-id="<?=$module['id']?>" data-name="<?=$module['name']?>" data-status="<?=$module['status']?>" data-sicon="<?=$module['icon']?>" data-directory="<?=$module['directory']?>" data-mmodule="<?=$module['mid']?>" data-backdrop="static" ><i class='ft ft-edit'></i></a>
                                            <a href="<?=base_url('/permission/module/submoduledelete/'.$module['id'])?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete!')">
                                                <i class='ft ft-trash-2'></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="20">ID</th>
                                    <th width="30">MID</th>
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Directory</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th width="80">Action</th>
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
                        <button type="submit" class="btn btn-info">Add Module</button>
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
                                    <!-- <input type="checkbox" name="status" /> -->
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

<div class="modal fade" id="addSubModuleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form class="contact-input" method="POST" action="<?=base_url('/permission/module/submoduleadd')?>">
                    <?=csrf_field()?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Add Sub-Module</h4>
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
                            <div class="form-group col-md-4">
                                <label for="directory">Directory</label>
                                <input type="text" name="directory" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="module">Main-Module</label>
                                <select class="custom-select" name="mid" required="">
                                    <option value="">Select Module</option>
                                    <?php foreach ($modules as $module): ?>
                                    <option value="<?=$module['id']?>"><?=$module['name']?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <!-- <input type="hidden" id="idmud" name="id"> -->
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Add Sub-Module</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<div class="modal fade" id="editSubModuleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form class="contact-input" method="POST" action="<?=base_url('/permission/module/submoduleedit')?>">
                    <?=csrf_field()?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Edit Sub-Module Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" id="sname" name="name" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="icons">Icon</label>
                                <input type="text" id="sicon" name="icon" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="directory">Directory</label>
                                <input type="text" id="sdirectory" name="directory" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description">Description</label>
                                <input type="text" id="description" name="description" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="module">Main-Module</label>
                                <select class="custom-select" name="mid" id="smodule" required="">
                                    <!-- <option value="">Select role</option> -->
                                    <?php foreach ($modules as $module): ?>
                                    <option value="<?=$module['id']?>"><?=$module['name']?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <br><br>
                                <div class="d-inline-block custom-control custom-radio mr-1">
                                    <input type="radio" class="custom-control-input" name="status" id="radio3" value="1">
                                    <label class="custom-control-label" for="radio3">Active</label>
                                </div>
                                <div class="d-inline-block custom-control custom-radio mr-1">
                                    <input type="radio" class="custom-control-input" name="status" id="radio4" value="0">
                                    <label class="custom-control-label" for="radio4">Inactive</label>
                                </div>
                            </div>
                        </div>
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="smid" name="id">
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
            $('input[name="status"][value="'+status+'"]').prop('checked', true);        // Radio Check by Value
            // $('input[name="status"]').prop('checked', status == 1);                  // Checkbox Checked by Value
            // $('#smodule option[value="'+mmodule+'"]').prop("selected", "selected");  // Select Option seleced by Value
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
            var columnsConfig = [ 1, 2, 3, 4, 5, 6, 7, 8 ];
            var exportTitle = "All Modules";

            buttonConfig.push({extend:'excel',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-success'});
            buttonConfig.push({extend:'pdf',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-danger'});
            buttonConfig.push({extend:'print' ,exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-dark'});
            buttonConfig.push({text: 'Add Module', action: function ( e, dt, button, config ) {$('#addModuleModal').modal('show') } ,className: 'btn-info'});

            $('.fileexport').DataTable( {
                dom: 'Bfrtip',
                responsive: true,
                pageLength: 8,
                buttons: buttonConfig,
                order: [[ 0, "desc" ]],
            });

            var buttonConfigSub = [];
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
            });

        });

    </script>


<?= $this->endSection(); ?>
<!-- End: Script-->