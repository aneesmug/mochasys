<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | New Smart Request
<?= $this->endSection(); ?>

<?= $this->section('pageCSS'); ?>
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/material-vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/menu/menu-types/material-vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/colors/material-palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/fonts/mobiriseicons/24px/mobirise/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/pages/invoice.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/ui/prism.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/pages/dropzone.css">
    <style type="text/css">.noneDIV { display:none !important; }, .showDIV { display:block !important; } </style>

    <!-- END: Vendor CSS-->
<style type="text/css">
@media print {
    /*body * {
        visibility: hidden;
    }*/
    #invoice-footer {
        display: none;
    }
    #invoice-template {
        visibility:visible !important;
        display:block !important;
        position:absolute !important;
        left:40px !important;
        right:40px !important;
    }
}

</style>
<?php
	$requestGet = \Config\Services::request();
	$total_cost = $invSum['subtotal'] - $invSum['tvat_val'];
	$total 		= $total_cost + $invSum['tvat_val'];
	$gtotal 	= $total - $invSum['tdiscount'];


	if ($status["smtstatus"] == "draft") {
        $status_get = "<span class='badge badge-secondary'>Not Submited</span>";
    } elseif ($status["smtstatus"] == "Manager") {
        $status_get = "<span class='badge badge-custom'>Waiting from ".$status["dept"]." Manager</span>";
    } elseif ($status["smtstatus"] == "Finance") {
        $status_get = "<span class='badge badge-warning'>Waiting from Finance</span>";
    } elseif ($status["smtstatus"] == "Management") {
        $status_get = "<span class='badge badge-primary'>Waiting from Managment</span>";
    } elseif ($status["smtstatus"] == "approve") {
        $status_get = "<span class='badge badge-success'>Approved from Managment</span>";
    } elseif ($status["smtstatus"] == "reject" AND $status["dept"] == "Management") {
        $status_get = "<span class='badge badge-danger'>Reject from Managment</span>";
    } elseif ($status["smtstatus"] == "reject" AND $status["dept"] == "Finance") {
        $status_get = "<span class='badge badge-danger'>Reject from Finance</span>";
    }
    
    $emptypeget = session()->get('user')['emp_data']['emptype'];
    $user_dept = session()->get('user')['emp_data']['dept'];
    $userfname = session()->get('user')['emp_data']['name'];

    // print_r($status);
    // exit();

$lstapp = 
<<<LISTAPP
<div class="input-group-prepend">
    <div class="input-group-text">Approved from *</div>
</div>
<select class="form-control" name="approv_by" required>
<option value="">Select</option>
    $selecttype
</select>
LISTAPP;


// print_r($selecttype);
// exit();

