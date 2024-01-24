<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Machine View
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
// dd ($location);
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
                        <div class="col-12 col-md-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                            <a href="javascript:void(0);" class="btn btn-sm mr-25 btn-dark" data-toggle="modal" data-target="#modalAddItemReplase" data-keyboard="true" data-backdrop="static" >Add Replace Item</a>
                            <a href="javascript:void(0);" class="btn btn-sm mr-25 btn-primary" data-toggle="modal" data-target="#modalTransfer" data-keyboard="true" data-backdrop="static" >Transfer</a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-info editMachineAttr" data-toggle="modal" data-target="#editMachineModal" data-keyboard="true" data-backdrop="static"  data-id="<?=$machine['iid']?>" data-m_name_mach="<?=$machine['name_mach']?>" data-m_m_id="<?=$machine['m_id']?>" data-m_serial="<?=$machine['serial']?>" data-m_maker_name="<?=$machine['maker_name']?>" data-m_remarks="<?=$machine['remarks']?>" data-m_made_year="<?=$machine['made_year']?>" data-location_id="<?=$machine['location_id']?>" data-m_status="<?=$machine['mstatus']?>" >Edit</a>
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
                                    <div class="col-12 col-md-12">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Machine Name:</th>
                                                        <th>Model:</th>
                                                        <th>Location:</th>
                                                        <th>Serial:</th>
                                                        <th>Machine ID:</th>
                                                    </tr>
                                                </thead>
                                                <?php  ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?=$machine['name_mach'] ?></td>
                                                        <td><?=$machine['maker_name'] ?></td>
                                                        <td><?=$machine['mlocation'] ?></td>
                                                        <td><?=$machine['serial'] ?></td>
                                                        <td><?=$machine['m_id'] ?></td>
                                                        
                                                    </tr>
                                                </tbody>
                                                <?php  ?>
                                                <thead>
                                                    <tr>
                                                        <th colspan="4">Created at:</th>
                                                        <th>Status:</th>
                                                    </tr>
                                                </thead>
                                                <?php  ?>
                                                <tbody>
                                                    <tr>
                                                        <td  colspan="4"><?=$machine['created_at'] ?></td>
                                                        <td><?php  if ($machine['mstatus'] == '1') : ?>
                                                        <span class="badge badge-success users-view-status">Active</span>
                                                        <?php else: ?>
                                                        <span class="badge badge-danger users-view-status">Not Available</span>
                                                        <?php endif  ?>
                                                        	
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

                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-2 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex active" id="account-pill-Invoices" data-toggle="pill" href="#Invoices" aria-expanded="true">
                                        <i class="ft-user mr-50"></i>
                                        Invoices
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-transfer" data-toggle="pill" href="#transfer" aria-expanded="false">
                                        <i class="ft-lock mr-50"></i>
                                        Transfer Details
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
                                            <div role="tabpanel" class="tab-pane active" id="Invoices" aria-labelledby="account-pill-Invoices" aria-expanded="true">
                                                <div class="table-responsive">
                                            <table id="users-list-datatable" class="table fileexport" width="100%">
                                                <thead>
                                                    <tr>
														<th>Invoice No.</th>
														<th>Details</th>
														<th>Location</th>
											            <th>Date of Invoice</th>
														<th>Total + 15 %Vat</th>
														<th width="60">Action</th>
													</tr>
                                                </thead>
                                                <tbody>
                                                    <?php  foreach ($invoices as $invoice) : ?>
                                                    <tr>
                                                        <td><?=$invoice['inv_no'] ?></td>
                                                        <td><?=$invoice['item_name']?></td>
                                                        <td><?=$invoice['mlocation']?></td>
                                                        <td><?=$invoice['created_at']?></td>
                                                        <td><?=$invoice['subtotal']?></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="<?=base_url('/machine/invoice/view')."/".$invoice['inv_no']?>" class="btn btn-dark"><i class='ft ft-eye'></i></a>
                                                                <a href="javascript:void(0);" class="btn btn-danger invDelete" data-id="<?=$invoice['inv_no']?>"><i class='ft ft-trash-2 '></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach;  ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Invoice No.</th>
														<th>Details</th>
														<th>Location</th>
											            <th>Date of Invoice</th>
														<th>Total + 15 %Vat</th>
														<th width="60">Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            </div>
                                            </div>
                                           
                                                
                                       <div class="tab-pane fade" id="transfer" role="tabpanel" aria-labelledby="account-pill-transfer" aria-expanded="false">
                                            <table class="table table-hover fileexport" width="100%">
                                            <thead>
                                                <tr>
													<th>Machine ID.</th>
													<th>New Location</th>
													<th>Old Location</th>
													<th>Transfer Date</th>
													<th>Status</th>
												</tr>
                                            </thead>
                                            <tbody>
                                                <?php  foreach ($transfers as $transfer) : ?>
                                                <tr>
                                                    <td><?=$transfer['m_id'] ?></td>
                                                    <td><?=$transfer['mnlocation'] ?></td>
                                                    <td><?=$transfer['molocation'] ?></td>
                                                    <td><?=$transfer['created_at'] ?></td>
                                                    <td><?=($transfer['location'] == $machine['location_id']) ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Transfred</span>" ?></td>
                                                </tr>
                                                <?php endforeach;  ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
													<th>Machine ID.</th>
													<th>New Location</th>
													<th>Old Location</th>
													<th>Transfer Date</th>
													<th>Status</th>
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
                </section>
                
                <!-- users view ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
