<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Employees List
<?= $this->endSection(); ?>
<?php
if (!$permission->authorize($permission->method('/employee/list','read')->access())) {
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
    <div class="users-list-filter px-1">
        <form>
            <div class="row border border-light rounded py-2 mb-2">
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-verified">Departments</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-verified">
                            <option value="">Any</option>
                            <?php foreach ($departments as $department) : ?>
                            <option value="<?=$department->dep_nme?>"><?=$department->dep_nme ?></option>
                            <?php endforeach; ?>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-role">Sponsorship</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-role">
                            <option value="">Any</option>
                            <option value="mocha">Mochachino</option>
                            <option value="man_power">Man-Power</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label for="users-list-status">Blood Group</label>
                    <fieldset class="form-group">
                        <select class="form-control" id="users-list-status">
                            <option value="">Any</option>
                            <option value="A+">A+</option>
                            <option value="B+">B+</option>
                            <option value="O+">O+</option>
                            <option value="AB+">AB+</option>
                            <option value="A-">A-</option>
                            <option value="B-">B-</option>
                            <option value="O-">O-</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                    <button class="btn btn-block btn-primary glow">Show</button>
                </div>
            </div>
        </form>
    </div>
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-header card-head-inverse bg-blue">
                    <h4 class="card-title text-white">Employee's List</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashData('success') != null) : ?>
                        <div class="alert bg-success alert-icon-left alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                            <strong>Well done!</strong> <?= session()->getFlashData('success') ?>
                        </div>
                    <?php endif ?>
                    <!-- datatable start -->
                    <div class="table-responsive">
                        <table id="users-list-datatable" class="table dataex-res-constructor">
                            <thead>
                                <tr>
                                    <th>Emp. ID</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Iqama / ID</th>
                                    <th>Mobile</th>
                                    <th>Date of Birth</th>
                                    <th>Sponsorship</th>
                                    <th>Blood G.</th>
                                    <th>Email ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employees as $employee) : ?>
                                <tr>
                                    <td><?=$employee['emp_id']?></td>
                                    <td>
                                        <?= "<div class='media'><div class='media-left pr-1'><span class='avatar avatar-lg avatar-off rounded-circle'><img src='".base_url($employee['avatar'])."'></span></div><div class='media-body media-middle'><a class='media-heading name'>".$employee['name']."</a></div></div>" ?>
                                    </td>
                                    <td><?=$employee['dept']?></td>
                                    <td><?=$employee['iqama']?></td>
                                    <td><?=$employee['mobile']?></td>
                                    <td><?=$employee['dob']?></td>
                                    <td><?=$employee['emp_sup_type']?></td>
                                    <td><?=$employee['blood_type']?></td>
                                    <td><?=$employee['email']?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <?php if ($permission->method('/employee/list','read')->access()) { ?>
                                            <a href="<?=base_url('employee/view')."/".$employee['id']?>" class="btn btn-dark"><i class='ft ft-eye'></i></a>
                                            <?php } if ($permission->method('/employee/list','update')->access()) { ?>
                                            <a href="<?=base_url('employee/edit')."/".$employee['id']?>" class="btn btn-info"><i class='ft ft-edit'></i></a>
                                            <?php } if ($permission->method('/employee/list','delete')->access()) { ?>
                                            <a href="javascript:void(0);" class="btn btn-danger delete" data-id="<?=$employee['id']?>">
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
                                    <th>Emp. ID</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Iqama / ID</th>
                                    <th>Mobile</th>
                                    <th>Date of Birth</th>
                                    <th>Sponsorship</th>
                                    <th>Blood G.</th>
                                    <th>Email ID</th>
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

        $(document).ready(function () {

        // variable declaration
        var usersTable;
        var usersDataArray = [];

        var buttonConfig = [];
        var columnsConfig = [ 0, 1, 2, 3, 4 ];
        var exportTitle = "All Employees";
        buttonConfig.push({extend:'excel',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-success'});
        buttonConfig.push({extend:'pdf',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-danger'});
        buttonConfig.push({extend:'print' ,exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-dark'});

          // datatable initialization
          if ($("#users-list-datatable").length > 0) {
            usersTable = $("#users-list-datatable").DataTable({
                dom: 'Bfrtip',
                
                //'pagingType': "full_numbers", //numbers|simple|simple_numbers|full|full_numbers|first_last_numbers

                buttons: buttonConfig,
                responsive: true,
                'columnDefs': [{
                "orderable": false,
                "targets": [7]
              }]
            });
          };
          // var tableConstructor = $('.dataex-res-constructor').DataTable();

          // on click selected users data from table(page named page-users-list)
          // to store into local storage to get rendered on second page named page-users-view
          $(document).on("click", "#users-list-datatable tr", function () {
            $(this).find("td").each(function () {
              usersDataArray.push($(this).text().trim())
            })
            localStorage.setItem("usersId", usersDataArray[0]);
            localStorage.setItem("usersUsername", usersDataArray[1]);
            localStorage.setItem("usersName", usersDataArray[2]);
            localStorage.setItem("usersVerified", usersDataArray[4]);
            localStorage.setItem("usersRole", usersDataArray[5]);
            localStorage.setItem("usersStatus", usersDataArray[6]);
          })
          // render stored local storage data on page named page-users-view
          if (localStorage.usersId !== undefined) {
            $(".users-view-id").html(localStorage.getItem("usersId"));
            $(".users-view-username").html(localStorage.getItem("usersUsername"));
            $(".users-view-name").html(localStorage.getItem("usersName"));
            $(".users-view-verified").html(localStorage.getItem("usersVerified"));
            $(".users-view-role").html(localStorage.getItem("usersRole"));
            $(".users-view-status").html(localStorage.getItem("usersStatus"));
            // update badge color on status change
            if ($(".users-view-status").text() === "Banned") {
              $(".users-view-status").toggleClass("badge-light-success badge-light-danger")
            }
            // update badge color on status change
            if ($(".users-view-status").text() === "Close") {
              $(".users-view-status").toggleClass("badge-light-success badge-light-warning")
            }
          }
          // page users list verified filter
          $("#users-list-verified").on("change", function () {
            var usersVerifiedSelect = $("#users-list-verified").val();
            usersTable.search(usersVerifiedSelect).draw();
          });
          // page users list role filter
          $("#users-list-role").on("change", function () {
            var usersRoleSelect = $("#users-list-role").val();
            // console.log(usersRoleSelect);
            usersTable.search(usersRoleSelect).draw();
          });
          // page users list status filter
          $("#users-list-status").on("change", function () {
            var usersStatusSelect = $("#users-list-status").val();
            // console.log(usersStatusSelect);
            usersTable.search(usersStatusSelect).draw();
          });
          // users language select
          if ($("#users-language-select2").length > 0) {
            $("#users-language-select2").select2({
              dropdownAutoWidth: true,
              width: '100%'
            });
          }
          // users music select
          if ($("#users-music-select2").length > 0) {
            $("#users-music-select2").select2({
              dropdownAutoWidth: true,
              width: '100%'
            });
          }
          // users movies select
          if ($("#users-movies-select2").length > 0) {
            $("#users-movies-select2").select2({
              dropdownAutoWidth: true,
              width: '100%'
            });
          }
          // users birthdate date
          if ($(".birthdate-picker").length > 0) {
            $('.birthdate-picker').pickadate({
              format: 'mmmm, d, yyyy'
            });
          }
          // Input, Select, Textarea validations except submit button validation initialization
          if ($(".users-edit").length > 0) {
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
          }
        });

    </script>


<?= $this->endSection(); ?>
<!-- End: Script-->