?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">New Smart Request</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=base_url("/dashboard")?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?=base_url("/smartrequest/list/")?>">Smart Request's</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
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

            <div class="row">
            	<div class="col-md-12" id="DataContact">
            	<section class="card">
            	
            	<div id="invoice-template" class="card-body">
                    <!-- Invoice Company Details -->
                    <div class="row">
                        <div class="col-sm-12 col-12 text-center">
                            <img src="<?=base_url("/")?>/app-assets/images/logo/LogoInWidth.png" width="240">
                        </div>
                    </div>

            	<form action="<?=base_url('/smart/request/view/')."/".$requestGet->uri->getSegment(4)?>" method="post" enctype="multipart/form-data">
            	<?=csrf_field()?>
                    <div id="invoice-company-details" class="row">
                        <div class="col-6 ">
	                        <div class="mt-3 float-left">
	                            <div class="input-group mb-2">
	                                <div class="input-group-prepend">
	                                    <div class="input-group-text">Invoice Date:</div>
	                                </div>
	                                <input class="form-control" type='text' value="<?=$invSum['created_at']?>" readonly />
	                            </div>
	                            <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Sub. Type</div>
                                    </div>
                                    <input class="form-control" type='text' name="sub_type" value="<?=$invSum['sub_type']?>" readonly/>
                                </div>
                                <div class="input-group mb-2">
                            <?php
                                if ($status["smtstatus"] == "draft" AND $emptypeget == "Supporter"){ echo $lstapp; }
                                elseif ($status["smtstatus"] == "draft" AND $user_dept == $status["dept"]){ echo $lstapp; }
                                elseif ($status["smtstatus"] == "Manager" AND $emptypeget == "Manager" AND $user_dept == $status["dept"]){echo $lstapp;}
                                elseif ($status["smtstatus"] == "Finance" AND $emptypeget == "Manager" AND $user_dept == "Finance"){
                                ?>  
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Approved from*</div>
                                    </div>
                                    <select class="form-control" name="status" id="statlist" required>
                                        <option value="">Select</option>
                                            <option value="Management">Approve</option>
                                            <option value="reject">Reject</option>
                                    </select>
                                    <input type="hidden" name="approv_by" value="<?=$userfname ?>" />
                                <?php 
                                 } elseif ($status["smtstatus"] == "Management" AND $emptypeget == "gm") { ?>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Forwarded to*</div>
                                    </div>
                                    <select class="form-control" name="status" id="statlist" required>
                                        <option value="">Select</option>
                                            <option value="approve">Approve</option>
                                            <option value="reject">Reject</option>
                                    </select>
                                    <input type="hidden" name="approv_by" value="<?=$userfname ?>" />
                                <?php  } else { ?>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Status</div>
                                    </div>
                                    <?=$status_get; ?>
                                <?php } ?>
                                    </div>
                                    <div class="input-group mb-2" id="RejectDIV" style="display: none;">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rejection Note*</div>
                                        </div>
                                        <input type='text' class="form-control" name="note" id="RejectInput" />
                                    </div>

                                    <div class="input-group mb-2" id="ApproveDIV" style="display: none;">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Approve from<span class="text-danger">*</span></div>
                                        </div>
                                        <select class="form-control" id="ApproveInput">
                                            <option value="">Select</option>
                                            <?=$selecttype ?>
                                        </select>
                                    </div>

                                    <?php 
                                        if ($status["smtstatus"] == "draft" OR $status["smtstatus"] == "Manager"):
                                            if($attach_count['id'] <= 5){ ?>
                                        
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                           		<div class="input-group-text">Attachment<span class="text-danger">*</span></div>
                                        	</div>
                                            <div class="radio radio-info form-check-inline">
                                                <input type="radio" id="inlineRadio3" value="yes" name="attach" onclick="showAttachment()" required>
                                                <b for="inlineRadio3"><i class="mdi mdi-paperclip"></i> Have Attachments</b>
                                            </div>
                                            <div class="radio radio-info form-check-inline">
                                                <input type="radio" id="inlineRadio2" value="no" name="attach" onclick="hideAttachment()" required>
                                                <b for="inlineRadio2"><i class="mdi mdi-clippy"></i> No Attachment</b>
                                            </div>

                                            <a href="javascript:void(0);" class="btn btn-sm btn-info waves-effect waves-light noneDIV checkattach" data-toggle="modal" data-target=".upload_documents" id="attachmentDIV" data-attach="ok">
                                            <i class="mdi mdi-cloud-upload "></i> Upload Documents</a>
                                            <input type="text" id="checkatt" class="noneDIV checkatt">
                                        </div>
                                        <?php }; endif; ?>

                                        <?php if ($status["smtnote"]): ?>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Reject Note<span class="text-danger">*</span></div>
                                            </div>
                                            <input class="form-control" type='text' value="<?=$status["smtnote"] ?>" readonly />
                                        </div>
                                        <?php endif ?>


	                        </div>
	                    </div><!-- end col -->
	                    <div class="col-6 ">
                        <div class="mt-3 float-right">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Invoice No.:</div>
                                </div>
                                <input class="form-control" type='text' name='inv_no' value="<?=$requestGet->uri->getSegment(4)?>" readonly />
                            </div>                                               
                            
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Tally ID.</div>
                                </div>
                                <input class="form-control" type='text' id='tally_id' name='tally_id' placeholder="Enter Tally ID." />
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Injazat ID.</div>
                                </div>
                                <input class="form-control" type='text' id='injazat_id' name='injazat_id' placeholder="Enter Injazat No." />
                            </div>
                           
                        </div>
                    </div><!-- end col -->
                    </div>

                    <!-- Invoice Items Details -->
                        <div id="invoice-items-details" class="pt-2">
                            <div class="row">
                                <div class="table-responsive col-12">
                                    <table class="table" id="orders">
                                        <thead>
                                            <tr>
                                            	<th width="100">#</th>
                                                <th>Description/Item Name/Invoice Num.</th>
                                                <th width="160">Location</th>
                                                <th width="80">Quantity</th>
                                                <th width="120">Unit Cost</th>
                                                <th width="130">Item Value</th>
                                                <th width="100">Vat%</th>
                                                <th width="100">Vat Val</th>
                                                <th width="130">Amount</th>
                                                <th width="100">Discount</th>
                                                <th width="150" class="text-right">Total</th>
                                                <th width="60" class="text-right"></th>
                                            </tr>
                                            </thead>
                                        <tbody>
                                        	<?php $x = 1; foreach ($invview as $val): ?>
                                        <tr class="set">
                                                        <td><input type="text" class="form-control" readonly value="<?php echo $x++ ?>" id="row"></td>
                                                        <td>
                                                            <input type="text" name="item_name[]" readonly class="form-control" value="<?=$val["item_name"]; ?>" />
                                                        </td>
                                                        <td>
                                                            <input type="text" name="location[]" readonly class="form-control" value="<?=$val["location"]; ?>" />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" readonly type='text' name='quantity[]' for="1" onkeypress="return isNumberKey(event,this)" value="<?=$val["quantity"]; ?>" />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type='text' data-type="product_price" name='product_price[]' for="1" readonly onkeypress="return isNumberKey(event,this)" value="<?=$val["product_price"]; ?>" />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type='text' data-type="itmvalue" name='itmvalue[]' for="1" readonly value="<?=$val["itmvalue"]; ?>" />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type='text' data-type="vat_rate" name='vat_rate[]' for="1" readonly onkeypress="return isNumberKey(event,this)" value="<?=$val["vat_rate"]; ?>" />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type='text' data-type="vat_val" name='vat_val[]' for="1" readonly value="<?=$val["vat_val"]; ?>" />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type='text' data-type="amount" name='amount[]' for="1" readonly value="<?=$val["amount"]; ?>" />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type='text' data-type="idiscount" name='idiscount[]' for="1" readonly onkeypress="return isNumberKey(event,this)" value="<?=$val["idiscount"]; ?>" />
                                                        </td>
                                                        <td class="text-right">
                                                            <input class="form-control" type='text' name='total_cost[]' for='1' readonly value="<?=$val["total_cost"]; ?>" />
                                                        </td>
                                                        <td></td>
                                                        <?php  if ($status["smtstatus"] <> "approve" && $status["smtstatus"] <> "reject" ):?>
                                                        <td class="text-right">
                                                            <div class="btn-group" role="group" aria-label="Edit Button">
                                                                <?php if ($status["smtstatus"] == "draft" OR $status["smtstatus"] == "Manager" OR ($status["smtstatus"] == "Management" AND $emptypeget == "gm") ): ?>
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-primary waves-effect editItemAttr bbtn" data-toggle="modal" data-target="#editItemModal" data-id="<?=$val['id']?>" data-i_item_name="<?=$val['item_name']?>" data-i_quantity="<?=$val['quantity']?>" data-i_product_price="<?=$val['product_price']?>" data-i_vat_rate="<?=$val['vat_rate']?>" data-i_idiscount="<?=$val['idiscount']?>" data-i_itmvalue="<?=$val['itmvalue']?>" data-i_vat_val="<?=$val['vat_val']?>" data-i_amount="<?=$val['amount']?>" data-i_total_cost="<?=$val['total_cost']?>" data-i_location="<?=$val['location']?>" >
                                                                    <i class="mdi mdi-table-edit"></i>
                                                                </a>
                                                                <?php endif  ?>
                                                                <a href="./includes/delete.php?tbl=smart_request&id=<?=$val["id"] ?>"  class="btn_remove btn btn-danger btn-sm bbtn" onclick="return confirm('Are you sure you want to delete this item?');">
                                                                    <i class="mdi mdi-database-minus"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <?php endif  ?>
                                                    </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-7 col-12 text-center text-sm-left">
                                	
                                	<div class="row">
                                	<?php foreach ($attachments as $attachment): ?>
                                	<div class="col-lg-2 col-xl-2">
	                                	<div class="file-man-box">            
	                                        <?php if ($user_dept == $status["dept"]): ?>
	                                        <a href="./includes/del_docu_att.php?id=<?=$attachment['id'] ?>&inv_no=<?php //echo $invnoget ?>" class="file-close" onclick="return confirm('Are you sure you want to delete this item?');"><i class="mdi mdi-close-circle"></i></a>
	                                        <?php endif ?>
	                                        <div class="file-img-box showAttach" style="cursor: pointer;" data-target="#ShowModal" data-id="<?=$attachment['id'] ?>" data-i_attachment="<?=$attachment['attachment'] ?>">
	                                            <?php if ($attachment['docu_ext'] == "pdf" OR $attachment['docu_ext'] == "xls" OR $attachment['docu_ext'] == "tif"): ?>
	                                                <img src="<?=base_url('/app-assets/images/file_icons/')?>/<?php if($attachment['docu_ext'] == "pdf"){echo"pdf";}elseif($attachment['docu_ext'] == "xls"){echo"excel";}elseif($attachment['docu_ext'] == "tif"){echo "tif";}?>.svg" />
	                                            <?php else: ?>
	                                                <img src="<?=base_url('/app-assets/assets/smt_attachment')?>/<?=$attachment['attachment'] ?>" />
	                                            <?php endif ?>
	                                        </div>

	                                       <!--  <a href="./downloadFile.php?file=./assets/assets/smt_attachment/<?php // echo $attachment_get ?>" class="file-download"><i class="mdi mdi-download"></i></a> -->
	                                        <div class="file-man-title">
	                                            <p class="mb-0"><small><?=$attachment['created_at']?></small></p>
	                                        </div>
	                                    </div>
                                    </div>
                                	<?php endforeach ?>
                                	</div>

                                </div>
                                <div class="col-sm-5 col-12 text-right">
                                    <div class="table-responsive">
                                        <table class="table" id="gtotal">
                                            <tbody>
                                                <tr>
                                                    <td>Net-Total <small>(without VAT)</small></td>
                                                    <td class="text-right"><?=number_to_currency($total_cost,'SAR', 'en_US', 2)?></td>
                                                </tr>
                                                <tr>
                                                    <td>VAT 15%</td>
                                                    <td class="text-right"><?=number_to_currency($invSum['tvat_val'],'SAR', 'en_US', 2)?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-800">Total <small>(Before Disc.)</small></td>
                                                    <td class="text-bold-800 text-right"><?=number_to_currency($total,'SAR', 'en_US', 2)?></td>
                                                </tr>
                                                <tr>
                                                    <td>Discount</td>
                                                    <td class="text-right">
                                                    	<input class="form-control discount" type='text' data-type="discount" id='discount' name='discount' onkeypress="return isNumberKey(event,this)" value="<?=$invSum['tdiscount']?>" <?=($status["smtstatus"] == "Manager" AND $emptypeget == "Manager" AND $user_dept == $status["dept"])? "" : "readonly";?> /></td>
                                                </tr>
                                                <tr class="bg-grey bg-lighten-4">
                                                    <td class="text-bold-800">Grand Total</td>
                                                    <td class="text-bold-800 text-right"><?=number_to_currency($gtotal,'SAR', 'en_US', 2)?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Invoice Footer -->
                    <div id="invoice-footer">
                        <div class="row">
                            <div class="col-sm-12 col-12 text-right">
                            	<!-- <button type="submit" name="submit_item_register" class="btn btn-info">Register</button> -->
                                <!-- <button type="button" class="btn btn-info btn-lg my-1" onclick="printDiv('invoice-template')">
                                    <i class="la la-paper-plane-o mr-50"></i>Print Report</button> -->

                            <?php if ($status["smtstatus"] == "draft" AND $user_dept == $status["dept"]): ?>
                                <a href="add_line_request.php?id=<?=$status["inv_no"]?>" class="btn btn-success bbtn" title="Add field">Add Line <i class="mdi mdi-database-plus"></i></a>
                                <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                            <?php elseif($status["smtstatus"] == "Manager" AND $emptypeget == "Manager" AND $user_dept == $status["dept"]): ?>
                                <a href="add_line_request.php?id=<?=$status["inv_no"]?>" class="btn btn-success bbtn" title="Add field">Add Line <i class="mdi mdi-database-plus"></i></a>
                                <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                            <?php elseif($status["smtstatus"] == "Finance" AND $emptypeget == "Manager" AND $user_dept == "Finance"): ?>
                                <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                            <?php elseif($status["smtstatus"] == "Management" AND $emptypeget == "gm"): ?>
                                <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                            <?php else: ?>
                                <a href="./all_requests.php" class="btn btn-dark waves-effect waves-light">
                                    <i class="fa fa-angle-double-left"></i> Back</a>
                                <a href="smt_print.php?id=<?php// echo $invnoget ?>" class="btn btn-primary waves-effect waves-light" target="_blank"><i class="fa fa-print m-r-5"></i> Print</a>
                            <?php endif; ?>

                            	<?php if ($user_dept <> "Finance" AND $emptypeget <> 'gm' AND $emptypeget == "Manager"):?>
                                    <input type='text' name="status" value="Finance" readonly/>
                                <?php elseif ($emptypeget == 'employee' AND $emptypeget == "Supporter"):?>
                                    <input type='text' name="status" value="Manager" readonly />
                                <?php endif ?>

                            </div>
                        </div>
                    </div>
                    <!-- Invoice Footer -->
            	</form>
			</div>
        </section>	
    </div>

            	<div class="col-md-4 preview" id="ShowModal" style="display: none;">
            		<section class="card" style="height: 97% !important;">
	            		<div class="card-body">
		                    <div class="card-box project-box">
		                        <div class="dropdown float-right">
		                            <a href="javascript:void(0);" class="" id="closeTab">
		                                <h3 class="m-0 text-muted"><i class="mdi mdi-close"></i></h3>
		                            </a>
		                        </div>
		                        <hr>
		                        <div class="previewImg"></div>
		                    </div>
		                </div>
            		</section>
            	</div>

            </div>
        </div>
    </div>