<div class="modal fade" id="modalTransfer" tabindex="-1" role="dialog" aria-labelledby="modalLabelDocu" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?=base_url('/machine/transfer/')?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelDocu">Transfer Machine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <h6>Old Location</h6>
                                <input class="form-control" type='text' value="<?=$machine['mlocation']?>" readonly />
                            </div>
                            <div class="form-group">
                                <h6>Select New Location<span class="required">*</span></h6>
                                <select class="form-control" name="location" required="" >
                                    <option value="">Select</option>
                                <?php  foreach ($location_list as $location): ?>
                                    <option value="<?=$location["id"] ?>"><?=str_replace(' ', '', $location["section_name"]) ?></option>
                                <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type='hidden' name='old_location' value="<?=$machine['location_id'] ?>" />
                    <input type='hidden' name='m_id' value="<?=$machine['m_id'] ?>" />
                    <input type='hidden' name='mid' value="<?=$machine['iid'] ?>" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Transfer</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalAddItemReplase" tabindex="-1" role="dialog" aria-labelledby="modalLabelAddItemReplase" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" >
        <form action="<?=base_url('/machine/add/inv/')?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelAddItemReplase">Add Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    	<div class="col-6 ">
                                <div class="mt-3 float-left">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Invoice Date:</div>
                                        </div>
                                        <input class="form-control" type='text' value="<?php echo date("d F Y")?>" readonly />
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col-6 ">
                                <div class="mt-3 float-right">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Invoice No.:</div>
                                        </div>
                                        <input class="form-control" type='text' name='inv_no' required="" />
                                    </div>                                   
                                </div>
                            </div><!-- end col -->
                    	<div class="col-12">
                        <table class="table " id="orders">
                            <thead>
                            <tr>
                                <th width="100">#</th>
                                <th>Description/Item Name/Invoice Num.</th>
                                <th width="100">Quantity</th>
                                <th width="150">Unit Cost</th>
                                <th width="150">Item Value</th>
                                <th width="100">Vat%</th>
                                <th width="150">Vat Val</th>
                                <th width="180">Amount</th>
                                <th width="150">Discount</th>
                                <th width="200" class="text-right">Total</th>
                                <th width="60" class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="set">
                                <td><input type="text" class="form-control rowid" readonly value="1" id="row"></td>
                                <td>
                                    <input type="text" name="item_name[]" placeholder="Enter item name" class="form-control" id="item_name" required autocomplete="off" >
                                </td>
                                <td>
                                    <input class="form-control quantity" type='text' id='quantity_1' name='quantity[]' for="1" required onkeypress="return isNumberKey(event,this)" />
                                </td>
                                <td>
                                    <input class="form-control product_price" type='text' data-type="product_price" id='product_price_1' name='product_price[]' for="1" required onkeypress="return isNumberKey(event,this)" />
                                </td>
                                <td>
                                    <input class="form-control itmvalue" type='text' data-type="itmvalue" id='itmvalue_1' name='itmvalue[]' for="1" readonly />
                                </td>
                                <td>
                                    <input class="form-control vat_rate" type='text' data-type="vat_rate" id='vat_rate_1' name='vat_rate[]' for="1" required value="15" onkeypress="return isNumberKey(event,this)" />
                                </td>
                                <td>
                                    <input class="form-control vat_val" type='text' data-type="vat_val" id='vat_val_1' name='vat_val[]' for="1" readonly />
                                </td>
                                <td>
                                    <input class="form-control amount" type='text' data-type="amount" id='amount_1' name='amount[]' for="1" readonly />
                                </td>
                                <td>
                                    <input class="form-control idiscount" type='text' data-type="idiscount" id='idiscount_1' name='idiscount[]' for="1" value="0" onkeypress="return isNumberKey(event,this)" />
                                </td>
                                <td class="text-right">
                                    <input class="form-control total_cost" type='text' id='total_cost_1' name='total_cost[]' for='1' readonly />
                                </td>
                                <td class="text-right">
                                    <a href="javascript:void(0);" class="btn btn-success btn-sm bbtn" id="add" title="Add field"><i class="mdi mdi-database-plus"></i></a>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    	</div>
                    </div>
                    <div class="row">
	                    <div class="col-6">
	                    </div>
	                    <div class="col-6" id="gtotal">
	                        <div class="float-right">
	<!--                                                 <p><b>Sub-total:</b> $4120.00</p>
	                            <p><b>VAT (12.5):</b> $515</p>
	                            <h3>$4635.00 USD</h3> -->
	                            <div class="input-group mb-2">
	                                <div class="input-group-prepend">
	                                    <div class="input-group-text">Net-Total <small>(without VAT)</small></div>
	                                </div>
	                                <input class="form-control subtotal" type='text' id='subtotal' name='subtotal' readonly/>
	                            </div>
	                            <div class="input-group mb-2">
	                                <div class="input-group-prepend">
	                                    <div class="input-group-text">VAT 15%</div>
	                                </div>
	                                <input class="form-control vat" type='text' id='vat' name='vat' readonly/>
	                            </div>
	                            <div class="input-group mb-2">
	                                <div class="input-group-prepend">
	                                    <div class="input-group-text">Total <small>(Before Disc.)</small></div>
	                                </div>
	                                <input class="form-control total" type='text' id='total' name='total' readonly/>
	                            </div>
	                            <div class="input-group mb-2">
	                                <div class="input-group-prepend">
	                                    <div class="input-group-text">Discount</div>
	                                </div>
	                                <input class="form-control discount" type='text' data-type="discount" id='discount' name='discount' value="0" onkeypress="return isNumberKey(event,this)" />
	                                <!-- <input class="form-control balance" type='text' id='balance' name='balance' readonly/> -->
	                            </div>
	                            <div class="input-group mb-2">
	                                <div class="input-group-prepend">
	                                    <div class="input-group-text">Grand Total</div>
	                                </div>
	                                <input class="form-control grandtotal" type='text' id='grandtotal' name='grandtotal' readonly/>
	                            </div>
	                            </div>
	                        <div class="clearfix"></div>
	                    </div>
	                </div>
                </div>
                <div class="modal-footer">                	
                    <input type="hidden" name="iid" value="<?=$machine['iid']?>" />
                    <input type="hidden" name="location_id" value="<?=$machine['location_id']?>" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Add Invoice</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editMachineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form action="<?=base_url('/machine/edit/')?>" method="post" enctype="multipart/form-data">
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
                                <label for="name_mach">Machine Name</label>
                                <input type="text" name="name_mach" id="m_name_mach" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="m_id">Machine ID</label>
                                <input type="text" name="m_id" id="m_m_id" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="serial">Serial No.</label>
                                <input type="text" name="serial" id="m_serial" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="made_year">Made Year</label>
                                <input type="text" name="made_year" id="m_made_year" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="remarks">Remarks</label>
                                <input type="text" name="remarks" id="m_remarks" class="form-control">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="maker_name" class="col-form-label">Select Model Name</label>
                                <select class="form-control" name="maker_name" id="maker_name" required="">
                                    <option value="">Select</option>
                                <?php  foreach ($brand_list as $brand): ?>
                                    <option value="<?=$brand["name"] ?>"><?=str_replace(' ', '', $brand["name"]) ?></option>
                                <?php endforeach;  ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="location_id" class="col-form-label">Select Category</label>
                                <select class="form-control" name="location" id="location_id" required="">
                                    <option value="">Select</option>
                                <?php  foreach ($location_list as $location): ?>
                                    <option value="<?=$location["id"] ?>"><?=str_replace(' ', '', $location["section_name"]) ?></option>
                                <?php endforeach;  ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <br><br>
                                <div class="d-inline-block custom-control custom-radio">
                                    <input type="radio" class="custom-control-input " name="status" id="radio5" value="1">
                                    <label class="custom-control-label" for="radio5">Active</label>
                                </div>
                                <div class="d-inline-block custom-control custom-radio">
                                    <input type="radio" class="custom-control-input " name="status" id="radio6" value="0">
                                    <label class="custom-control-label" for="radio6">Inactive</label>
                                </div>
                                    <!-- <input type="checkbox" name="status" /> -->
                            </div>

                        </div>
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="machineid" name="machineid">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit_item_edit" class="btn btn-info">Update Details</button>
                    </div>
                </form>
            </section>
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

    <script src="<?= base_url('/') ?>/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/extensions/polyfill.min.js"></script>

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
    

	<script type="text/javascript">
        /*only allow numeric input*/
        function isNumberKey(evt, obj) {

            var charCode = (evt.which) ? evt.which : event.keyCode
            var value = obj.value;
            var dotcontains = value.indexOf(".") != -1;
            if (dotcontains)
                if (charCode == 46) return false;
            if (charCode == 46) return true;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
        /*only allow numeric input*/
    </script>


    <script type="text/javascript">
        $('.editMachineAttr').click(function() {
            var m_status      = $(this).data('m_status');
            var location_id     = $(this).data('location_id');
            var maker_name     = $(this).data('m_maker_name');
            $('#machineid')      .val($(this).data('id')); 
            $('#m_name_mach')     .val($(this).data('m_name_mach'));
            $('#m_m_id')     .val($(this).data('m_m_id'));
            $('#m_serial')     .val($(this).data('m_serial'));
            $('#m_maker_name')     .val($(this).data('m_maker_name'));
            $('#m_remarks')     .val($(this).data('m_remarks'));
            $('#m_made_year')     .val($(this).data('m_made_year'));
            $('input[name="status"][value="'+m_status+'"]').prop('checked', true);
            $('#maker_name option[value="'+maker_name+'"]').prop("selected", "selected");
            $('#location_id option[value="'+location_id+'"]').prop("selected", "selected");
        });
    </script>
    
    <script type="text/javascript">
        // $(document).ready(function() {
        $(document).ready(function() {
            
        var rowCount = 1;

        document.addEventListener('keydown', (e) => {
            if (e.key.toLowerCase() === '+' && e.ctrlKey && e.shiftKey) {
                e.preventDefault();

                // Add your code here
            rowCount++;
            $('#orders').append('<tr id="row'+rowCount+'">'+
                '<td><input type="text" class="form-control rowid" value="'+rowCount+'" readonly></td>'+
                '<td><input type="text" name="item_name[]" placeholder="Enter item name" class="form-control" id="item_name" required autocomplete="off"></td>'+
                '<td><input class="form-control quantity" type="text" id="quantity_'+rowCount+'" name="quantity[]" for="'+rowCount+'" required onkeypress="return isNumberKey(event,this)" /></td>'+
                '<td><input class="form-control product_price" type="text" data-type="product_price" id="product_price_'+rowCount+'" name="product_price[]" for="'+rowCount+'" required onkeypress="return isNumberKey(event,this)" /></td>'+
                '<td><input class="form-control itmvalue" type="text" data-type="itmvalue" id="itmvalue_'+rowCount+'" name="itmvalue[]" for="'+rowCount+'" readonly /></td>'+
                '<td><input class="form-control vat_rate" type="text" data-type="vat_rate" id="vat_rate_'+rowCount+'" name="vat_rate[]" for="'+rowCount+'" required value="15" onkeypress="return isNumberKey(event,this)" /></td>'+
                '<td><input class="form-control vat_val" type="text" data-type="vat_val" id="vat_val_'+rowCount+'" name="vat_val[]" for="'+rowCount+'" readonly /></td>'+
                '<td><input class="form-control amount" type="text" data-type="amount" id="amount_'+rowCount+'" name="amount[]" for="'+rowCount+'" readonly /></td>'+
                '<td><input class="form-control idiscount" type="text" data-type="idiscount" id="idiscount_'+rowCount+'" name="idiscount[]" for="'+rowCount+'" required value="0" onkeypress="return isNumberKey(event,this)" /></td>'+
                '<td class="text-right"><input class="form-control total_cost" type="text" id="total_cost_'+rowCount+'" name="total_cost[]" for="'+rowCount+'" readonly /></td>'+
                '<td class="text-right"><a href="javascript:void(0);" class="btn_remove btn btn-danger btn-sm bbtn" id="'+rowCount+'" title="Remove field"><i class="mdi mdi-database-minus"></a></td></tr>'+
                '');
            } else if (e.key.toLowerCase() === 's' && e.ctrlKey && e.shiftKey) {
                // Add your code here
                
            }
        });
          
          $('#add').click(function() {
            rowCount++;
            $('#orders').append('<tr id="row'+rowCount+'">'+
                '<td><input type="text" class="form-control rowid" value="'+rowCount+'" readonly></td>'+
                '<td><input type="text" name="item_name[]" placeholder="Enter item name" class="form-control" id="item_name" required autocomplete="off"></td>'+
                '<td><input class="form-control quantity" type="text" id="quantity_'+rowCount+'" name="quantity[]" for="'+rowCount+'" required onkeypress="return isNumberKey(event,this)" /></td>'+
                '<td><input class="form-control product_price" type="text" data-type="product_price" id="product_price_'+rowCount+'" name="product_price[]" for="'+rowCount+'" required onkeypress="return isNumberKey(event,this)" /></td>'+
                '<td><input class="form-control itmvalue" type="text" data-type="itmvalue" id="itmvalue_'+rowCount+'" name="itmvalue[]" for="'+rowCount+'" readonly /></td>'+
                '<td><input class="form-control vat_rate" type="text" data-type="vat_rate" id="vat_rate_'+rowCount+'" name="vat_rate[]" for="'+rowCount+'" required value="15" onkeypress="return isNumberKey(event,this)" /></td>'+
                '<td><input class="form-control vat_val" type="text" data-type="vat_val" id="vat_val_'+rowCount+'" name="vat_val[]" for="'+rowCount+'" readonly /></td>'+
                '<td><input class="form-control amount" type="text" data-type="amount" id="amount_'+rowCount+'" name="amount[]" for="'+rowCount+'" readonly /></td>'+
                '<td><input class="form-control idiscount" type="text" data-type="idiscount" id="idiscount_'+rowCount+'" name="idiscount[]" for="'+rowCount+'" required value="0" onkeypress="return isNumberKey(event,this)" /></td>'+
                '<td class="text-right"><input class="form-control total_cost" type="text" id="total_cost_'+rowCount+'" name="total_cost[]" for="'+rowCount+'" readonly /></td>'+
                '<td class="text-right"><a href="javascript:void(0);" class="btn_remove btn btn-danger btn-sm bbtn" id="'+rowCount+'" title="Remove field"><i class="mdi mdi-database-minus"></a></td></tr>'+
                '');
        });

        // Add a generic event listener for any change on quantity or price classed inputs
        $("#orders").on('input', 'input.quantity,input.product_price,input.vat_rate,input.idiscount', function() {
          getTotalCost($(this).attr("for"));
        });

        $(document).on('click', '.btn_remove', function() {
          var button_id = $(this).attr('id');
          $('#row'+button_id+'').remove();
        });


        // Using a new index rather than your global variable i
        function getTotalCost(ind) {
            var qty = $('#quantity_'+ind).val();
            var price = $('#product_price_'+ind).val();
            var itmvalue = (qty * price);
            $('#itmvalue_'+ind).val( round(itmvalue,2) );
            var ivat = $('#vat_rate_'+ind).val();
            var idesc = $('#idiscount_'+ind).val();
            var totNumber = (qty * price);
            var vatValue = (totNumber * ivat / 100);
            // var tot = totNumber.toFixed(2);
            var sub_tot = (vatValue + totNumber)

            $('#vat_val_'+ind).val( round(vatValue,2) );
            $('#amount_'+ind).val( round(sub_tot,2) );
            $('#total_cost_'+ind).val( round(sub_tot - idesc,2) );

            calculateSubTotal();
        }

        $("#gtotal").on('input', 'input.discount', function() {
          calculateSubTotal($(this).attr("for"));
        });
        function calculateSubTotal() {
            var subtotal = 0;
            var totalvat = 0;



            var disc = $('#discount').val();
            $('.total_cost').each(function() {
                subtotal += parseFloat($(this).val());
            });
            $('.vat_val').each(function() {
                totalvat += parseFloat($(this).val());
            });

            $('#subtotal').val( round(subtotal - totalvat, 2) );
            $('#total').val( round(subtotal, 2) );
            $('#vat').val( round(totalvat,2) );
            $('#grandtotal').val( round(subtotal - disc, 2) );
            // $('#grandtotal').val( toWordsconver(subtotal - disc) );
        }

        function round(value, decimals) {
            return Number(Math.round(value +'e'+ decimals) +'e-'+ decimals).toFixed(decimals);
        }

});

    </script>

    <script type="text/javascript">

    	$(document).on('click', '.invDelete', function (e) {
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
                        url: '<?=base_url("machine/delete/invno/")?>/'+itemId,
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

    </script>

<?= $this->endSection(); ?>
<!-- End: Script-->