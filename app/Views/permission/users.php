<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Users List
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
            <?php 
                $errors = [];
                if(session()->getFlashData('errors') != null): 
                  $errors = session()->getFlashData('errors');
                endif;
            ?>
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
            <div class="content-detached content-right">
                <div class="content-body">
                    <div class="content-overlay"></div>
                    <section class="row all-contacts">
                        <div class="col-12">
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
                                        <!-- Task List table -->
                                        <div class="table-responsive">

                            <table id="users-list-datatable" class="table fileexport">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th width="50">Emp. ID</th>
                                    <th>Full Name</th>
                                    <th>Department</th>
                                    <th>User Role</th>
                                    <th>Permission Type</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                    <th width="80">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($userLists as $user) : ?>
                                <tr>
                                    <td><?=$user['id']?></td>
                                    <td widtd="50"><?=$user['emp_id']?></td>
                                    <td><?=$user['fullname']?></td>
                                    <td><?=$user['user_type']?></td>
                                    <td><?=$user['edept']?></td>
                                    <td><?=$user['type']?></td>
                                    <td><?=$user['email']?></td>
                                    <td><?=$user['mobile']?></td>
                                    <td><?=($user['status']==1) ? "<span class=\"badge badge-success float-right\">Active</span>" : "<span class=\"badge badge-danger float-right\">Inactive</span>" ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="javascript:void(0);" class="btn btn-info editUserAttr" data-toggle="modal" data-target="#editUserModal" data-id="<?=$user['id']?>" data-fullname="<?=$user['fullname']?>" data-dept="<?=$user['dept']?>" data-user_role="<?=$user['user_role']?>" data-email="<?=$user['email']?>" data-mobile="<?=$user['mobile']?>" data-status="<?=$user['status']?>" data-user_type="<?=$user['user_type']?>" data-backdrop="static" ><i class='ft ft-edit'></i></a>
                                            <a href="javascript:void(0);" class="btn btn-danger delete" data-id="<?=$user['id']?>">
                                                <i class='ft ft-trash-2'></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th width="50">Emp. ID</th>
                                    <th>Full Name</th>
                                    <th>Permission Type</th>
                                    <th>Department</th>
                                    <th>User Role</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
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
            <div class="sidebar-detached sidebar-left">
                <div class="sidebar">
                    <div class="bug-list-sidebar-content">
                        <!-- Predefined Views -->
                        <div class="card">
                            <!-- Groups-->
                            <div class="card-body">
                                <p class="lead">Roles List
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal">Add Role</a>
                                </p>
                                <ul class="list-group">
                                    <?php foreach ($roles as $role): ?> 
                                        <li class="list-group-item">
                                            <?=$role['type']?>
                                            <div class="btn-group float-right" role="group" aria-label="Basic example">
                                                <a href="<?=base_url('/permission/edit/'.$role['id'])?>" class="dark mr-1">
                                                    <i class='ft ft-settings'></i>
                                                </a>
                                                <a href="javascript:void(0);" class="info mr-1 editAttr" data-toggle="modal" data-target="#editModal" data-id="<?=$role['id']?>" data-name="<?=$role['type']?>">
                                                    <i class='ft ft-edit'></i>
                                                </a>
                                                <a href="<?=base_url('/permission/secrole/delete/'.$role['id'])?>" class="danger mr-1" onclick="return confirm('Are you sure you want to delete!')" >
                                                    <i class='ft ft-trash-2'></i>
                                                </a>
                                            </div>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>

                            <div class="card-body">
                                <p class="lead">Users Assign Group</p>
                                <ul class="list-group">
                                    <?php foreach ($userassignLists as $role): ?> 
                                        <li class="list-group-item">
                                            <?=$role['type']?>
                                            <span class="badge badge-info float-right"><?=$role['user_role']?></span>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            <!--/ Groups-->
                        </div>
                        <!--/ Predefined Views -->

                    </div>

                </div>
            </div>
        </div>
    </div>
<!-- END: Content-->

