<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Invoice View
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

$total_cost = $invSum['subtotal'] - $invSum['vat_val'];
$total 		= $total_cost + $invSum['vat_val'];
$gtotal 	= $total - $invSum['tdiscount'];

	
?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Invoice Details</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=base_url("/dashboard")?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?=base_url("/machine/list/")?>">Machines List</a></li>
                            <li class="breadcrumb-item active"><a href="<?=base_url("/machine/view/".$invoices[0]['mid'])?>"><?=$invoices[0]['name_mach']?></a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <section class="card">
                <div id="invoice-template" class="card-body p-4">
                    <!-- Invoice Company Details -->
                    <div class="row">
                            <div class="col-sm-12 col-12 text-center">
                                <img src="<?=base_url("/")?>/app-assets/images/logo/LogoInWidth.png" width="240">
                            </div>
                        </div>
                    <div id="invoice-company-details" class="row">
                        <div class="col-sm-4 col-12 text-left">
                            <h3>INVOICE REPORT</h3>
                            <p><span class="text-muted">Invoice Date :</span> <?=date('d, M Y h:ia', strtotime($invSum['invCreateDate'])); ?></p>
                            <p><span class="text-muted">Vacation No. :</span> <?=$invSum['invno']?></p>
                            <p><span class="text-muted">Machine Name :</span> <?=$invoices[0]['name_mach']?></p>
                        </div>
                    </div>

                    <!-- Invoice Items Details -->
                        <div id="invoice-items-details" class="pt-2">
                            <div class="row">
                                <div class="table-responsive col-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            	<th width="50">#</th>
                                                <th>Description/Item Name/Invoice Num.</th>
                                                <th width="160">Location</th>
                                                <th width="80">Quantity</th>
                                                <th width="120">Unit Cost</th>
                                                <th width="130">Item Value</th>
                                                <th width="70">Vat%</th>
                                                <th width="100">Vat Val</th>
                                                <th width="130">Amount</th>
                                                <th width="100">Discount</th>
                                                <th width="150" class="text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php $x=1; foreach ($invoices as $invoice): ?>
                                            <tr>
                                            	<td width="50"><?=$x++?></td>
                                                <td><?=$invoice['item_name']?></td>
                                                <td width="160"><?=$invoice['mlocation']?></td>
                                                <td width="80"><?=$invoice['quantity']?></td>
                                                <td width="120"><?=$invoice['product_price']?></td>
                                                <td width="130"><?=$invoice['itmvalue']?></td>
                                                <td width="70"><?=$invoice['vat_rate']?></td>
                                                <td width="100"><?=$invoice['vat_val']?></td>
                                                <td width="130"><?=$invoice['amount']?></td>
                                                <td width="100"><?=$invoice['idiscount']?></td>
                                                <td width="150" class="text-right"><?=$invoice['total_cost']?></td>
                                            </tr>
                                        	<?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-7 col-12 text-center text-sm-left"></div>
                                <div class="col-sm-5 col-12 text-right">
                                    <div class="table-responsive">
                                        <table class="table">
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
                                                    <td class="pink text-right">(-) <?=number_to_currency($invSum['tdiscount'],'SAR', 'en_US', 2)?></td>
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
                                <button type="button" class="btn btn-info btn-lg my-1" onclick="printDiv('invoice-template')">
                                    <i class="la la-paper-plane-o mr-50"></i>Print Report</button>
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Footer -->
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
<?= $this->endSection(); ?>
<!-- End: Script-->