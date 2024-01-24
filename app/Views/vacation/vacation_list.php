<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Vacation Applied List
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

    
    
    <!-- END: Page CSS-->

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/plugins/pickers/daterange/daterange.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri_css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri_css/bootstrap-datetimepicker.min.css">

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
    


    if (session()->get('user')['user_type'] == 'dept_user') {
        $vacations  = $vacations->where('status',$status)->where('dept',session()->get('user')['user_dept'])->get()->getResultArray();
        $empreplc   = $replacement->where('dept',session()->get('user')['user_dept'])->where('status','active')->findAll();
    } elseif (session()->get('user')['user_type'] == 'employee') {
        $vacations  = $vacations->where('emp_id',session()->get('user')['emp_data']['emp_id'])->get()->getResultArray();
        $empreplc   = $replacement->where('dept',session()->get('user')['user_dept'])->where('status','active')->findAll();
    } else {
        $vacations  = $vacations->where('status',$status)->get()->getResultArray();
        $empreplc   = $replacement->where('status','active')->findAll();
    }

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
                                    <th>Vacation Type</th>
                                    <?php if ($request->uri->getSegment(2) == "approved"): ?>
                                    <th>Days</th>
                                    <?php endif ?>
                                    <th>Vacation Date</th>
                                    <th>Return Date</th>
                                    <th>Applied Date</th>
                                    <?php if ($request->uri->getSegment(2) == "rejected"): ?>
                                    <th>Reject Note</th>
                                    <?php endif ?>
                                    <th width="80">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vacations as $vacation) : ?>
                                <?php 
                                    $emg = ($vacation['fly_type'] == "emergency")?((strtotime($vacation['return_date']) - strtotime($vacation['vac_strt_date'])) / 86400) ." <small>Emergency Days</small>" :"";
                                    $fly_type=($vacation['fly_type'])?"<span class='badge badge badge-info float-right mr-2'>".ucfirst($vacation['fly_type'])."</span>":"";
                                    ?>
                                <tr>
                                    <td><?=$vacation['id']?></td>
                                    <td><?=$vacation['emp_id']?></td>
                                    <td><?=$vacation['emp_name'] ?></td>
                                    <td><?=$vacation['dept']?></td>
                                    <td><?=$vacation['vac_type']."".$fly_type?></td>
                                    <?php if ($request->uri->getSegment(2) == "approved"): ?> 
                                    <td><?=($vacation['fly_type'] == "emergency")?$emg:$vacation['vacdays']?></td>
                                    <?php endif ?>
                                    <td><?=$vacation['vac_strt_date']?></td>
                                    <td><?=$vacation['return_date']?></td>
                                    <td><?=$vacation['created_at']?></td>
                                    <?php if ($request->uri->getSegment(2) == "rejected"): ?>
                                    <td><?=$vacation['hr_note']?></td>
                                    <?php endif; ?>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            
                                            <a href="<?=base_url("vacation/view/".$vacation['id'])?>" class="btn btn-dark"><i class='ft ft-eye'></i></a>
                                            <?php if($vacation['status'] == 'apply' OR $vacation['status'] == 'dept_approve'): ?>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#large<?=$vacation['id']?>" class="btn btn-warning"><i class='ft ft-navigation'></i></a>
                                            <?php endif ?>
                                            <a href="<?=base_url('employee/edit')."/".$vacation['id']?>" class="btn btn-info"><i class='ft ft-edit'></i></a>
                                            <a href="javascript:void(0);" class="btn btn-danger delete" data-id="<?=$vacation['id']?>">
                                                <i class='ft ft-trash-2'></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>

