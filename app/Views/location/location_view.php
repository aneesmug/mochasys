<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Location View
<?= $this->endSection(); ?>
<?php
/*if (!$permission->authorize($permission->method('/employee/list','read')->access())) {
    session()->setFlashData('error', "You do not have permission to access. Please contact with administrator.");
    \Config\Services::response()->redirect(base_url('/dashboard'))->send();
}*/
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

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/plugins/pickers/daterange/daterange.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri_css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri_css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/croppie/croppie.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/plugins/images/cropper/cropper.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/charts/leaflet.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/pages/gallery.css">
    <!-- END: Vendor CSS-->
<?php

// dd ($location_list);

    $in_img     = (!$location['in']) ? "./app-assets/assets/location_pics/default_in.jpg" : $location['in'];
    $out_img    = (!$location['out']) ? "./app-assets/assets/location_pics/default_in.jpg" : $location['out'];
?>
<style>
/* Set the size of the div element that contains the map */
#map {
    height: 400px;  /* The height is 400 pixels */
    width: 100%;  /* The width is the width of the web page */
}
.input-group-addon{
    margin-top: 13px !important;
    border-bottom: 1px solid rgba(0, 0, 0, 0.3) !important;
    width: 59px !important;
    text-align: center !important;
}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-header row">
        </div>
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">

                <!-- users view start -->
                <section class="users-view">
                    <!-- users view media object start -->
                    <div class="row">
                        <div class="col-12 col-sm-7">
                            <div class="media mb-2">
                                <a class="mr-1" href="javascript:void(0);">
                                    <img src="<?=base_url($out_img)?>" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="100" width="100">
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                            <a href="javascript:void(0);" class="btn btn-sm mr-25 btn-dark" data-toggle="modal" data-target="#modalContract" data-keyboard="true" data-backdrop="static" >Add Contract</a>
                            <a href="javascript:void(0);" class="btn btn-sm mr-25 btn-primary" data-toggle="modal" data-target="#modalDocu" data-keyboard="true" data-backdrop="static" >Add Documents</a>
                            <a href="<?=base_url('location/edit')."/".$location['loc_id']?>" class="btn btn-sm mr-25 btn-info">Edit</a> 
                            <?php if ($location['status'] == 'A') : ?>
                            <a href="javascript:void(0);" class="btn btn-sm mr-25 btn-danger" data-toggle="modal" data-target="#modalCloseLoc" data-keyboard="true" data-backdrop="static" >Close Location</a>
                            <?php else: ?>
                                <a href="javascript:void(0);" class="btn btn-sm mr-25 btn-success statusLocat" data-action="A" data-id="<?=$location['loc_id']?>" data-message="Location active successfully !">Active Location</a>
                            <?php endif ?>
                        </div>
                    </div>
                    <!-- users view media object ends -->
                    <!-- users view card data start -->
                    
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
                                <div class="row">
                                    <div class="col-12 col-md-2 d-flex justify-content-center align-items-center">
                                        <img src="<?=base_url('Location/qrcode/'.$location['loc_id'])?>" />
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Location Name:</th>
                                                        <th>Owner Name:</th>
                                                        <th>District:</th>
                                                        <th>Municipality:</th>
                                                        <th>Sub-Municipality:</th>
                                                    </tr>
                                                </thead>
                                                <?php  ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $location['section_name'] ?></td>
                                                        <td><?= $location['location_owner'] ?></td>
                                                        <td><?= $location['location_dist'] ?></td>
                                                        <td><?= $location['municipality'] ?></td>
                                                        <td><?= $location['sub_municipality'] ?></td>
                                                        
                                                    </tr>
                                                </tbody>
                                                <?php  ?>
                                                <thead>
                                                    <tr>
                                                        <th>Camera (IN):</th>
                                                        <th>Camera (OUT):</th>
                                                        <th>Bulding Base:</th>
                                                        <th>Bulding Size:</th>
                                                        <th>Total Bulding Size:</th>
                                                    </tr>
                                                </thead>
                                                <?php  ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $location['camera_in'] ?></td>
                                                        <td><?= $location['camera_out'] ?></td>
                                                        <td><?= $location['bulding_base'] ?></td>
                                                        <td><?= $location['bulding_size'] ?></td>
                                                        <td><?= $location['t_bulding_size'] ?> (M)</td>
                                                    </tr>
                                                </tbody>
                                                <?php  ?>
                                                <thead>
                                                    <tr>
                                                        <th>License No:</th>
                                                        <th>License Exp.:</th>
                                                        <th>Latitude:</th>
                                                        <th>Longitude:</th>
                                                        <th>Total Machines:</th>
                                                    </tr>
                                                </thead>
                                                <?php  ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $location['b_license_no'] ?></td>
                                                        <td><?= $location['b_license_exp'] ?></td>
                                                        <td><?= $location['latitude'] ?></td>
                                                        <td><?= $location['longitude'] ?></td>
                                                        <td><?= $location['totalDvc'] ?></td>
                                                    </tr>
                                                </tbody>
                                                <?php  ?>
                                                <thead>
                                                    <tr>
                                                        <th colspan="4">Address:</th>
                                                        <th>Status:</th>
                                                    </tr>
                                                </thead>
                                                <?php  ?>
                                                <tbody>
                                                    <tr>
                                                        <td  colspan="4"><?= $location['location_name'] ?></td>
                                                        <td>
                                                            <?php if ($location['status'] == 'A') : ?>
                                                            <span class="badge badge-success users-view-status">Active</span>
                                                            <?php else: ?>
                                                            <span class="badge badge-danger users-view-status">Not Available</span>
                                                            <?php endif ?>
                                                        </td>

                                                    </tr>
                                                </tbody>
                                                <?php  ?>
                                                    
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- users view card data ends -->
                </section>
                <section class="maps-leaflet">
                    <!-- Layer Groups and Layers Control map start -->
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">Location Google map.</div>
                                    <div id="map" class="maps-leaflet-container"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="card grid-hover" style="height: 463px !important;">
                                <div class="card-body">
                                    <div class="card-title">Inside Location</div>
                                    <figure class="effect-zoe">
                                        <img src="<?=base_url($in_img)?>" alt="<?=$location['section_name']?>" />
                                        <figcaption>
                                            <p class="icon-links">
                                                <label class="btn btn-sm mr-25 btn-success cursor-pointer inImg" for="img-crop" ><?=($location['in']!=="./app-assets/assets/location_pics/default_in.jpg")?"Change Picture":"Add New Picture";?></label>
                                                <input type="file" name="image" class="image inImgLoc" hidden="" id="img-crop" accept="image/*" data-loc_id="<?=$location['loc_id']?>" />
                                            </p>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="card grid-hover" style="height: 463px !important;">
                                <div class="card-body">
                                    <div class="card-title">Outside Location</div>
                                    <figure class="effect-zoe">
                                        <img src="<?=base_url($out_img)?>" alt="<?=$location['section_name']?>" />
                                        <figcaption>
                                            <p class="icon-links">
                                                <label class="btn btn-sm mr-25 btn-success cursor-pointer outImg" for="img-crop" ><?=($location['out']!=="./app-assets/assets/location_pics/default_in.jpg")?"Change Picture":"Add New Picture";?></label>
                                                <input type="file" name="image" class="image outImgLoc" hidden="" id="img-crop" accept="image/*" data-loc_id="<?=$location['loc_id']?>" />
                                            </p>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- Layer Groups and Layers Control map end -->
                </section>

                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-2 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex active" id="account-pill-documents" data-toggle="pill" href="#documents" aria-expanded="true">
                                        <i class="ft-user mr-50"></i>
                                        Documents
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-contract_details" data-toggle="pill" href="#contract_details" aria-expanded="false">
                                        <i class="ft-lock mr-50"></i>
                                        Contract Details
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-machines" data-toggle="pill" href="#machines" aria-expanded="false">
                                        <i class="ft-camera mr-50"></i>
                                        Machines
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                        <!-- right content section -->
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="documents" aria-labelledby="account-pill-documents" aria-expanded="true">
                                                <div class="table-responsive">
                                            <table id="users-list-datatable" class="table fileexport" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>Documant of Type</th>
                                                        <th>File Type</th>
                                                        <th>Added Date</th>
                                                        <th width="80">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($loc_document as $value) : ?>
                                                    <tr>
                                                        <td><?=$value['id']?></td>
                                                        <td><?=$value['docu_typ'] ?></td>
                                                        <td><?=$value['docu_ext']?></td>
                                                        <td><?=$value['created_at']?></td>
                                                        <td>
                                                            <?php  ?>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="<?=base_url("/location/download/".$value['id'])?>" class="btn btn-dark"><i class='ft ft-download'></i></a>
                                                                <a href="<?=base_url("/location/delete_doc/".$value['id'])?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete!')"><i class='ft ft-trash-2'></i>
                                                                </a>
                                                            </div>
                                                            <?php  ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>Documant of Type</th>
                                                        <th>File Type</th>
                                                        <th>Added Date</th>
                                                        <th width="80">Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            </div>
                                            </div>
                                           
                                                
                                            <div class="tab-pane fade" id="contract_details" role="tabpanel" aria-labelledby="account-pill-contract_details" aria-expanded="false">
                                            <table class="table table-hover fileexport" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Owner Name</th>
                                                    <th>Number</th>
                                                    <th>Email</th>
                                                    <th>Contract No.</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Rent</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($loc_contract as $value) : ?>
                                                <tr>
                                                    <td><?= $value['owner_name'] ?></td>
                                                    <td><?= $value['owner_number'] ?></td>
                                                    <td><?= $value['owner_email'] ?></td>
                                                    <td><?= $value['contract_no'] ?></td>
                                                    <td><?= $value['start_cont_date'] ?></td>
                                                    <td><?= $value['end_cont_date'] ?></td>
                                                    <td><?= $value['rent'] ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="javascript:void(0);" class="btn btn-info contractEditAttr" data-toggle="modal" data-target="#modalContractEdit" data-id="<?=$value['id']?>" data-owner_name="<?=$value['owner_name']?>" data-owner_number="<?=$value['owner_number']?>" data-owner_email="<?=$value['owner_email']?>" data-contract_no="<?=$value['contract_no']?>" data-start_date="<?=$value['start_cont_date']?>" data-end_date="<?=$value['end_cont_date']?>" data-rent="<?=$value['rent']?>" data-service="<?=$value['service']?>" data-elect_prc="<?=$value['elect_prc']?>" data-water_prc="<?=$value['water_prc']?>" data-incuranse_prc="<?=$value['incuranse_prc']?>" data-others="<?=$value['others']?>" ><i class='ft ft ft-edit'></i></a>
                                                            <a href="<?=base_url("/location/delete_contrt/".$value['id'])?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete!')"><i class='ft ft-trash-2'></i>
                                                                </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Owner Name</th>
                                                    <th>Number</th>
                                                    <th>Email</th>
                                                    <th>Contract No.</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Rent</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                            </div>
                                            
                                            <div class="tab-pane fade " id="machines" role="tabpanel" aria-labelledby="account-pill-machines" aria-expanded="false">
                                            <div class="table-responsive">
                                            <table id="users-list-datatable" class="table fileexport" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>Machine Name</th>
                                                        <th>M. ID</th>
                                                        <th>Serial</th>
                                                        <th>Model</th>
                                                        <th>Issue Date</th>
                                                        <th>Remarks</th>
                                                        <th width="80">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($loc_machines as $value) : ?>
                                                    <tr>
                                                        <td><?=$value['id']?></td>
                                                        <td><?=$value['name_mach']?></td>
                                                        <td><?=$value['m_id']?></td>
                                                        <td><?=$value['serial']?></td>
                                                        <td><?=$value['maker_name']?></td>
                                                        <td><?=$value['created_at']?></td>
                                                        <td><?=$value['remarks']?></td>
                                                        <td>
                                                            <?php  ?>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="<?=base_url("/machine/view/".$value['id'])?>" class="btn btn-dark"><i class='ft ft-eye'></i>
                                                                </a>
                                                            </div>
                                                            <?php  ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>Machine Name</th>
                                                        <th>M. ID</th>
                                                        <th>Serial</th>
                                                        <th>Model</th>
                                                        <th>Issue Date</th>
                                                        <th>Remarks</th>
                                                        <th width="80">Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>


                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- users view ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
