<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Smart Request List
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
    $newinv = "SMT".$number_pad->number_pad(str_replace("SMT","",$serial['sr'])+1,8);
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
                                    <h4 class="card-title text-white">Smart Request's</h4>
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
                                    <th>id</th>
                                    <th>Invoice No.</th>
                                    <th>Item name</th>
                                    <th>Subject</th>
                                    <th>Location</th>
                                    <!-- <th>Approved by</th> -->
                                    <th>Prepared by</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  foreach ($request_list as $request) :
                                    $status = $request['status'];
                                    if ($status == "draft") {
                                        $status_get = "<span class='btn btn-sm btn-secondary waves-effect'>Not Submited</span>";
                                    } elseif ($status == "Manager") {
                                        $status_get = "<span class='btn btn-sm btn-info waves-effect'>Waiting from Manager</span>";
                                    } elseif ($status == "Finance") {
                                        $status_get = "<span class='btn btn-sm btn-warning waves-effect'>Waiting from Finance</span>";
                                    } elseif ($status == "Management") {
                                        $status_get = "<span class='btn btn-sm btn-primary waves-effect'>Waiting from GM</span>";
                                    } elseif ($status == "approve") {
                                        $status_get = "<span class='btn btn-sm btn-success waves-effect'>GM Approved</span>";
                                    } elseif ($status == "reject") {
                                        $status_get = "<span class='btn btn-sm btn-danger waves-effect'>Reject from GM</span>";
                                    }
                                ?>
                                <tr>
                                    <td><?=$request['id']?></td>
                                    <td><?=$request['inv_no']?></td>
                                    <td><?=$request['item_name']?></td>
                                    <td><?=$request['sub_type']?></td>
                                    <td><?=$request['location']?></td>
                                    <td><?=$request['prep_by']?></td>
                                    <td><?=date('d, M Y',strtotime($request['created_at']))?></td>
                                    <td><?=$status_get?></td>
                                    <td>
                                        <?php  ?>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="<?=base_url('smart/request/view')."/".$request['inv_no']?>" class="btn btn-dark"><i class='ft ft-eye'></i></a>

                                        <?php  ?>
                                            <a href="javascript:void(0);" class="btn btn-danger requestDelete" data-id="<?=$request['inv_no']?>">
                                                <i class='ft ft-trash-2'></i>
                                            </a>
                                        </div>
                                        <?php  ?>
                                    </td>
                                </tr>
                                <?php endforeach;  ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th>Invoice No.</th>
                                    <th>Item name</th>
                                    <th>Subject</th>
                                    <th>Location</th>
                                    <!-- <th>Approved by</th> -->
                                    <th>Prepared by</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th width="100">Action</th>
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
<!--     <script type="text/javascript">
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
    </script> -->
    <script type="text/javascript">
        $(document).on('click', '.requestDelete', function (e) {
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
                        url: '<?=base_url("smartrequest/delete/")?>/'+itemId,
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
            var exportTitle = "All Request List";

            buttonConfig.push({extend:'excel',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-success'});
            buttonConfig.push({extend:'pdf',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-danger'});
            buttonConfig.push({extend:'print' ,exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-dark'});
            /*buttonConfig.push({text: '<i class="ft ft-plus"></i> New Request', action: function ( e, dt, button, config ) {$('#addMachineModal').modal('show') } ,className: 'btn-info'});*/
            buttonConfig.push({text: '<i class="ft ft-plus"></i> New Request', action: function ( e, dt, button, config ) {window.location = '<?=base_url('/smart/request/create/'.$newinv)?>' } ,className: 'btn-info'});

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