<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Vacation View
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


if($vacation['fly_type'] <> "emergency"){
    
    $vaccslry       = $salary['basic'] + $salary['housing'] ;
    $vacslry        = $vaccslry / 30 * $vacation['vacdays']; //per day salary

    $total_pay_vac  = $vacslry + $vacation['ticket_pay'] + $vacation['permit_fee'];

    if($employee['country'] == "Saudi Arabia"){
        $vacslrygosi        = $vacslry / 100 * 10 ; // gosi payment
        $total_pay_vac      = $total_pay_vac - $vacslrygosi;
    }

}else{
    $total_pay_vac="";
}


$status = (($vacation['status'] == "approve")? "<b class='success'><i class='la la-certificate'></i>Apprved</b>" : (($vacation['status'] == "not_approve")? "<b class='red'><i class='la la-ban'></i>Rejected</b>" : (($vacation['status'] == "apply")? "<b class='info'><i class='la la-ils'></i>New Applied</b>" : "")));

$vactype = (($vacation['vac_type'] == "Local Vacation")? "<b class='info'><i class='la la-odnoklassniki'></i>Local Vacation</b>" : (($vacation['vac_type'] == "Encashed")? "<b class='warning'><i class='la la-money'></i>Encashed</b>" : (($vacation['vac_type'] == "Fly")? "<b class='success'><i class='la la-plane'></i>Trevel</b>" : "")));

/*echo "<pre>";
print_r ($totvac);
echo "</pre>";
exit();
*/
?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Vacation Details</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active"><?=$employee['name']?></li>
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
                        <div class="col-sm-8 col-12 text-center text-sm-left">
                            <div class="media row">
                                <div class="col-12 col-sm-3 col-xl-2">
                                    <img src="<?=base_url($employee['avatar'])?>" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="140" width="140">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12 text-right">
                            <h3>VACATION REPORT</h3>
                            <?php if ($vacation['fly_type'] == 'emergency'): ?>
                            <p class="red lead text-bold-800"><i class="la la-recycle"></i><?=ucfirst($vacation['fly_type'])?></p>
                            <?php endif ?>
                            <p><span class="text-muted">Request Date :</span> <?=$vacation['created_at']?></p>
                            <p><span class="text-muted">Vacation Status :</span> <?=$status?></p>
                            <p><span class="text-muted">Vacation Type :</span> <?=$vactype?></p>
                            <p><span class="text-muted">Empployee ID :</span> #<?=$employee['emp_id']?></p>
                            <p><span class="text-muted">Request ID :</span> #<?=$vacation['id']?></p>
                        </div>
                    </div>

                    <!-- Invoice Items Details -->
                    <div id="invoice-items-details" class="pt-2">
                        
                        <div class="row">
                            <div class="col-sm-6 col-12 text-center text-sm-left">
                                <p class="lead">Personal Information:</p>
                                <div class="row">
                                    <div class="col-sm-11">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Full Name:</td>
                                                        <td class="text-right"><?=$employee['name']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nationality:</td>
                                                        <td class="text-right"><?=$employee['country']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Department:</td>
                                                        <td class="text-right"><?=$employee['dept']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Section:</td>
                                                        <td class="text-right"><?=$employee['sectin_nme']?></td>
                                                    </tr>
                                                    <?php if ($vacation['fly_type']<>'emergency'): ?>
                                                    <tr>
                                                        <td>Vacation Salary:</td>
                                                        <td class="text-right"><?=number_format($vacslry)." - SAR"?></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php if ($employee['country']=='Saudi Arabia'): ?>
                                                    <tr>
                                                        <td>GOSI Deduction:</td>
                                                        <td class="pink text-right"><?=number_format($vacslrygosi)." - SAR"?></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php if ($vacation['fly_type']=='fly'): ?> 
                                                    <tr>
                                                        <td>Ticket Fares:</td>
                                                        <td class="text-right"><?=number_format($vacation['ticket_pay'])." - SAR"?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Exit Re-Entry Permit Fee:</td>
                                                        <td class="text-right"><?=number_format($vacation['permit_fee'])." - SAR"?></td>
                                                    </tr>
                                                    <?php endif ?>
                                                    
                                                    <?php if ($vacation['vac_type'] <> "Encashed"): ?>
                                                    <tr>
                                                        <td>Replacement Person:</td>
                                                        <td class="text-right"><?=$vacation['replacement_per']?></td>
                                                    </tr>
                                                    <?php endif ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p class="lead">Vacation Information</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Vacation Date:</td>
                                                <td class="text-right"><?=$vacation['vac_strt_date']?></td>
                                            </tr>

                                            <?php if ($vacation['vac_type'] <> "Encashed"): ?>
                                            <tr>
                                                <td>Return Before:</td>
                                                <td class="text-right"><?=$vacation['return_date']?></td>
                                            </tr>
                                            <?php endif ?>

                                            <tr>
                                                <td>Days of Vacation:</td>
                                                <td class="pink text-right"><?=$vacation['vacdays']." Days"?></td>
                                            </tr>
                                            <tr>
                                                <td>Balance Days:</td>
                                                <td class="info text-right"><?=$employee['vacation_days']-$totvac['SUMDAYS']." Days"?></td>
                                            </tr>
                                            <tr>
                                                <td>Next Vacation:</td>
                                                <td class="text-right"><?=$vacation['next_vac_date']?></td>
                                            </tr>
                                            <tr>
                                                <td>Last Vacation:</td>
                                                <td class="text-right"><?=$vacation['last_vac_date']?></td>
                                            </tr>
                                            <tr>
                                                <td>Joining Date:</td>
                                                <td class="text-right"><?=$vacation['joining_date']?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <p class="mb-0 mt-1">Total Payment for Vacation:</p>
                                    <?php if ($vacation['fly_type']<>'emergency'): ?>
                                    <h2><?=number_format($total_pay_vac)." - SAR"?></h2>
                                    <?php else: ?>
                                    <h3>Nothing to Pay</h3>
                                    <?php endif; ?>
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