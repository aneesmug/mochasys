<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Items List
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
            <div class="content-detached content-right">
                <div class="content-body">
                    <div class="content-overlay"></div>
                    <section class="row all-contacts">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header card-head-inverse bg-blue">
                                    <h4 class="card-title text-white">Item's List</h4>
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
									<th>Image</th>
									<th>Item Name (English)</th>
									<th>Item Name (Arabic)</th>
									<th>Category</th>
									<th>Price Level</th>
									<th>Price (larg)</th>
									<th>Price (Small)</th>
									<th>Calories (Larg)</th>
									<th>Calories (Small)</th>
									<th>Status</th>
									<th width="60">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item) : ?>
                                <tr>
									<th><img src="<?=base_url("./app-assets/assets/qr_menu/".$item['image'])?>" class="rounded-circle bx-shadow-lg" width="50" height="50" /></th>
									<th><?=$item['ienname']?></th>
									<th><?=$item['iarname']?></th>
									<th><?=$item['cenname']?></th>
									<th><?=($item['price_level'] == "1") ? "Drive Thru" : "University" ;?></th>
									<th><?=$item['big_price']."<small> SAR</small>" ?></th>
									<th><?=$item['small_price']."<small> SAR</small>" ?></th>
									<th><?=$item['big_cal']."<small> cal</small>" ?></th>
									<th><?=$item['small_cal']."<small> cal</small>" ?></th>
									<td><?=($item['istatus'] == "1") ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Inactive</span>" ; ?>
									</td>
      
                                    <td>
                                    	<?php  ?>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="javascript:void(0);" class="btn btn-info editItemAttr" data-toggle="modal" data-target="#editItemModal" data-id="<?=$item['iid']?>" data-i_name_eng="<?=$item['ienname']?>" data-i_name_ar="<?=$item['iarname']?>" data-i_big_price="<?=$item['big_price']?>" data-i_small_price="<?=$item['small_price']?>" data-i_big_cal="<?=$item['big_cal']?>" data-i_small_cal="<?=$item['small_cal']?>" data-category_id="<?=$item['category_id']?>" data-price_level="<?=$item['price_level']?>" data-istatus="<?=$item['istatus']?>" data-iimage="<?=$item['image']?>"  ><i class='ft ft-edit'></i></a>
                                            <a href="javascript:void(0);" class="btn btn-danger deleteItem" data-id="<?=$item['iid']?>">
                                                <i class='ft ft-trash-2'></i>
                                            </a>
                                        </div>
                                    	<?php  ?>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
									<th>Image</th>
									<th>Item Name (English)</th>
									<th>Item Name (Arabic)</th>
									<th>Category</th>
									<th>Price Level</th>
									<th>Price (larg)</th>
									<th>Price (Small)</th>
									<th>Calories (Larg)</th>
									<th>Calories (Small)</th>
									<th>Status</th>
									<th width="60">Action</th>
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
                                <p class="lead">Category List
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModuleModal">Add Category</a>
                                </p>
                                <ul class="list-group">
                                    <?php foreach ($menu_category as $category): ?> 
                                        <li class="list-group-item">
                                            <?=$category['name_eng']?>
                                            <div class="btn-group float-right" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0);" class="info mr-1 editCategoryAttr" data-toggle="modal" data-target="#editModuleModal" data-id="<?=$category['id']?>" data-name_eng="<?=$category['name_eng']?>" data-name_ar="<?=$category['name_ar']?>" data-desc_eng="<?=$category['desc_eng']?>" data-desc_ar="<?=$category['desc_ar']?>" data-status="<?=$category['status']?>" >
                                                    <i class='ft ft-edit'></i>
                                                </a>
                                                <a href="javascript:void(0);" class="danger mr-1 deleteCate" data-id="<?=$category['id']?>">
                                                    <i class='ft ft-trash-2'></i>
                                                </a>
                                            </div>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            <!--/ Groups-->
                            <div class="card-body">
                                <p class="lead">Item Assign Group</p>
                                <ul class="list-group">
                                    <?php foreach ($itemAssignGroup as $itm): ?> 
                                        <li class="list-group-item">
                                            <?=$itm['name_eng']?>
                                            <span class="badge badge-info float-right"><?=$itm['category_id']?></span>
                                        </li>
                                    <?php endforeach  ?>
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
<div class="modal fade" id="addModuleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form action="<?=base_url('/item/category/register/')?>" method="post" enctype="multipart/form-data">
                	<?=csrf_field()?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Add Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name_eng">Name in English</label>
                                <input type="text" name="name_eng" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name_ar">Name in Arabic</label>
                                <input type="text" name="name_ar" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="desc_eng">Description in English</label>
                                <input type="text" name="desc_eng" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="desc_ar">Description in Arabic</label>
                                <input type="text" name="desc_ar" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <input type="hidden" id="idmud" name="id"> -->
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit_register" class="btn btn-info">Add Category</button>
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
                <form action="<?=base_url('/item/edit/category/')?>" method="post" enctype="multipart/form-data">
                    <?=csrf_field()?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Edit Category Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name_eng">Name in English</label>
                                <input type="text" name="name_eng" id="name_eng" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name_ar">Name in Arabic</label>
                                <input type="text" name="name_ar" id="name_ar" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="desc_eng">Description in English</label>
                                <input type="text" name="desc_eng" id="desc_eng" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="desc_ar">Description in Arabic</label>
                                <input type="text" name="desc_ar" id="desc_ar" class="form-control">
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
                                    <!-- <input type="checkbox" name="status" /> -->
                            </div>
                        </div>
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="smid" name="id">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit_edit" class="btn btn-info">Update Details</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>


