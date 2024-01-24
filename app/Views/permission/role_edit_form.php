<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Employee Contant List
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

<?= $this->endSection(); ?>
<?php

    $request    = \Config\Services::request();
    $uriId      = $request->uri->getSegment(3);

?>
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
                <h4 class="card-title text-white">Edit Permission Role</h4>
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
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">           
            <div class="panel-body">
             <form action="<?=base_url('/permission/update/'.$uriId)?>" method="post">
                <?= csrf_field() ?>

        <div  id="showtable"></div>
            <?php
            $m=0;
            foreach ($modules as $key=>$value) {
                $sub_modules = $sub_module->where('mid',$value['id'])->get()->getResultArray();
            ?>
            <table class="table table-bordered">
                    <h3 class=""><?=$value['name'] ?></h3>
                    <thead>
                    <tr>
                        <th style="text-align: center !important;">Sr. No</th>
                        <th style="text-align: center !important;">Sub-Menu Name</th>
                        <th style="text-align: center !important;">File Name</th>
                        <th style="text-align: center !important;">M. ID</th>
                        <th style="text-align: center !important;">Create(<label for="checkAllcreate<?=$m?>"><input type="checkbox" onclick="checkallcreate(<?=$m?>)" id="checkAllcreate<?=$m?>"  name="" > All)</label></th>
                        <th style="text-align: center !important;">Read(<label for="checkAllread<?=$m?>"><input type="checkbox" onclick="checkallread(<?=$m?>)" id="checkAllread<?=$m?>"  name="" > all)</label></th>
                        <th style="text-align: center !important;">Update(<label for="checkAlledit<?=$m?>"><input type="checkbox" onclick="checkalledit(<?=$m?>)" id="checkAlledit<?=$m?>"  name="" > all)</label></th>
                        <th style="text-align: center !important;">Delete(<label for="checkAlldelete<?=$m?>"><input type="checkbox" onclick="checkalldelete(<?=$m?>)" id="checkAlldelete<?=$m?>"  name="" > all)</label></th>
                    </tr>
                    </thead>
                    <?php $sl = 0 ?>
                    <?php if (!empty($sub_modules)) { ?>
                        <?php
                        foreach ($sub_modules as $key1 => $module_name){
                        $ck_data = $role_permission->where('module_id',$module_name['id'])->where('role_id',$uriId)->get()->getRowArray();
                            // ->where('role_id',$role['0']['id'])->get()->row();
                        ?>
                            <?php
                            $createID = 'id="create'.$m.''.$sl.'" class="create'.$m.'"';
                            $readID   = 'id="read'.$m.''.$sl.'" class="read'.$m.'"';
                            $updateID = 'id="update'.$m.''.$sl.'" class="edit'.$m.'"';
                            $deleteID = 'id="delete'.$m.''.$sl.'" class="delete'.$m.'"';
                            ?>
                            <tbody>
                            <tr>
                                <th><?=($sl+1) ?></td>
                                <th>
                                    <?=$module_name['name']?>
                                    <input type="hidden" name="fk_module_id[<?=$m?>][<?=$sl?>][]" value="<?=$module_name['id'] ?>" id="id_<?=$module_name['id'] ?>">
                                </th>
                                <th style="width: 250px !important;"><a href="./<?=$module_name['directory'] ?>" target="_blank" ><?=$module_name['directory'] ?></a>
                                </th>
                                <th style="width: 60px !important; text-align: center !important;"><?=$module_name['id'] ?></th>
                                <td>
                                    <div class="checkbox checkbox-success text-center">
                                        <input type="checkbox" class="create<?=$m?>" name="create[<?=$m?>][<?=$sl ?>][]" value="1" <?=((@$ck_data['r_create']==1)?"checked":null) ?> id="create[<?=$m?>]<?=$sl?>">
                                        <label for="create[<?=$m ?>]<?=$sl ?>"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox checkbox-success text-center">
                                        <input type="checkbox" name="read[<?=$m?>][<?=$sl ?>][]" class="read<?=$m?>" value="1" <?=((@$ck_data['r_read']==1)?"checked":null) ?> id="read[<?=$m?>]<?=$sl?>">
                                        <label for="read[<?=$m ?>]<?=$sl ?>"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox checkbox-success text-center">
                                        <input type="checkbox" name="update[<?=$m?>][<?=$sl ?>][]" class="edit<?=$m?>" value="1" <?=((@$ck_data['r_update']==1)?"checked":null) ?> id="update[<?=$m?>]<?=$sl?>">
                                        <label for="update[<?=$m ?>]<?=$sl ?>"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkbox checkbox-success text-center">
                                        <input type="checkbox" name="delete[<?=$m?>][<?=$sl ?>][]" class="delete<?=$m?>" value="1" <?=((@$ck_data['r_delete']==1)?"checked":null) ?> id="delete[<?=$m?>]<?=$sl?>">
                                        <label for="delete[<?=$m ?>]<?=$sl ?>"></label>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <?php $sl++ ?>
                        <?php } ?>
                    <?php } //endif ?>
                </table>
            <?php $m++; } ?>

            <div class="form-group text-right">
                <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                <button type="submit" class="btn btn-success w-md m-b-5">Save Edit</button>
            </div>
            </form>
            </div>
           
        </div>
    </div>
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

    <!-- END: Page JS-->
    <script type="text/javascript">
        "use strict";
        function checkallcreate(sl){
            $("#checkAllcreate"+sl).change(function(){
                var checked = $(this).is(':checked');
                if(checked){
                    $(".create"+sl).each(function(){
                        $(this).prop("checked",true);
                    });
                }else{
                    $(".create"+sl).each(function(){
                        $(this).prop("checked",false);
                    });
                }
            });
        }
        "use strict";
        function checkallread(sl){
            $("#checkAllread"+sl).change(function(){
                var checked = $(this).is(':checked');
                if(checked){
                    $(".read"+sl).each(function(){
                        $(this).prop("checked",true);
                    });
                }else{
                    $(".read"+sl).each(function(){
                        $(this).prop("checked",false);
                    });
                }
            });
        }
        "use strict";
        function checkalledit(sl){
            $("#checkAlledit"+sl).change(function(){
                var checked = $(this).is(':checked');
                if(checked){
                    $(".edit"+sl).each(function(){
                        $(this).prop("checked",true);
                    });
                }else{
                    $(".edit"+sl).each(function(){
                        $(this).prop("checked",false);
                    });
                }
            });
        }
        "use strict";
        function checkalldelete(sl){
            $("#checkAlldelete"+sl).change(function(){
                var checked = $(this).is(':checked');
                if(checked){
                    $(".delete"+sl).each(function(){
                        $(this).prop("checked",true);
                    });
                }else{
                    $(".delete"+sl).each(function(){
                        $(this).prop("checked",false);
                    });
                }
            });
        }

        "use strict";
        function userRole(id){
          var base_url = $("#base_url").val();
            $.ajax({
                url : base_url + "permission/select_to_rol/" + id,
                type: "GET",
                dataType: "json",
                success: function(data)
                {
                    $('#existrole').html(data);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $('#existrole').html("<p style='color:red'>No Role Assigned Yet</p>");
                }
            });
        }


    </script>

<?= $this->endSection(); ?>
<!-- End: Script-->