<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Dashboard cPanel
<?= $this->endSection(); ?>
<?= $this->section('pageCSS'); ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/menu/menu-types/material-vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/colors/material-palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/fonts/mobiriseicons/24px/mobirise/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/colors/material-palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/colors/palette-gradient.css">
<?= $this->endSection(); ?>

<?php 

// echo "<pre>";
// print_r ($cont_active);
// echo "</pre>";
// exit();

if (session()->get('user')['user_type'] == 'dept_user') {
    $countapl  = $vacations->where('status','apply')->where('dept',session()->get('user')['user_dept'])->get()->getResultArray();
} else {
    $countapl  = $vacations->where('status','dept_approve')->get()->getResultArray();
}


?>

<?= $this->section('content'); ?>

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-header row">
        </div>
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">

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
                

                <?php if (count($countapl) > 0): ?>    
                    <div class="alert alert-icon-left alert-arrow-left alert-warning alert-dismissible mb-2" role="alert">
                        <span class="alert-icon"><i class="la la-warning"></i></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Good Day!</strong> You have pending <span style="font-size: 20px !important;">(<?=count($countapl)?>)</span> vacation approval's. Click here <a href="<?=base_url('/vacation/applied/list')?>" class="alert-link"><strong>Veiw List.</strong></a>
                    </div>
                <?php endif ?>

                <!-- eCommerce statistic -->
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <!-- <h3 class="info">850</h3> -->
                                            <h3 class="info"><?php echo $cont_active; ?></h3>
                                            <h6>ON JOB EPLOYEES</h6>
                                        </div>
                                        <div>
                                            <i class="icon-basket-loaded info font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: <?= $cont_active * 100 / $cont_tot ?>%" aria-valuenow="<?= $cont_active * 100 / $cont_tot ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="warning"><?= $cont_fly ?></h3>
                                            <h6>ON VACATION EPLOYEES</h6>
                                        </div>
                                        <div>
                                            <i class="icon-pie-chart warning font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: <?= $cont_fly * 100 / $cont_tot ?>%" aria-valuenow="<?= $cont_fly * 100 / $cont_tot ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="primary"><?= $man_power ?></h3>
                                            <h6>MAN POWER EMPLOYEES</h6>
                                        </div>
                                        <div>
                                            <i class="icon-user-follow primary font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-primary" role="progressbar" style="width: <?= $man_power * 100 / $cont_tot ?>%" aria-valuenow="<?= $man_power * 100 / $cont_tot ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="danger"><?= $cont_ter ?></h3>
                                            <h6>TERMINATED EMPLOYEES</h6>
                                        </div>
                                        <div>
                                            <i class="icon-heart danger font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: <?= $cont_ter * 100 / $cont_tot ?>%" aria-valuenow="<?= $cont_ter * 100 / $cont_tot ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success"><?= $cont_tot ?></h3>
                                            <h6>TOTAL EMPLOYEES</h6>
                                        </div>
                                        <div>
                                            <i class="icon-heart success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ eCommerce statistic -->

                <!-- Recent Transactions -->
                
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header card-head-inverse bg-blue">
                                    <h4 class="card-title text-white">Iqama Expiry Employee's</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    
                                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                    
                                    <!-- CSRF token --> 
                                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                        <table class="table table-hover fileexport">
                                            <thead>
                                                <tr>
                                                    <th>Emp. ID</th>
                                                    <th>Name</th>
                                                    <th>Iqama / ID</th>
                                                    <th>Department</th>
                                                    <th>Country</th>
                                                    <th>Iqama / ID Expiry</th>
                                                    <th>Days of Expiry</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach ($epry_chk_qry as $value) :
                                                    $from = strtotime(date("d-m-Y", strtotime($value['iqama_exp_g'])));
                                                    $today = time();
                                                    $difference = $from - $today;
                                                    $daystoexp = floor($difference / 86400);  // (60 * 60 * 24)
                                                ?>
                                                <tr>
                                                    <td><?= $value['emp_id'] ?></td>
                                                    <td><?= "<div class='media'><div class='media-left pr-1'><span class='avatar avatar-sm avatar-off rounded-circle'><img src='".$value['avatar']."'></span></div><div class='media-body media-middle'><a class='media-heading name'>".$value['name']."</a></div></div>" ?></td>
                                                    <td><?= $value['iqama'] ?></td>
                                                    <td><?= $value['dept'] ?></td>
                                                    <td><?= $value['country'] ?></td>
                                                    <td><?= $value['iqama_exp_g'] ?></td>
                                                    <td><?= $daystoexp ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Emp. ID</th>
                                                    <th>Name</th>
                                                    <th>Iqama / ID</th>
                                                    <th>Department</th>
                                                    <th>Country</th>
                                                    <th>Iqama / ID Expiry</th>
                                                    <th>Days of Expiry</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <!-- CSRF token --> 
                                    <!-- <input type="hidden" class="txt_csrfname" name="<?php //csrf_token() ?>" value="<?php //csrf_hash() ?>" />
                                        <table class="table table-hover fileexport">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Emp ID</th>
                                                    <th>Iqama</th>
                                                    <th>Mobile</th>
                                                    <th>Dept.</th>
                                                    <th width="50px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Emp ID</th>
                                                    <th>Iqama</th>
                                                    <th>Mobile</th>
                                                    <th>Dept.</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/charts/chart.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/charts/raphael-min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/charts/morris.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/data/jvector/visitor-data.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/buttons.flash.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/jszip.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/pdfmake.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/vfs_fonts.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/buttons.html5.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/buttons.print.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <!-- <script src="<?php //base_url('/') ?>/app-assets/js/scripts/tables/datatables/datatable-advanced.js"></script> -->
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
        

