<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Employee Contant List
<?= $this->endSection(); ?>
<?php
if (!$permission->authorize($permission->method('/employee/contant/list','read')->access())) {
    session()->setFlashData('error', "You do not have permission to access. Please contact with administrator.");
    \Config\Services::response()->redirect(base_url('/dashboard'))->send();
}
?>
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


<?php

    $request = \Config\Services::request();
    
    if ($request->uri->getSegment(2) == "applied") {
        $status = (session()->get('user')['user_type'] == 'dept_user') ? 'apply' : 'dept_approve' ;
    }elseif ($request->uri->getSegment(2) == "approved") {
        $status = 'approve';
    }elseif ($request->uri->getSegment(2) == "rejected") {
        $status = 'not_approve';
    }
    
    $contants  = $tempContant
                    ->select('employee_temp_contants.*,employees.name,employees.dept')
                    ->join('employees','employees.emp_id=employee_temp_contants.emp_id')
                    ->where('employee_temp_contants.status','A')
                    ->get()
                    ->getResultArray();
   
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
<!-- users list start -->
<section class="users-list-wrapper">

    <div class="users-list-table">

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
                <h4 class="card-title text-white"><?= ucfirst($request->uri->getSegment(2)) ?> List</h4>
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
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table fileexport">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th width="50">Emp. ID</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Type of Docu.</th>
                                    <th width="80">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contants as $contant) : ?>
                                <tr>
                                    <td><?=$contant['id']?></td>
                                    <td><?=$contant['emp_id']?></td>
                                    <td><?=$contant['name'] ?></td>
                                    <td><?=$contant['dept']?></td>
                                    <td><?=$contant['type']?></td>
                                    <td>
                                        <?php  ?>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="<?=base_url("/employee/download/".$contant['id'])?>" class="btn btn-dark"><i class='ft ft-download'></i></a>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#large<?=$contant['id']?>" class="btn btn-info"><i class='ft ft-eye'></i></a>
                                            <a href="javascript:void(0);" class="btn btn-danger delete" data-id="<?=$contant['id']?>">
                                                <i class='ft ft-trash-2'></i>
                                            </a>
                                        </div>
                                        <?php  ?>
                                    </td>
                                </tr>
<?php  ?>
<!-- Modal -->
<div class="modal fade text-left" id="large<?=$contant['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Approval for <?=$contant['type']?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url("/employee/contantStatus/".$contant['id'])?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <label for="shop_no">Please select<span class="text-danger">*</span></label>
                <select required="" onchange="                        
                    if($(this).val() == 'approve'){
                        $('#approved<?=$contant['id']?>')           .show();
                        $('#notapprove<?=$contant['id']?>')         .hide();
                        $('#notesa<?=$contant['id']?>')             .attr('name','notes');
                        $('#notesna<?=$contant['id']?>')            .removeAttr('name','');
                        $('#notesna<?=$contant['id']?>')            .removeAttr('required','');
                    }else if($(this).val() == 'not_approve'){
                        $('#notapprove<?=$contant['id']?>')         .show();
                        $('#approved<?=$contant['id']?>')           .hide();
                        $('#notesa<?=$contant['id']?>')             .removeAttr('name','');
                        $('#notesna<?=$contant['id']?>')            .attr('name','notes');
                        $('#notesna<?=$contant['id']?>')            .attr('required','');
                    }
                    " class="custom-select" id="shop_no">
                    <option value="">Select from List</option>
                    <option value="approve">Approve</option>
                    <option value="not_approve">Reject</option>
                </select>
                
                <div class="form-row" id="approved<?=$contant['id']?>" style="display: none;">
                    <input type="hidden" value="approve" class="form-control" id="notesa<?=$contant['id']?>" />
                </div>
                <div class="form-row" id="notapprove<?=$contant['id']?>" style="display: none;">
                    <div class="form-group col-md-12">
                        <label for="note<?=$contant['id']?>">Rejection Note<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="notesna<?=$contant['id']?>" />
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Update Details</button>
            </div>
        </div>
        </form>
    </div>
</div>
<?php  ?>


                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th width="50">Emp. ID</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Type of Docu.</th>
                                    <th width="80">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- datatable ends -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- users list ends -->
</div>
</div>
</div>
<!-- END: Content-->

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

    <!-- END: Page JS-->
    <script type="text/javascript">
    /************************************/
    jQuery('#terminat_emp').on('click', function(event) {  
       $("#ter_note").attr('required', '');
        jQuery('#content').toggle('show');
    });
    /************************************/

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
                        url: '<?=base_url("employee/deleteContent/")?>/'+itemId,
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
            var exportTitle = "All Expiry ID Employees";

            buttonConfig.push({extend:'excel',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-success'});
            buttonConfig.push({extend:'pdf',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-danger'});
            buttonConfig.push({extend:'print' ,exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-dark'});

            $('.fileexport').DataTable( {
                dom: 'Bfrtip',
                responsive: true,
                buttons: buttonConfig,
                order: [[ 0, "desc" ]],
                    "columnDefs": [
                                 {
                                 targets: [ 0 ],
                                 visible: false,
                                 searchable: false
                                 },
                             ],
            } );
        });

        /*jQuery(document).ready(function () {
            $('#date_select').datepicker({
                format: "dd/mm/yyyy",
                autoclose: true,
                todayHighlight: true,
                startDate: '+0d',
            });
            $('#return_date_v').datepicker({
                format: "dd/mm/yyyy",
                autoclose: true,
                todayHighlight: true,
                // startDate: '+0d',
            });
        });*/

        // $(document).ready(function() {
        //     $("#basic-form").validate();
        // });

    </script>


<?= $this->endSection(); ?>
<!-- End: Script-->