<div class="modal fade" id="modalCloseLoc" tabindex="-1" role="dialog" aria-labelledby="modalLabelDocu" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?//=base_url('/location/storeFile/'.$location['loc_id'])?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelDocu">Close Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if ($location['totalDvc'] > 0): ?>
                            <table id="loadTable">
                                <thead>
                                    <tr>
                                        <th width="50">#</th>
                                        <th>Item Name</th>
                                        <th>M. ID</th>
                                        <th width="100">Transfer to</th>
                                        <th width="80">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Item Name</th>
                                        <th>M. ID</th>
                                        <th>Transfer to</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                </table>
                            <?php else: ?>
                                <h3>No Machine's are available in this location.</h3>
                                <p>You can close location now.</p>
                            <?php endif ?>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <?php if ($location['totalDvc'] == 0): ?>
                        <a href="javascript:void(0);" class="btn btn-info statusLocat" data-id="<?=$location['loc_id']?>" data-action="C" data-dismiss="modal" data-message="Location closed successfully !">Close Location</a>
                    <?php endif ?>

                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalDocu" tabindex="-1" role="dialog" aria-labelledby="modalLabelDocu" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?=base_url('/location/storeFile/'.$location['loc_id'])?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelDocu">Add Dosuments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <!-- <h5>File Input Field <span class="required">*</span></h5> -->
                                <h6>Select Your file<span class="required">*</span></h6>
                                <div class="controls">
                                    <input type="file" name="file" class="form-control mb-1" required="" >
                                <div class="help-block"></div></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <h6>Select type of document<span class="required">*</span></h6>
                                <select class="custom-select" name="docu_typ" required="">
                                    <option value="">Select Type</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Baladiya Licence">Baladiya Licence</option>
                                    <option value="Voucher">Voucher</option>
                                    <option value="VAT Voucher">VAT Voucher</option>
                                    <option value="QR Code">QR Code</option>
                                    <option value="Bank Account Copy">Bank Account Copy</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Upload Documents</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalContract" tabindex="-1" role="dialog" aria-labelledby="modalLabelContract" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <form action="<?=base_url('/location/registerContract/'.$location['loc_id'])?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelContract">Register New Contract</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="owner_name" class="col-form-label">Location Owner Name<span class="text-danger">*</span></label>
                            <input type="text" name="owner_name" required placeholder="Enter owner name" class="form-control" id="owner_name" >
                        </div>
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="owner_number" class="col-form-label">Owner Number<span class="text-danger">*</span></label>
                            <input type="text" name="owner_number" placeholder="Enter Owner number" class="form-control" id="owner_number" parsley-trigger="change" data-mask="0599999999" required >
                        </div>
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="owner_email" class="col-form-label">Owner Email<span class="text-danger">*</span></label>
                            <input type="text" name="owner_email" placeholder="Enter owner email" class="form-control" id="owner_email" required autocomplete="off" >
                        </div>
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="contract_no" class="col-form-label">Contract No.<span class="text-danger">*</span></label>
                            <input type="text" name="contract_no" placeholder="Enter contract no" class="form-control" id="contract_no" required autocomplete="off">
                        </div>

                        <div id="sandbox-container" class="col-lg-8 col-md-12">
                            <div class="input-daterange input-group" style="margin-top: 0rem !important;">
                                <div class="form-group">
                                    <label for="start_date" class="col-form-label">Contract Starting<span class="text-danger">*</span></label>
                                    <input type="text" name="start_cont_date" placeholder="Starting Date" class="form-control" id="start_date"  autocomplete="off" required />
                                </div>
                                    <!-- <input type="text" class="form-control calculated"> -->
                                <span class="input-group-addon" id="days">To</span>
                                <div class="form-group">
                                    <label for="end_date" class="col-form-label">Ending<span class="text-danger">*</span></label>
                                    <input type="text" name="end_cont_date" placeholder="Ending Date" class="form-control" id="end_date"  autocomplete="off" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-12">
                            <label for="rent" class="col-form-label">Amount of Rent<span class="text-danger">*</span></label>
                            <input type="text" name="rent" placeholder="Enter Amount of Rent" class="form-control autonumber" id="rent" autocomplete="off" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="service" class="col-form-label">Amount of Services</label>
                            <input type="text" name="service" placeholder="Enter Amount of Services" class="form-control autonumber" id="service" autocomplete="off">
                        </div>                    
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="elect_prc" class="col-form-label">Amount of Electric City</label>
                            <input type="text" name="elect_prc" placeholder="Enter Amount of Electric City" class="form-control autonumber" id="elect_prc" autocomplete="off" >
                        </div>                      
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="water_prc" class="col-form-label">Amount of Water</label>
                            <input type="text" name="water_prc" placeholder="Enter Balady License No." class="form-control autonumber" id="water_prc" autocomplete="off">
                        </div>                      
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="incuranse_prc" class="col-form-label">Amount of Incuranse</label>
                            <input type="text" name="incuranse_prc" placeholder="Enter Amount of Incuranse" class="form-control autonumber" id="incuranse_prc" autocomplete="off">
                        </div>                      
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="others" class="col-form-label">Others</label>
                            <input type="text" name="others" placeholder="Enter others" class="form-control autonumber" id="others" autocomplete="off" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Add Contract</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalContractEdit" tabindex="-1" role="dialog" aria-labelledby="modalLabelContractEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <form action="<?//=base_url('/location/registerContract/'.$location['loc_id'])?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelContract">Edit Contract</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="owner_name" class="col-form-label">Location Owner Name<span class="text-danger">*</span></label>
                            <input type="text" name="owner_name" required placeholder="Enter owner name" class="form-control" id="e_owner_name" >
                        </div>
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="owner_number" class="col-form-label">Owner Number<span class="text-danger">*</span></label>
                            <input type="text" name="owner_number" placeholder="Enter Owner number" class="form-control" id="e_owner_number" parsley-trigger="change" data-mask="0599999999" required >
                        </div>
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="owner_email" class="col-form-label">Owner Email<span class="text-danger">*</span></label>
                            <input type="text" name="owner_email" placeholder="Enter owner email" class="form-control" id="e_owner_email" required autocomplete="off" >
                        </div>
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="contract_no" class="col-form-label">Contract No.<span class="text-danger">*</span></label>
                            <input type="text" name="contract_no" placeholder="Enter contract no" class="form-control" id="e_contract_no" required autocomplete="off">
                        </div>

                        <div id="e_sandbox-container" class="col-lg-8 col-md-12">
                            <div class="e_input-daterange input-group" style="margin-top: 0rem !important;">
                                <div class="form-group">
                                    <label for="start_date" class="col-form-label">Contract Starting<span class="text-danger">*</span></label>
                                    <input type="text" name="e_start_cont_date" placeholder="Starting Date" class="form-control" id="e_start_date"  autocomplete="off" required />
                                </div>
                                    <!-- <input type="text" class="form-control calculated"> -->
                                <span class="input-group-addon" id="e_days">To</span>
                                <div class="form-group">
                                    <label for="end_date" class="col-form-label">Ending<span class="text-danger">*</span></label>
                                    <input type="text" name="e_end_cont_date" placeholder="Ending Date" class="form-control" id="e_end_date"  autocomplete="off" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-12">
                            <label for="rent" class="col-form-label">Amount of Rent<span class="text-danger">*</span></label>
                            <input type="text" name="rent" placeholder="Enter Amount of Rent" class="form-control autonumber" id="e_rent" autocomplete="off" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="service" class="col-form-label">Amount of Services</label>
                            <input type="text" name="service" placeholder="Enter Amount of Services" class="form-control autonumber" id="e_service" autocomplete="off">
                        </div>                    
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="elect_prc" class="col-form-label">Amount of Electric City</label>
                            <input type="text" name="elect_prc" placeholder="Enter Amount of Electric City" class="form-control autonumber" id="e_elect_prc" autocomplete="off" >
                        </div>                      
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="water_prc" class="col-form-label">Amount of Water</label>
                            <input type="text" name="water_prc" placeholder="Enter Balady License No." class="form-control autonumber" id="e_water_prc" autocomplete="off">
                        </div>                      
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="incuranse_prc" class="col-form-label">Amount of Incuranse</label>
                            <input type="text" name="incuranse_prc" placeholder="Enter Amount of Incuranse" class="form-control autonumber" id="e_incuranse_prc" autocomplete="off">
                        </div>                      
                        <div class="form-group col-lg-4 col-md-12">
                            <label for="others" class="col-form-label">Others</label>
                            <input type="text" name="others" placeholder="Enter others" class="form-control autonumber" id="e_others" autocomplete="off" >
                        </div>
                    </div>
                    <input type="hidden" name="contid" id="e_contid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-info contractEdit">Edit Contract</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalAvatar" tabindex="-1" role="dialog" aria-labelledby="modalLabelAvatar" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelAvatar">Crop Picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- <div id="img_prev"></div> -->
                            <img id="image" style="max-width: 100% !important;">
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-info" id="crop">Upload Picture</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<!-- END: Content-->