<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form action="<?=base_url('/item/register/')?>" method="post" enctype="multipart/form-data">
                    <?=csrf_field()?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Add Item Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name_eng">Name in English</label>
                                <input type="text" name="name_eng" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name_ar">Name in Arabic</label>
                                <input type="text" name="name_ar" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="big_price">Larg Price</label>
                                <input type="text" name="big_price" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="small_price">Small Price</label>
                                <input type="text" name="small_price" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="big_cal">Larg Calories</label>
                                <input type="text" name="big_cal" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="small_cal">Small Calories</label>
                                <input type="text" name="small_cal" class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="price_level" class="col-form-label">Select Price Type</label>
                                <select class="form-control" name="price_level" required="">
                                    <option value="">Select</option>
                                    <option value="1">Drive Thru</option>
                                    <option value="2">University</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="category_id" class="col-form-label">Select Category</label>
                                <select class="form-control" name="category_id" required="">
                                    <option value="">Select</option>
                                <?php foreach ($menu_category as $category): ?>
                                    <option value="<?=$category["id"] ?>"><?=str_replace(' ', '', $category["name_eng"]) ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label class="col-form-label">Select Item Image</label>
                                <input type="file" name="iimage" accept="image/*" />
                            </div>

                        </div>
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit_item_register" class="btn btn-info">Register</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form action="<?=base_url('/item/edit/')?>" method="post" enctype="multipart/form-data">
                    <?=csrf_field()?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Edit Item Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name_eng">Name in English</label>
                                <input type="text" name="name_eng" id="i_name_eng" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name_ar">Name in Arabic</label>
                                <input type="text" name="name_ar" id="i_name_ar" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="big_price">Larg Price</label>
                                <input type="text" name="big_price" id="i_big_price" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="small_price">Small Price</label>
                                <input type="text" name="small_price" id="i_small_price" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="big_cal">Larg Calories</label>
                                <input type="text" name="big_cal" id="i_big_cal" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="small_cal">Small Calories</label>
                                <input type="text" name="small_cal" id="i_small_cal" class="form-control">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="price_level" class="col-form-label">Select Price Type</label>
                                <select class="form-control" name="price_level" id="price_level" required="">
                                    <option value="">Select</option>
                                    <option value="1">Drive Thru</option>
                                    <option value="2">University</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="category_id" class="col-form-label">Select Category</label>
                                <select class="form-control" name="category_id" id="category_id" required="">
                                    <option value="">Select</option>
                                <?php foreach ($menu_category as $category): ?>
                                    <option value="<?=$category["id"] ?>"><?=str_replace(' ', '', $category["name_eng"]) ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-form-label">Select Item Image</label>
                                <input type="file" name="file" accept="image/*" />
                                <input type="hidden" name="iimage" id="iimage" />
                            </div>

                            <div class="form-group col-md-6">
                                <br><br>
                                <div class="d-inline-block custom-control custom-radio mr-1">
                                    <input type="radio" class="custom-control-input " name="status" id="radio5" value="1">
                                    <label class="custom-control-label" for="radio5">Active</label>
                                </div>
                                <div class="d-inline-block custom-control custom-radio mr-1">
                                    <input type="radio" class="custom-control-input " name="status" id="radio6" value="0">
                                    <label class="custom-control-label" for="radio6">Inactive</label>
                                </div>
                                    <!-- <input type="checkbox" name="status" /> -->
                            </div>

                        </div>
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="itemid" name="itemid">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit_item_edit" class="btn btn-info">Update Details</button>
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

        $('.editCategoryAttr').click(function() {
            var status      = $(this).data('status');
            // var position     = $(this).data('position');
            $('#smid')      .val($(this).data('id')); 
            $('#name_eng')     .val($(this).data('name_eng'));
            $('#name_ar')     .val($(this).data('name_ar'));
            $('#desc_eng')     .val($(this).data('desc_eng'));
            $('#desc_ar')     .val($(this).data('desc_ar'));
            $('input[name="status"][value="'+status+'"]').prop('checked', true);
            // $('#position option[value="'+position+'"]').prop("selected", "selected");
        });

        $('.editItemAttr').click(function() {
            var istatus      = $(this).data('istatus');
            var price_level     = $(this).data('price_level');
            var category_id     = $(this).data('category_id');
            $('#itemid')      .val($(this).data('id')); 
            $('#i_name_eng')     .val($(this).data('i_name_eng'));
            $('#i_name_ar')     .val($(this).data('i_name_ar'));
            $('#i_big_price')     .val($(this).data('i_big_price'));
            $('#i_small_price')     .val($(this).data('i_small_price'));
            $('#i_big_cal')     .val($(this).data('i_big_cal'));
            $('#i_small_cal')     .val($(this).data('i_small_cal'));
            $('#iimage')     .val($(this).data('iimage'));
            $('input[name="status"][value="'+istatus+'"]').prop('checked', true);
            $('#price_level option[value="'+price_level+'"]').prop("selected", "selected");
            $('#category_id option[value="'+category_id+'"]').prop("selected", "selected");
            
        });
    

    </script>
    <script type="text/javascript">
        $(document).on('click', '.deleteCate', function (e) {
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
                        url: '<?=base_url("item/delete/category/")?>/'+itemId,
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

        $(document).on('click', '.deleteItem', function (e) {
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
                        url: '<?=base_url("item/delete/")?>/'+itemId,
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
            var exportTitle = "All Modules";

            buttonConfig.push({extend:'excel',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-success'});
            buttonConfig.push({extend:'pdf',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-danger'});
            buttonConfig.push({extend:'print' ,exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-dark'});
            /*buttonConfig.push({text: '<i class="fa fa-plus"></i> Add Category', action: function ( e, dt, button, config ) {$('#addModuleModal').modal('show') } ,className: 'btn-success'});*/
            buttonConfig.push({text: '<i class="fa fa-plus"></i> Add Item', action: function ( e, dt, button, config ) {$('#addItemModal').modal('show') } ,className: 'btn-info'});
        	/*buttonConfig.push({text: '<i class="fa fa-plus"></i> Add Item', action: function ( e, dt, button, config ) {window.location = './add_item.php' } ,className: 'btn-info'});*/

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