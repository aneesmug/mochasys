<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Customers List
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
        <div class="card">
            <div class="card-header card-head-inverse bg-blue">
                <h4 class="card-title text-white">Customers List</h4>
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
                    <?php if (session()->getFlashData('success') != null) : ?>
                        <div class="alert bg-success alert-icon-left alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                            <strong>Well done!</strong> <?= session()->getFlashData('success') ?>
                        </div>
                    <?php endif ?>
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <table class="table fileexport">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Injazat No.</th>
                                    <th>Acc. No.</th>
                                    <th>Mobile</th>
                                    <th>IssueDate</th>
                                    <th>ExpDate</th>
                                    <th>Status</th>
                                    <th width="70">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Injazat No.</th>
                                    <th>Acc. No.</th>
                                    <th>Mobile</th>
                                    <th>IssueDate</th>
                                    <th>ExpDate</th>
                                    <th>Status</th>
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
    <!-- END: Page JS-->

    <script type="text/javascript">


<?php  ?>
$(document).ready(function(){

/* For Export Buttons available inside jquery-datatable "server side processing" - Start
- due to "server side processing" jquery datatble doesn't support all data to be exported
- below function makes the datatable to export all records when "server side processing" is on */
    function newexportaction(e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;
        dt.one('preXhr', function (e, s, data) {
            // Just this once, load all data from the server...
            data.start = 0;
            data.length = 2147483647;
            dt.one('preDraw', function (e, settings) {
                // Call the original action function
                if (button[0].className.indexOf('buttons-copy') >= 0) {
                    $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                    $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                    $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                    $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-print') >= 0) {
                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                }
                dt.one('preXhr', function (e, s, data) {
                    // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                    // Set the property to what it was before exporting.
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });
                // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                setTimeout(dt.ajax.reload, 0);
                // Prevent rendering of the full data to the DOM
                return false;
            });
        });
        // Requery the server with the new one-time export settings
        dt.ajax.reload();
    };
    //For Export Buttons available inside jquery-datatable "server side processing" - End

        var buttonConfig = [];
        var exportTitle = "All Customers"
        // buttonConfig.push({extend:'excel',exportOptions: {columns: [ 0, 1, 2, 3, 4, 5 ]} ,title: exportTitle,className: 'btn-success', action: newexportaction});
        buttonConfig.push({text: 'Excel', action: function ( e, dt, button, config ) {window.location = '<?=base_url('customer/exportExcel')?>' } ,className: 'btn-success'});
        buttonConfig.push({text: 'Pdf', action: function ( e, dt, button, config ) {window.location = '<?=base_url('customer/exportPdf')?>' } ,className: 'btn-danger'});
        // buttonConfig.push({extend:'pdf',exportOptions: {columns: [ 0, 1, 2, 3, 4, 5 ]} ,title: exportTitle,className: 'btn-danger', action: newexportaction});
        // buttonConfig.push({extend:'print' ,exportOptions: {columns: [ 0, 1, 2, 3, 4, 5 ]} ,title: exportTitle,className: 'btn-dark', action: newexportaction});
        // buttonConfig.push({text: '<i class="fa fa-plus"></i> Add Customer', action: function ( e, dt, button, config ) {window.location = './add_customer.php' } ,className: 'btn-info'});


        $('.fileexport').DataTable({
            dom: "Bfrtip",
            lengthMenu: [[10, 100, -1], [10, 100, "All"]],
            buttons: buttonConfig,
            responsive: true,
            processing: true,
            serverSide: true,
            serverMethod: 'get',
            ajax: {
            url:"<?=base_url('/customer/getCustomers')?>",
            <?php /* ?>
            url:"<?=route_to('get.all.customers')?>",
            <?php */ ?>
            'data': function(data){
               // CSRF Hash
               // var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
               // var csrfHash = $('.txt_csrfname').val(); // CSRF hash
               return {
                  data: data,
                  // [csrfName]: csrfHash // CSRF Token
               };
            },
            dataSrc: function(data){
              // Update token hash
              // $('.txt_csrfname').val(data.token);
              // Datatable data
              return data.aaData;
            }
         },
         'columns': [
            // { data: 'id' },
            { data: 'full_name' },
            { data: 'injazat_no' },
            { data: 'acc_no' },
            { data: 'mobile' },
            { data: 'updated_at' },
            { data: 'exp_date' },
            { data: 'status' },
            { data: 'action' },
         ]
      });
});


// filter users with status
$('#status').change(function() {
  user_table.draw();
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
                    url: '<?=base_url("customer/delete/")?>/'+itemId,
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