</div>


<!-- START Modal Handling -->
    <!-- END: Content-->
<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <section class="contact-form">
                <form action="<?php //echo $_SERVER['SELF_PHP']; ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Edit Item Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="orders">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="item_name">Item Name</label>
                                <input type="text" name="item_name" class="form-control item_name"  >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="i_location">Location</label>
                                <select class="form-control i_location" name="location">
                                    <option value="">Select</option>
                                <?php
                                    /* $query_sectin_nme = mysqli_query($conDB, "SELECT DISTINCT `section_name` FROM `section` ORDER BY `section_name` REGEXP '^[^A-Za-z]' ASC, section_name");
                                    while($rec = mysqli_fetch_assoc($query_sectin_nme)){
                                        $sectin_nme = $rec["section_name"];
                                ?>
                                    <option value="<?php echo $sectin_nme ?>"><?php echo str_replace(' ', '', $sectin_nme) ?></option>
                                <?php } */ ?>
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="quantity">Quantity</label>
                                <input type="text" name="quantity" class="form-control quantity" id='quantity'>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="product_price">Unit Cost</label>
                                <input type="text" name="product_price" class="form-control product_price" id='product_price'>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="vat_rate">Item Value</label>
                                <input type='text' id='itmvalue' class="form-control itmvalue" name='itmvalue' readonly />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="vat_rate">Vat Rate %</label>
                                <input type="text" name="vat_rate" class="form-control vat_rate" id="vat_rate">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="vat_rate">Vat Val. %</label>
                                <input type='text' class="form-control vat_val i_vat_val" id='vat_val' name='vat_val' readonly />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="vat_rate">Amount</label>
                                <input type='text' class="form-control amount i_amount" id='amount' name='amount' readonly />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="idiscount">Discount</label>
                                <input type="text" name="idiscount" class="form-control idiscount" id='idiscount' >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="vat_rate">Total</label>
                                <input type='text' class="form-control total_cost i_total_cost" id='total_cost' name='total_cost' readonly />
                            </div>

                        </div>
                        <span id="fav" class="d-none"></span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="itemid" name="itemid">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit_edit" class="btn btn-info">Update Details</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<div class="modal fade upload_documents" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