<!-- START: Model Content-->
<div class="modal fade" id="editUserPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form class="contact-input" method="POST" id="validatedForm" action="<?=base_url('/permission/user/edit/password')?>">
                    <?=csrf_field()?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Edit Password for User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Enter new password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Confirm password</label>
                            <input type="password" id="password_confirm" name="password_confirm" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" id="idpasusr" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Change Password</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

 <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form class="contact-input" method="POST" action="<?=base_url('/permission/secrole/useredit')?>">
                    <?=csrf_field()?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Edit Details for User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="name">Full Name</label>
                                <input type="text" id="fullname" name="fullname" class="form-control">
                            </div>
                            <!-- <div class="form-group col-md-4">
                                <label for="name">Username</label>
                                <input type="text" id="username" name="username" class="form-control">
                            </div> -->
                            <div class="form-group col-md-4">
                                <label for="name">Department</label>
                                <input type="text" id="dept" name="dept" class="form-control" readonly="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Type of Role</label>
                                <select class="custom-select" name="user_role" id="user_role" required="">
                                    <?php foreach ($roles as $key => $role): ?>
                                    <option value="<?=$role['id']?>"><?=$role['type']?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Type of Permission</label>
                                <select class="custom-select" name="user_type" id="user_type" required="">
                                    <option value="administrator">Administrator</option>
                                    <option value="dept_user">Department Manager</option>
                                    <option value="employee">Employee</option>
                                    <option value="gm">Grneran Manager</option>
                                    <option value="hr">Human Resource</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="name">Email</label>
                                <input type="text" id="email" name="email" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Mobile</label>
                                <input type="text" id="mobile" name="mobile" class="form-control">
                            </div>
                            <div class="form-group col-md-6"><br>
                                <a href="javascript:void:(0);" class="btn bt-sm btn-warning editPassAttr" data-dismiss="modal" data-toggle="modal" data-target="#editUserPasswordModal" data-backdrop="static" data-id="<?=$user['id']?>" >Update Password</a>
                            </div>
                            <div class="form-group col-md-6">
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
                        <input type="hidden" id="iduser" name="id">
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Update Details</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form class="contact-input" method="POST" action="<?=base_url('/permission/secrole/edit')?>">
                    <?=csrf_field()?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Role Name</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Security Role Name</label>
                                <input type="text" id="name" name="type" class="form-control">
                                <input type="hidden" id="id" name="id">
                            </div>
                        </div>
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Update Role</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form class="contact-input" method="POST" action="<?=base_url('/permission/secrole/add')?>">
                    <?=csrf_field()?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Security Role Name</label>
                                <input type="text" name="type" class="form-control">
                            </div>
                        </div>
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Add Role</button>
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

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js" type="text/javascript"></script> -->
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
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>

    <!-- END: Page JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // jQuery('.validatedForm').validate({
            $('#validatedForm').validate({
                errorElement: 'div',
                errorClass: 'danger',

                rules : {
                    password : {
                        required: true,
                        minlength: 5
                    },
                    password_confirm : {
                        required: true,
                        minlength : 5,
                        equalTo : '[name="password"]'
                    }
                },
                messages: {
                    password: {
                        required: "Please enter new password.",
                        minlength: "Password minlength is 5"
                    },
                    password_confirm : {
                        required : "Please enter confirm password",
                        equalTo : "Password does not match!",
                        minlength: "Password minlength is 5"
                    }
                }
            });
        });
    </script>
    <script type="text/javascript">
        $('.editAttr').click(function() {
            var id          = $(this).data('id');
            var name        = $(this).data('name');
            $('#id')        .val(id); 
            $('#name')      .val(name);
        } );

        $('.editUserAttr').click(function() {
            var user_role   = $(this).data('user_role');
            var status      = $(this).data('status');
            var user_type   = $(this).data('user_type');
            $('#iduser')    .val($(this).data('id')); 
            $('#idpasusr')  .val($(this).data('id')); 
            $('#fullname')  .val($(this).data('fullname'));
            $('#username')  .val($(this).data('username'));
            $('#dept')      .val($(this).data('dept'));
            $('#email')     .val($(this).data('email'));
            $('#mobile')    .val($(this).data('mobile'));
            $('input[name="status"][value="'+status+'"]').prop('checked', true);
            // $('#user_role option[value="'+user_role+'"]').attr("selected", "selected");
            $('#user_role option[value="'+user_role+'"]').prop("selected", "selected");
            $('#user_type option[value="'+user_type+'"]').prop("selected", "selected");
        });

    </script>
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
                        url: '<?=base_url("permission/user/delete/")?>/'+itemId,
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

    </script>


<?= $this->endSection(); ?>
<!-- End: Script-->