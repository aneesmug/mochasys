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

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/plugins/pickers/daterange/daterange.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri_css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri_css/bootstrap-datetimepicker.min.css">

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
            <div class="card-content">
                <div class="card-body">
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table fileexport">
                            <thead>
                                <tr>
                                    <th width="50">Emp. ID</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Vacation Type</th>
                                    <th>Applied Date</th>
                                    <th width="80">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vacations as $vacation) : ?>
                                <tr>
                                    <td><?=$vacation['emp_id']?></td>
                                    <td><?=$vacation['emp_name'] ?></td>
                                    <td><?=$vacation['dept']?></td>
                                    <td><?=$vacation['vac_strt_date']?></td>
                                    <td><?=$vacation['created_at']?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#large<?=$vacation['id']?>" class="btn btn-dark"><i class='ft ft-eye'></i></a>
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
        <form action="<?= base_url('/vacation/updatehr/'.$vacation['id']) ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add Details for Vacation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="name">Employee ID.</label>
                        <input type="text" value="<?=$vacation['emp_id']?>" class="form-control" readonly />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Employee Name</label>
                        <input type="text" value="<?=$vacation['emp_name']?>" class="form-control" readonly />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Vacation Date</label>
                        <input type="text" value="<?=$vacation['vac_strt_date']?>" class="form-control" name="vac_strt_date" placeholder="dd/mm/yyyy" onclick="$(this).datepicker({format: 'dd/mm/yyyy',startDate: '+0d',autoclose: true})">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="emp_id">Return Date</label>
                        <input type="text" value="<?=$vacation['return_date']?>" class="form-control" name="return_date" placeholder="dd/mm/yyyy" onclick="$(this).datepicker({format: 'dd/mm/yyyy',startDate: '+0d',autoclose: true})">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="type">Ticket Allowance<span class="text-danger">*</span></label>
                        <input type="text" name="ticket_pay" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_select" >Exit Re-Entry Permit Fee<span class="text-danger">*</span></label>
                        <input type="text" name="permit_fee" class="form-control" />
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
                                    <th>Emp. ID</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Vacation Type</th>
                                    <th>Applied Date</th>
                                    <th>Action</th>
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

    <!-- BEGIN: Vendor JS-->
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/material-vendors.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
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
                        url: '<?=base_url("employee/delete/")?>/'+itemId,
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

    </script>


<?= $this->endSection(); ?>
<!-- End: Script-->