<!--    <div class="modal-dialog modal-lg" style="max-width: 1450px !important">-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2D7BF4 !important; color: #fff !important;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">
                    <i class="mdi mdi-image-filter-tilt-shift "></i> 
                    Upload Documents for <?php //echo $section_name ?>
                </h4>
            </div>
            <div class="modal-body">
<!---->
                
        <div class="row">

            <div class="col-12">
            <div class="card-box">
                <h4 class="header-title m-t-0">Dropzone File Upload</h4>
                <p class="text-muted font-14 m-b-10">
                    Your awesome text goes here.
                </p>
                <form action="#" class="dropzone" id="dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>

                </form>
            </div>
            </div>
            
        </div>
                
<!---->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light" id="startUpload"><i class="mdi mdi-backup-restore"></i> Upload</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?= $this->endSection(); ?>
<!-- END: Content-->

<!-- Start: Script-->
<?= $this->section('script'); ?>
	
	<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <!-- BEGIN: Vendor JS-->
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/material-vendors.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pages/material-app.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pages/invoice-template.js"></script>

    <script src="<?= base_url('/') ?>/app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/ui/prism.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/extensions/dropzone.js"></script>


    <script type="text/javascript">
        function printDiv(divName){
            var printContents = document.getElementById(divName).innerHTML;
            document.getElementById("invoice-template").innerHTML = printContents;
            window.print();
        }
    </script>

    <script>