<!-- Start: Script-->
<?= $this->section('script'); ?>

    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

    <!-- BEGIN: Vendor JS-->
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/material-vendors.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- BEGIN Vendor JS-->
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/bootstrap-timepicker.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri/bootstrap-hijri-datetimepicker.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri/bootstrap-hijri-datetimepicker.min.js"></script>
    
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/buttons.flash.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/jszip.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/pdfmake.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/vfs_fonts.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/buttons.html5.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/tables/buttons.print.min.js"></script>

    <script src="<?= base_url('/') ?>/app-assets/js/scripts/croppie/croppie.js" type="text/javascript"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/croppie/croppie.min.js" type="text/javascript"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/croppie/exif.js" type="text/javascript"></script>
    <!-- BEGIN: Page JS-->
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pages/material-app.js"></script>
    <!-- END: Page JS-->
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/extensions/cropper.js"></script>
    
    <script>
        /***************************/
    jQuery('.inImg').on('click', function(event) {
       $(".inImgLoc").attr('data-position', 'in');
       $(".outImgLoc").removeAttr('data-position');
    });

    jQuery('.outImg').on('click', function(event) {
       $(".outImgLoc").attr('data-position', 'out');
       $(".inImgLoc").removeAttr('data-position');
    });
        /***************************/
    

    function initMap() {
        var options = {
            zoom:16,
            center: { lat:<?=$location['latitude']?>, lng: <?=$location['longitude']?>} //Coordinates of New York 
        }
        var map = new google.maps.Map(document.getElementById('map'), options);
        var marker = new google.maps.Marker({
           position:{lat:<?=$location['latitude']?>, lng: <?=$location['longitude']?>}, // Brooklyn Coordinates
           map:map, //Map that we need to add
           icon:'<?=base_url('app-assets/images/map-maker/map-maker.png')?>',
           draggarble: false// If set to true you can drag the marker
        });
        var information = new google.maps.InfoWindow({
           content: '<h3><?=$location['section_name'];?></h3><h5><?=$location['location_name'];?></h5>'
        });
        marker.addListener('click', function() {
           information.open(map, marker);
        });
    }
    </script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAmpMDQXVtsHabQM2U1NqP1rhls03ZxMc&callback=initMap"></script>

    <script>
        var bs_modal = $('#modalAvatar');
        var image = document.getElementById('image');
        // var image = document.getElementsByClassName('loc_image');
        var cropper,reader,file;
        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                bs_modal.modal({
                            // Disable click background
                            backdrop: 'static',
                            keyboard: true, 
                            show: true
                        });
            };
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        bs_modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                preview: '.preview',
                dragMode: 'move',
                autoCropArea: 1,
                restore: false,
                cropBoxMovable: false,
                cropBoxResizable: false,
                zoomOnWheel: true,
                zoomable: true,
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });
        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 626,
                height: 626,
            });
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();

                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash
                    
                    var imgPosition = ($('.inImgLoc').data('position') == "in") ? "in" : "out";

                    var loc_id = $('#img-crop').data('loc_id');
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "<?=base_url('/location/uploadImg/'.$location['id'])?>",
                        data: {image: base64data, 'type': 'Profile Picture', 'imgPosition': imgPosition, 'loc_id': loc_id, [csrfName]: csrfHash},
                        success: function(data) { 
                            bs_modal.modal('hide');
                            alert(data.message);
                            location.reload(); //refresh page after uploading
                        }
                    });
                };
            });
        });
    </script>
    

    <script type="text/javascript">
    $(document).ready(function(){

        var buttonConfig = [];
        var columnsConfig = [ 0, 1, 2, 3, 4 ];
        var exportTitle = "All Expiry ID Employees";

        buttonConfig.push({extend:'excel',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-success'});
        buttonConfig.push({extend:'pdf',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-danger'});
        buttonConfig.push({extend:'print' ,exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-dark'});

        // $('.fileexport').DataTable( {
        // new $.fn.dataTable.Responsive(usersTable);
        $('.fileexport').DataTable( {
            dom: 'Bfrtip',
            responsive: true,
            buttons: buttonConfig
        } );
    });

    /***************************/

    /***************************/

    /**********************************************
    $(document).ready(function () {
        $image_crop = $('#img_prev').croppie({
            enableExif: true,
            viewport: {
                width: 220,
                height: 220,
                type: 'square' // circle
            },
            boundary: {
                width: 320,
                height: 320
            },
            type: 'canvas',
            size: 'viewport',
            enableOrientation: true,
            mouseWheelZoom: 'ctrl',
            showZoomer: true,
        });
        $('#upload_image').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                $image_crop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#modalAvatar').modal('show');
        });
        $('.crop_my_image').click(function (event) {
            // var base64data = reader.result;
            var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
            var csrfHash = $('.txt_csrfname').val(); // CSRF hash
            $image_crop.croppie('result', {
                }).then(function (response) {
                $.ajax({
                    // dataType: "json",
                    url: "<?//base_url('/employee/upload/'.$employee['id'])?>",
                    // data: {image: base64data, 'type': 'Profile Picture', [csrfName]: csrfHash},
                    data: {"image": response, [csrfName]: csrfHash},
                    success: function (data) {
                        if (data.success == true) {
                            $('#modalAvatar').modal('hide');
                            alert(data.message);
                            location.reload(); //refresh page after uploading
                            //$("#upload_emp_img_i").html(html);
                        } else {
                            $("body").append("<div class='upload-error'> File Error </div>");
                        }
                    }
                });
            });
        });
    });
    /**********************************************/
    jQuery(document).ready(function () {
        $('#sandbox-container .input-daterange').each(function() {
        $(this).datepicker({
            todayBtn:  1,
            format: "yyyy-mm-dd",
            // format: "m/d/yyyy",
            autoclose: true,
        });
    });
    
    $('#e_sandbox-container .e_input-daterange').each(function() {
        $(this).datepicker({
            todayBtn:  1,
            format: "yyyy-mm-dd",
            // format: "m/d/yyyy",
            autoclose: true,
        });
    });


    function getNumberOfDays(start, end) {
        const date1 = new Date(start);
        const date2 = new Date(end);
        // One day in milliseconds
        const oneDay = 1000 * 60 * 60 * 24;
        // Calculating the time difference between two dates
        const diffInTime = date2.getTime() - date1.getTime();
        // Calculating the no. of days between two dates
        const diffInDays = Math.round(diffInTime / oneDay);
        return diffInDays;
    }
    $('#end_date').change(function() {
        var d1 = $('#start_date').val();
        var d2 = $('#end_date').val();
        document.querySelector("#days").innerHTML = getNumberOfDays(d1, d2);
        console.log(getNumberOfDays(d1, d2));
    });
    $('#e_end_date').change(function() {
        var d1 = $('#e_start_date').val();
        var d2 = $('#e_end_date').val();
        document.querySelector("#e_days").innerHTML = getNumberOfDays(d1, d2);
        console.log(getNumberOfDays(d1, d2));
    });
        /*$('#date_select').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            startDate: '+0d',
        });
        $('#return_date_v').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            // startDate: '+0d',
        });
        $('#return_dated').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            // startDate: '+0d',
        });*/
    });
    /**********************************************/
// $('#start_date').val($(this).data('id'));
// var day_start = new Date("Jan 01 2016");
// var day_end = new Date("Dec 31 2016");
// var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
// document.getElementById("demo").innerHTML = Math.round(total_days);
    /******************************************/
    $(document).ready(function(){
        $('#loadTable').DataTable({
            dom: "Bfrtip",
            lengthMenu: [[8, 100, -1], [8, 100, "All"]],
            // responsive: true,
            processing: true,
            serverSide: true,
            serverMethod: 'get',
            ajax: {
            url:"<?=base_url('/location/loadmachines/'.$location['location_id'])?>",
            'data': function(data){
               return {
                  data: data,
               };
            },
            dataSrc: function(data){
              return data.aaData;
            }
         },
         'columns': [
            { data: 'id' },
            { data: 'name_mach' },
            { data: 'm_id' },
            { data: 'transferTo' },
            { data: 'action' },
         ]
      });
    });

    $(document).ready ( function () {
        $(document).on('click', ".transferMachine", function () {
           var mchid        = $(this).data('id');
           var m_id         = $(this).data('m_id');
           var location     = $('.transferTo'+mchid).val();
           var old_location = "<?=$location['loc_id']?>";
           var csrfName     = $('.txt_csrfname').attr('name'); // CSRF Token name
           var csrfHash     = $('.txt_csrfname').val(); // CSRF hash
           $.ajax({
                url: "<?=base_url("/location/transToLoc");?>",
                type: "POST",
                data:{
                    'type':           3,
                    'mid':            mchid,
                    'm_id':           m_id,
                    'location':       location,
                    'old_location':   old_location,
                    [csrfName]:       csrfHash
                },
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $('.txt_csrfname').val(dataResult.token);
                        alert('Machine transfered successfully !');
                        $('#loadTable').DataTable().ajax.reload();
                    }
                }
            });
        });

        $(document).on('click', ".statusLocat", function () {
           var locid            = $(this).data('id');
           var action           = $(this).data('action');
           var messageAction    = $(this).data('message');
           var csrfName         = $('.txt_csrfname').attr('name'); // CSRF Token name
           var csrfHash         = $('.txt_csrfname').val(); // CSRF hash
           $.ajax({
                url: "<?=base_url("/location/statusLocat");?>",
                type: "POST",
                data:{
                    'type':         "close",
                    'locid':        locid,
                    'action':       action,
                    [csrfName]:     csrfHash
                },
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $('.txt_csrfname').val(dataResult.token);
                        // $('#modalCloseLoc').modal().hide();
                        alert(messageAction);
                        location.reload(); //refresh page after uploading
                    }
                }
            });
        });

        $(document).on('click', ".contractEdit", function () {
           // var m_status      = $(this).data('m_status');
           var contid           = $('#e_contid').val();
           var location_id      = "<?=$location['loc_id']?>";
           var owner_name       = $('#e_owner_name').val();
           var owner_number     = $('#e_owner_number').val();
           var owner_email      = $('#e_owner_email').val();
           var contract_no      = $('#e_contract_no').val();
           var start_date       = $('#e_start_date').val();
           var end_date         = $('#e_end_date').val();
           var rent             = $('#e_rent').val();
           var service          = $('#e_service').val();
           var elect_prc        = $('#e_elect_prc').val();
           var water_prc        = $('#e_water_prc').val();
           var incuranse_prc    = $('#e_incuranse_prc').val();
           var others           = $('#e_others').val();
           var csrfName         = $('.txt_csrfname').attr('name'); // CSRF Token name
           var csrfHash         = $('.txt_csrfname').val(); // CSRF hash

           $.ajax({
                url: "<?=base_url("/location/contract/edit");?>",
                type: "POST",
                data:{
                    'type':             "Contractupdate",
                    'contid':           contid,
                    'location_id':      location_id,
                    'owner_name':       owner_name,
                    'owner_number':     owner_number,
                    'owner_email':      owner_email,
                    'contract_no':      contract_no,
                    'e_start_date':     start_date,
                    'e_end_date':       end_date,
                    'rent':             rent,
                    'service':          service,
                    'elect_prc':        elect_prc,
                    'water_prc':        water_prc,
                    'incuranse_prc':    incuranse_prc,
                    'others':           others,

                    [csrfName]:     csrfHash
                },
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $('.txt_csrfname').val(dataResult.token);
                        alert(dataResult.message);
                        location.reload(); //refresh page after uploading
                    }
                }
            });
        });
        
        $('.contractEditAttr').click(function() {
            // var id      = $(this).data('id');
            $('#e_contid')      .val($(this).data('id'));
            $('#e_owner_name')     .val($(this).data('owner_name'));
            $('#e_owner_number')     .val($(this).data('owner_number'));
            $('#e_owner_email')     .val($(this).data('owner_email'));
            $('#e_contract_no')     .val($(this).data('contract_no'));
            $('#e_start_date')     .val($(this).data('start_date'));
            $('#e_end_date')     .val($(this).data('end_date'));
            $('#e_rent')     .val($(this).data('rent'));
            $('#e_service')     .val($(this).data('service'));
            $('#e_elect_prc')     .val($(this).data('elect_prc'));
            $('#e_water_prc')     .val($(this).data('water_prc'));
            $('#e_incuranse_prc')     .val($(this).data('incuranse_prc'));
            $('#e_others')     .val($(this).data('others'));
                  /*$('input[name="status"][value="'+m_status+'"]').prop('checked', true);
                  $('#maker_name option[value="'+maker_name+'"]').prop("selected", "selected");
                  $('#location_id option[value="'+location_id+'"]').prop("selected", "selected");*/
        });

    });

    /******************************************/ 
    </script>

<?= $this->endSection(); ?>
<!-- End: Script-->