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
                            <!-- <li class="breadcrumb-item active"><a href="<?//=base_url("/machine/view/".$invoices[0]['mid'])?>"><?//=$invoices[0]['name_mach']?></a></li> -->
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
				                
            <section class="card">
                <div id="invoice-template" class="card-body p-4">
                    <!-- Invoice Company Details -->
                    <div class="row">
                        <div class="col-sm-12 col-12 text-center">
                            <img src="<?=base_url("/")?>/app-assets/images/logo/LogoInWidth.png" width="240">
                        </div>
                    </div>

            	<form action="<?=base_url('/smart/request/create/')."/".$requestGet->uri->getSegment(4)?>" method="post" enctype="multipart/form-data">
            	<?=csrf_field()?>
                    <div id="invoice-company-details" class="row">
                        <div class="col-6 ">
	                        <div class="mt-3 float-left">
	                            <div class="input-group mb-2">
	                                <div class="input-group-prepend">
	                                    <div class="input-group-text">Invoice Date:</div>
	                                </div>
	                                <input class="form-control" type='text' value="<?php echo date("d F Y")?>" readonly />
	                            </div>
	                            <div class="input-group mb-2">
	                                <div class="input-group-prepend">
	                                    <div class="input-group-text">Sub. Type *</div>
	                                </div>
	                                <select class="form-control" name="sub_type" required>
	                                    <option value="">Select</option>
	                                <?php foreach ($subject_type as $value): ?>
	                                    <option value="<?=$value['sub_type']?>"><?=$value['sub_type']?></option>
	                                <?php endforeach;  ?>
	                                </select>
	                            </div>
	                           
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
                                        <tr class="set">
                                            <td><input type="text" class="form-control rowid" readonly value="1" id="row"></td>
                                            <td>
                                                <input type="text" name="item_name[]" placeholder="Enter item name" class="form-control" id="item_name" required autocomplete="off" >
                                            </td>
                                            <td>
                                                <select class="form-control" name="location[]" required>
                                                    <option value="">Select</option>
                                                <?php foreach ($locations as $location):?>
                                                    <option value="<?=$location['section_name']?>"><?=str_replace(' ','', $location['section_name'])?></option>
                                                <?php endforeach; ?>
                                                </select>
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
                                <div class="col-sm-7 col-12 text-center text-sm-left"></div>
                                <div class="col-sm-5 col-12 text-right">
                                    <div class="table-responsive">
                                        <table class="table" id="gtotal">
                                            <tbody>
                                                <tr>
                                                    <td>Net-Total <small>(without VAT)</small></td>
                                                    <td class="text-right"><div id="subtotal"></div></td>
                                                </tr>
                                                <tr>
                                                    <td>VAT 15%</td>
                                                    <td class="text-right"><div id="vat"></div></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-800">Total <small>(Before Disc.)</small></td>
                                                    <td class="text-bold-800 text-right"><div id="total"></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Discount</td>
                                                    <td>
                                                    	<div class="input-group mb-2">
															<input class="form-control discount" type='text' data-type="discount" id='discount' name='discount' value="0" onkeypress="return isNumberKey(event,this)" />
		                                                </div>                                                    	
                                                    </td>                                                    
                                                </tr>
                                                <tr class="bg-grey bg-lighten-4">
                                                    <td class="text-bold-800">Grand Total</td>
                                                    <td class="text-bold-800 text-right"><div id="grandtotal"></div></td>
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
                            	<button type="submit" name="submit_item_register" class="btn btn-info">Register</button>
                                <!-- <button type="button" class="btn btn-info btn-lg my-1" onclick="printDiv('invoice-template')">
                                    <i class="la la-paper-plane-o mr-50"></i>Print Report</button> -->
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Footer -->
            	</form>

                </div>

            </section>

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

    <!-- BEGIN: Page JS-->
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pages/material-app.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pages/invoice-template.js"></script>
    <script type="text/javascript">
        function printDiv(divName){
            var printContents = document.getElementById(divName).innerHTML;
            document.getElementById("invoice-template").innerHTML = printContents;
            window.print();
        }
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
            
        var rowCount = 1;

        document.addEventListener('keydown', (e) => {
            if (e.key.toLowerCase() === '+' && e.ctrlKey && e.shiftKey) {
                e.preventDefault();

                // Add your code here
            rowCount++;
            $('#orders').append('<tr id="row'+rowCount+'">'+
                '<td><input type="text" class="form-control rowid" value="'+rowCount+'" readonly></td>'+

                '<td><input type="text" name="item_name[]" placeholder="Enter item name" class="form-control" id="item_name" required autocomplete="off"></td>'+
                '<td><select class="form-control" name="location[]" required><option value="">Select</option><?php foreach ($locations as $location):?><option value="<?=$location['section_name']?>"><?=str_replace(' ','', $location['section_name'])?></option><?php endforeach; ?></select></td>'+
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
                '<td><select class="form-control" name="location[]" required><option value="">Select</option><?php foreach ($locations as $location):?><option value="<?=$location['section_name']?>"><?=str_replace(' ','', $location['section_name'])?></option><?php endforeach; ?></select></td>'+
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

            $('#subtotal').html( round(subtotal - totalvat, 2) );
            $('#total').html( round(subtotal, 2) );
            $('#vat').html( round(totalvat,2) );
            $('#grandtotal').html( round(subtotal - disc, 2) );

            /*$('#subtotal').val( round(subtotal - totalvat, 2) );
            $('#total').val( round(subtotal, 2) );
            $('#vat').val( round(totalvat,2) );
            $('#grandtotal').val( round(subtotal - disc, 2) );*/
            // $('#grandtotal').val( toWordsconver(subtotal - disc) );
        }

        function round(value, decimals) {
            return Number(Math.round(value +'e'+ decimals) +'e-'+ decimals).toFixed(decimals);
        }
	});

    </script>
<?= $this->endSection(); ?>
<!-- End: Script-->