/* For Export Buttons available inside jquery-datatable "server side processing" - Start
- due to "server side processing" jquery datatble doesn't support all data to be exported
- below function makes the datatable to export all records when "server side processing" is on */
/*
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
        var columnsConfig = [ 0, 1, 2, 3, 4 ];

        var exportTitle = "All Locations"
        buttonConfig.push({extend:'excel',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-success', action: newexportaction});
        buttonConfig.push({extend:'pdf',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-danger', action: newexportaction});
        buttonConfig.push({extend:'print' ,exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-dark', action: newexportaction});
        buttonConfig.push({text: '<i class="fa fa-plus"></i> Add Customer', action: function ( e, dt, button, config ) {window.location = './add_customer.php' } ,className: 'btn-info'});
            
        
        $('#fileexport').DataTable({

            dom: "Bfrtip",
            lengthMenu: [[10, 100, -1], [10, 100, "All"]],
            buttons: buttonConfig,

            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
            'url':"<?php //site_url('/employee/getEmployeeIDExp')?>",
            'data': function(data){
               // CSRF Hash
               var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
               var csrfHash = $('.txt_csrfname').val(); // CSRF hash
               return {
                  data: data,
                  [csrfName]: csrfHash // CSRF Token
               };
            },
            dataSrc: function(data){

              // Update token hash
              $('.txt_csrfname').val(data.token);
              // Datatable data
              return data.aaData;
            }
         },
         'columns': [
            // { data: 'id' },
            { data: 'name' },
            { data: 'emp_id' },
            { data: 'mobile' },
            { data: 'iqama' },
            { data: 'dept' },
            { data: 'action' },
         ]
      }); */

});

/*
    $(document).ready(function(){
      $('.fileexport').DataTable({
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url':"<?php //site_url('/employee/getEmployee')?>",
            'data': function(data){
               // CSRF Hash
               var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
               var csrfHash = $('.txt_csrfname').val(); // CSRF hash

               return {
                  data: data,
                  [csrfName]: csrfHash // CSRF Token
               };
            },
            dataSrc: function(data){

              // Update token hash
              $('.txt_csrfname').val(data.token);

              // Datatable data
              return data.aaData;
            }
         },
         'columns': [
            // { data: 'id' },
            { data: 'name' },
            { data: 'emp_id' },
            { data: 'mobile' },
            { data: 'iqama' },
            { data: 'dept' },
         ]
      });
   });
*/
        // $(document).ready(function(){
        //     loadEmployee();
        // });

        // function loadEmployee() {
        //     $.ajax({
        //         method: "GET",
        //         url: "/dashboard/fetchemp",
        //         success: function (response) {
        //             // console.log(response.employees);
        //             $.each(response.employees, function(key,value) {
        //                 // console.log(value['name']);
        //                 $('.fileexport').append('<tr>\
        //                     <td>'+ value['name'] +'</td>\
        //                     <td>'+ value['emp_id'] +'</td>\
        //                     <td>'+ value['iqama'] +'</td>\
        //                     <td>'+ value['mobile'] +'</td>\
        //                     <td>'+ value['joining_date'] +'</td>\
        //                     <td>'+ value['salary'] +'</td>\
        //                     </tr>');
        //             });
        //         }
        //     });
        // }


    </script>

<?= $this->endSection(); ?>
<!-- End: Script-->