/***************************/
	 jQuery('.showAttach').on('click', function(event) { 
		var id = $(this).data('id');  
		var img = $(this).data('i_attachment');
		$(".previewImg").empty().append("<iframe src="+"<?=base_url("./app-assets/assets/smt_attachment/")?>/"+img+" frameborder='0' scrolling='no' id='iFramePreview'></iframe");
		jQuery('.preview').show('slow');
			$("#DataContact").addClass('col-md-8');
			$("#DataContact").removeClass('col-md-12');
		});
		jQuery('#closeTab').on('click', function(event) { 
			jQuery('.preview').hide('slow');
				$("#DataContact").removeClass('col-md-8');
				$("#DataContact").addClass('col-md-12');
	});


        function showAttachment(){
            $("#attachmentDIV").removeClass("noneDIV");
            $("#checkatt").prop('required',true);
        }
        function hideAttachment(){
            $("#attachmentDIV").addClass("noneDIV");
            $("#checkatt").prop('required',null);
        }

        $('.checkattach').click(function() {
            $('#checkatt').val($(this).data('attach'));
        });


         $(document).ready(function(){
            $("#statlist").change(function(){
                $( "#statlist option:selected").each(function(){
                    if($(this).attr("value")=="reject"){
                        $("#RejectDIV").show();
                        $("#ApproveDIV").hide();
                        $("#RejectInput").prop('required',true);
                        $("#ApproveInput").prop('required',null);
                        $("input#RejectInput:text").attr('name','note');
                        $("select#ApproveInput").removeAttr('name');
                    }

                    if($(this).attr("value")=="approve"){
                        $("#ApproveDIV").hide();
                        $("#RejectDIV").hide();
                        $("#ApproveInput").prop('required',null);
                        $("#RejectInput").prop('required',null);
                        $("input#RejectInput:text").removeAttr('name');
                        $("select#ApproveInput").removeAttr('name');   
                    }

                    if($(this).attr("value")=="Management"){
                        $("#ApproveDIV").show();
                        $("#RejectDIV").hide();
                        $("#ApproveInput").prop('required',true);
                        $("#RejectInput").prop('required',null);
                        $("input#RejectInput:text").removeAttr('name');
                        $("select#ApproveInput").attr('name','approv_by');   
                    }

                    if ($(this).attr("value") == ""){
                        $("#RejectDIV").hide();
                        $("#ApproveDIV").hide();
                        $("#RejectInput").prop('required',null);
                        $("#ApproveInput").prop('required',null);
                        $("input#RejectInput:text").removeAttr('name');
                        $("select#ApproveInput").removeAttr('name');
                    }
                });
            }).change();
        });


        </script>


        <script type="text/javascript">
	        Dropzone.autoDiscover = false;
	        $(function() {
	            var myDropzone = new Dropzone(".dropzone", {
	                url: "<?=base_url('/smartrequest/attach/upload')?>",
	                paramName: "file",
	                maxFilesize: 5,
	                maxFiles: 10,
	                acceptedFiles: "image/png,image/jpeg,image/jpg,image/bmp,application/pdf",
	                parallelUploads: 10,
	                autoProcessQueue: false,
	                init: function() {
	                    this.on("success", function(file, response){
	                    	var responsetext = JSON.parse(file.xhr.response);
	                    	$('.txt_csrfname').val(response.token);
                                // alert(response.success);
	                        if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                                if(response.success == 1){ // Error
									alert(response.message);
								} if(response.success == 2){
									alert(response.message);
								} if(response.success == 3){
									alert(response.message);
								}
                                // reload after 5 sec
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
	                        }
	                    });
	                }
	            });
	            myDropzone.on("sending", function(file, xhr, formData) {
			      // CSRF Hash
			      var csrfName 	= $('.txt_csrfname').attr('name'); // CSRF Token name
			      var csrfHash 	= $('.txt_csrfname').val(); // CSRF hash
			      formData.append(csrfName, csrfHash);
			      formData.append('invno', '<?=$invSum['inv_no']?>');
			   }); 
	            $('#startUpload').click(function(){           
	                myDropzone.processQueue();
	            });
	        });
        </script>
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
        // $(document).ready(function() {
        $(document).ready(function() {
            /*var rowCount = 1;
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
*/
        // Add a generic event listener for any change on quantity or price classed inputs
        $("#orders").on('input', 'input.quantity,input.product_price,input.vat_rate,input.idiscount', function() {
          getTotalCost($(this).attr("for"));
        });
        // Using a new index rather than your global variable i
        function getTotalCost(ind) {
            var qty = $('#quantity').val();
            var price = $('#product_price').val();
            var itmvalue = (qty * price);
            $('#itmvalue').val( round(itmvalue,2) );
            var ivat = $('#vat_rate').val();
            var idesc = $('#idiscount').val();
            var totNumber = (qty * price);
            var vatValue = (totNumber * ivat / 100);
            // var tot = totNumber.toFixed(2);
            var sub_tot = (vatValue + totNumber)

            $('#vat_val').val( round(vatValue,2) );
            $('#amount').val( round(sub_tot,2) );
            $('#total_cost').val( round(sub_tot - idesc,2) );

            // calculateSubTotal();
        }


        /*$("#gtotal").on('input', 'input.discount', function() {
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
        }*/

        function round(value, decimals) {
            return Number(Math.round(value +'e'+ decimals) +'e-'+ decimals).toFixed(decimals);
        }

});

        $('.editItemAttr').click(function() {
            $('#itemid')      .val($(this).data('id'));
            $('.item_name')     .val($(this).data('i_item_name'));
            $('.quantity')     .val($(this).data('i_quantity'));
            $('.product_price')     .val($(this).data('i_product_price'));
            $('.vat_rate')     .val($(this).data('i_vat_rate'));
            $('.itmvalue')     .val($(this).data('i_itmvalue'));
            $('.i_vat_val')     .val($(this).data('i_vat_val'));
            $('.i_amount')     .val($(this).data('i_amount'));
            $('.idiscount')     .val($(this).data('i_idiscount'));
            $('.i_total_cost')     .val($(this).data('i_total_cost'));
            var ilocation       = $(this).data('i_location');
            $('.i_location option[value="'+ilocation+'"]').prop("selected", "selected");
        });

    </script>


<?= $this->endSection(); ?>
<!-- End: Script-->