<!-- Modal -->
<div class="modal fade text-left" id="large<?=$vacation['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add Details for Vacation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url("/vacation/updatehr/".$vacation['id'])?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                
                <!--____________________________________-->
                <div class="row">
                    <div class="col-6" onclick="
                        $('#approved<?=$vacation['id']?>')          .show();
                        $('#notapprove<?=$vacation['id']?>')        .hide();
                        $('#ticket_pay<?=$vacation['id']?>')        .attr('required', '');
                        $('#permit_fee<?=$vacation['id']?>')        .attr('required', '');
                        $('#hr_note<?=$vacation['id']?>')           .removeAttr('required', '');
                        $('#statusa<?=$vacation['id']?>')           .attr('name','status');
                        $('#statusn<?=$vacation['id']?>')           .removeAttr('name');
                        $('#reviewa<?=$vacation['id']?>')           .attr('name','review');
                        $('#replacement_per<?=$vacation['id']?>')   .attr('required', '');
                        $('#replacement_per<?=$vacation['id']?>')   .attr('name','replacement_per');
                    ">
                        <div class="card card-content bg-gradient-x-success pull-up" style="cursor: pointer !important;">
                            <div class="row">
                                <div class="col-sm-12 card-gradient-md-border">
                                    <div class="card-body text-center"><h1 class="display-4 text-white">Approve</h1></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6" onclick="
                        $('#approved<?=$vacation['id']?>')          .hide();
                        $('#notapprove<?=$vacation['id']?>')        .show();
                        $('#ticket_pay<?=$vacation['id']?>')        .removeAttr('required', '');
                        $('#permit_fee<?=$vacation['id']?>')        .removeAttr('required', '');
                        $('#hr_note<?=$vacation['id']?>')           .attr('required', '');
                        $('#statusa<?=$vacation['id']?>')           .removeAttr('name');
                        $('#statusn<?=$vacation['id']?>')           .attr('name','status');
                        $('#reviewa<?=$vacation['id']?>')           .removeAttr('name');
                        $('#replacement_per<?=$vacation['id']?>')   .removeAttr('required', '');
                        $('#replacement_per<?=$vacation['id']?>')   .removeAttr('name');
                    ">
                        <div class="card card-content bg-gradient-x-danger pull-up" style="cursor: pointer !important;">
                            <div class="row">
                                <div class="col-sm-12 card-gradient-md-border">
                                    <div class="card-body text-center"><h1 class="display-4 text-white">Reject</h1></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--____________________________________-->

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Employee ID.</label>
                        <input type="text" value="<?=$vacation['emp_id']?>" name='emp_id' class="form-control" readonly />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Employee Name</label>
                        <input type="text" value="<?=$vacation['emp_name']?>" class="form-control" readonly />
                    </div>
                </div>
                <div class="form-row" id="approved<?=$vacation['id']?>" style="display: none;">
                    <div class="form-group col-md-6">
                        <label for="name">Vacation Date</label>
                        <input type="text" value="<?=$vacation['vac_strt_date']?>" class="form-control" name="vac_strt_date" placeholder="yyyy-mm-dd" onclick="$(this).datepicker({format: 'yyyy-mm-dd',autoclose: true})" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="return_date">Return Date</label>
                        <input type="text" value="<?=$vacation['return_date']?>" class="form-control" name="return_date" placeholder="yyyy-mm-dd" onclick="$(this).datepicker({format: 'yyyy-mm-dd',startDate: '+0d',autoclose: true})" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_vac_date">Last Vac. Date</label>
                        <input type="text" value="<?=$vacation['last_vac_date']?>" class="form-control" name="last_vac_date" placeholder="yyyy-mm-dd" onclick="$(this).datepicker({format: 'yyyy-mm-dd',autoclose: true})" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="type">Replacement Person!<span class="text-danger">*</span></label>
                        <select class="custom-select" name="replacement_per" id="replacement_per<?=$vacation['id']?>">
                            <?php if ($vacation['replacement_per']): ?>
                                <option value="<?=$vacation['replacement_per']?>"><?=$vacation['replacement_per']?></option>    
                            <?php endif ?>
                            <option value="">Select</option>
                        <?php
                            foreach ($empreplc as $value): 
                        ?>
                            <option value="<?=$value['name']?>"><?=$value['name']?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                    
                    <?php if ($vacation['vac_type'] == 'Fly' AND $vacation['fly_type'] <> 'emergency'): ?>
                    <div class="form-group col-md-6">
                        <label for="type">Ticket Allowance<span class="text-danger">*</span></label>
                        <input type="text" name="ticket_pay" class="form-control" id="ticket_pay<?=$vacation['id']?>" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_select" >Exit Re-Entry Permit Fee<span class="text-danger">*</span></label>
                        <input type="text" name="permit_fee" class="form-control" id="permit_fee<?=$vacation['id']?>" />
                    </div>
                    <input type="hidden" value="<?=$vacation['fly_type']?>" name="fly_type"  />
                    <?php endif ?>

                    <?php if (session()->get('user')['user_type'] == 'dept_user'): ?>
                        <input type="hidden" value="dept_approve" id="statusa<?=$vacation['id']?>" />
                        <input type="hidden" value="A" id="reviewa<?=$vacation['id']?>" />
                    <?php else: ?>
                        <input type="hidden" value="approve" id="statusa<?=$vacation['id']?>" />
                        <input type="hidden" value="C" id="reviewa<?=$vacation['id']?>" />
                    <?php endif ?>


                </div>
                <div class="form-row" id="notapprove<?=$vacation['id']?>" style="display: none;">
                    <div class="form-group col-md-12">
                        <label for="hr_note">Rejection Note<span class="text-danger">*</span></label>
                        <input type="text" name="hr_note" class="form-control" id="hr_note<?=$vacation['id']?>" />
                        <input type="hidden" value="not_approve" class="form-control" id="statusn<?=$vacation['id']?>" />
                        <input type="hidden" value="<?=$vacation['fly_type']?>" name="fly_type"  />
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


                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th width="50">Emp. ID</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Vacation Type</th>
                                    <?php if ($request->uri->getSegment(2) == "approved"): ?>
                                    <th>Days</th>
                                    <?php endif ?>
                                    <th>Vacation Date</th>
                                    <th>Return Date</th>
                                    <th>Applied Date</th>
                                    <?php if ($request->uri->getSegment(2) == "rejected"): ?>
                                    <th>Reject Note</th>
                                    <?php endif ?>
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

    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/bootstrap-timepicker.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri/bootstrap-hijri-datetimepicker.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri/bootstrap-hijri-datetimepicker.min.js"></script>

    <!-- END: Page JS-->
    <script type="text/javascript">
        /*function ShowHideDiv(btnPassport) {
            var dvPassport = document.getElementById("dvPassport<?//$vacation['id']?>");
            dvPassport.style.display = btnPassport.value == "Yes" ? "block" : "none";
        }*/
    </script>
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
                        url: '<?=base_url("vacation/delete_vac/")?>/'+itemId,
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