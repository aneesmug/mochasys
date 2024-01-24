<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Employees View
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


    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/plugins/pickers/daterange/daterange.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri_css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri_css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/pages/card-statistics.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/colors/palette-callout.css">

    <?php /* ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/bootstrap-timepicker.min.css">
    <?php */ ?>

    <!-- END: Vendor CSS-->
    <style type="text/css">.noneDIV { display:none; }, .showDIV { display:block; } </style>

<?php


if($employee['emp_sup_type'] == 'mocha'){
    $finalvacd = $employee['vacation_days'] - $SUMDAYS = (count($vacation)>'0')?$vacation['SUMDAYS']:"";
    // $baldays = ($finalvacd >= $employee['vacation_days']) ? "<span class='badge badge-info'>$finalvacd Days</span>" : "<span class='badge badge-danger'>$finalvacd Days</span>" ;
}else{
    $finalvacd = "";
}

// echo "<pre>";
// print_r($vacation);
// echo "</pre>";
// exit();

// $emp_vacdate    = date('Y', strtotime(str_replace('/', '-', (count($vacation)>'0')?$vacation['0']['date']:"" )));

// if($emp_vacdate == date("Y")){
//     if($employee['balance_days'] < 0){
//         $employee['balance_days'] = "<span class='badge badge-pill badge-danger'>".$employee['balance_days']." Days</span>";
//     }
// }

if($employee['emp_sup_type'] == 'mocha'){

$basicslry      = ($salary['basic'] != "0") ? count((array)$salary['basic']) : "0" ;
$housingslry    = ($salary['housing'] != "0") ? count((array)$salary['housing']) : "0" ;
$transportslry  = ($salary['transport'] != "0") ? count((array)$salary['transport']) : "0" ;
$otherslry      = ($salary['other_pay'] != "0") ? count((array)$salary['other_pay']) : "0" ;
$tolslry        = $basicslry + $housingslry + $transportslry + $otherslry;
$totalsalary    = $salary['basic'] + $salary['housing'] + $salary['transport'] + $salary['other_pay'];
$colsm = "";
    switch ($tolslry) {
      case 1:
        $colsm = "col-lg-8";
        break;
      case 2:
        $colsm = "col-lg-4";
        break;
      case 3:
        $colsm = "col-lg-3";
        break;
      case 4:
        $colsm = "col-lg-2";
        break;
    }

} else{
    $colsm = "col-lg-8";
    $salary['basic'] = "0";
    $salary['housing'] = "0";
    $salary['transport'] = "0";
    $salary['other_pay'] = "0";
    $tolslry = "0";
    $totalsalary = "0";
}

    $iqama_exp = ($employee['iqama_exp']) ? $gdate->HijriToGregorian($employee['iqama_exp'], "DD/MM/YYYY") : "" ;

    $birth_date         = new DateTime($employee['dob']);
    $current_date       = new DateTime();

    $diff               = $birth_date->diff($current_date);
    $years              = $diff->y . " Years";

    $vaclists = $vaclists->where('emp_id',$employee['emp_id'])->findAll();
    $empsuprt = $empsuprt->where('dept',$employee['dept'])->where('status','active')->where("`emp_id` <> '".$employee['emp_id']."' ")->findAll(); //'emp_id' <> $employee['emp_id']
    

    $empreplace = $empreplace->where('dept',$employee['dept'])->where('status','active')->findAll(); //'emp_id' <> $employee['emp_id']


    $lastvacs   = $lastvac->select('*')
                        ->where('emp_id',$employee['emp_id'])
                        // ->where('status','apply')
                        ->where('review','A')
                        ->orderBy('id','DESC')
                        ->limit('1')
                        ->get()
                        ->getRowArray();

$approve = $lastvac->selectCount('status')->where('emp_id',$employee['emp_id'])->where('status','approve')->get()->getRowArray();
$noaprve = $lastvac->selectCount('status')->where('emp_id',$employee['emp_id'])->where('status','not_approve')->get()->getRowArray();
$totalap = $lastvac->selectCount('status')->where('emp_id',$employee['emp_id'])->where("`status` <> 'apply'")->get()->getRowArray();





// $var = $approve['status']*100/$totalap['status'];

    /*echo "<pre>";
    print_r ($dateDiff->ageDOB($employee['joining_date']));
    echo "</pre>";
    exit();*/

    // $lastcheck = (count($lastvac) > 0) ? $lastvac['0']['status'] : "" ;

?>
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
                                <a class="mr-1" href="#">
                                    <img src="<?=base_url($employee['avatar'])?>" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="90" width="90">
                                </a>
                                <div class="media-body pt-25">
                                    <h4 class="media-heading"><span class="users-view-name"><?= $employee['name'] ?></span></h4>
                                    <span>Employee ID:</span>
                                    <span class="users-view-id"><?= $employee['emp_id'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- users view media object ends -->
                    <!-- users view card data start -->

                    <div class="alert bg-cyan alert-icon-left alert-dismissible mb-2" role="alert">
                        <span class="alert-icon"><i class="la la-heart"></i></span>
                        <h2 style="color: #fff;">Your Mochachino happy life is <?=$dateDiff->ageDOB($employee['joining_date'])?></h2>
                    </div>


                    <?php if (isset($lastvacs['status'])  == 'apply'): ?>
                    <div class="alert bg-warning alert-icon-left alert-dismissible mb-2" role="alert">
                        <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                        <h4 style="color: #fff;">You already register your Vacation for date of "<b><?=$lastvacs['vac_strt_date']?></b>"</h4>
                    </div>
                    <?php endif ?>


                    
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
                    <?php /* ?>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="card pull-up">
                                <img src="<?= base_url('Employee/qrcode/'.$employee['id']) ?>" height="50%" width="50%" />
                            </div>
                        </div>
                    </div>
                    <?php */  ?>


                    <div class="row card-icons">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                                <div class="media">
                                                    <img src="<?=base_url('Employee/qrcode/'.$employee['id'])?>" height="50%" width="50%" />
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                                <div class="media d-flex p-2">
                                                    <div class="align-self-center">
                                                        <i class="la la-sun-o font-large-1 warning d-block mb-1"></i>
                                                        <span class="text-muted text-right">Balance Days</span>
                                                    </div>
                                                    <div class="media-body text-right">
                                                        <span class="font-large-2 text-bold-300 warning"><?=$finalvacd?></span>
                                                    </div>
                                                </div>
                                                <div class="progress mt-1 mb-0" style="height: 7px;">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?=$approve['status']*100/$totalap['status']?>%" aria-valuenow="<?=$approve['status']*100/$totalap['status']?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                                <div class="media d-flex p-2">
                                                    <div class="align-self-center">
                                                        <i class="la la-thumbs-up font-large-1 success d-block mb-1"></i>
                                                        <span class="text-muted text-right">Approved Leave's</span>
                                                    </div>
                                                    <div class="media-body text-right">
                                                        <span class="font-large-2 text-bold-300 success"><?=$approve['status']?></span>
                                                    </div>
                                                </div>
                                                <div class="progress mt-1 mb-0" style="height: 7px;">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?=$approve['status']*100/$totalap['status']?>%" aria-valuenow="<?=$approve['status']*100/$totalap['status']?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                                <div class="media d-flex p-2">
                                                    <div class="align-self-center">
                                                        <i class="la la-thumbs-down font-large-1 danger d-block mb-1"></i>
                                                        <span class="text-muted text-right">Rejected Leave's</span>
                                                    </div>
                                                    <div class="media-body text-right">
                                                        <span class="font-large-2 text-bold-300 danger"><?=$noaprve['status']?></span>
                                                    </div>
                                                </div>
                                                <div class="progress mt-1 mb-0" style="height: 7px;">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?=$noaprve['status']*100/$totalap['status']?>%" aria-valuenow="<?=$noaprve['status']*100/$totalap['status']?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="media d-flex p-2">
                                                    <div class="align-self-center">
                                                        <i class="icon-wallet font-large-1 cyan d-block mb-1"></i>
                                                        <span class="text-muted text-right">Total Leave's</span>
                                                    </div>
                                                    <div class="media-body text-right">
                                                        <span class="font-large-2 text-bold-300 cyan"><?=$totalap['status']?></span>
                                                    </div>
                                                </div>
                                                <div class="progress mt-1 mb-0" style="height: 7px;">
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                                <?php /* ?>
                    <div class="card">
                        <div class="card-content">                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <img src="<?= base_url('Employee/qrcode/'.$employee['id']) ?>" />
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Iqama / ID:</th>
                                                        <th>Department:</th>
                                                        <th>Nationality:</th>
                                                        <th>Balance Vacation Days:</th>
                                                        <th>Blood Group:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $employee['iqama'] ?></td>
                                                        <td><?= $employee['dept'] ?></td>
                                                        <td><?= $employee['country'] ?></td>
                                                        <td><?= $baldays ?></td>
                                                        <td><?= $employee['blood_type'] ?></td>
                                                        
                                                    </tr>
                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Joing Date:</th>
                                                        <th>Mobile:</th>
                                                        <th>Vacation Days:</th>
                                                        <th>Employee Role:</th>
                                                        <th>Status:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $employee['joining_date'] ?></td>
                                                        <td><?= $employee['mobile'] ?></td>
                                                        <td><?= $employee['vacation_days'] ?> Days</td>
                                                        <td><?= $employee['emptype'] ?></td>
                                                        <td><?php if ($employee['status'] == 'active') : ?>
                                                        <span class="badge badge-success users-view-status">Active</span>
                                                        <?php else: ?>
                                                        <span class="badge badge-danger users-view-status">Not Available</span>
                                                        <?php endif ?></td>
                                                    </tr>
                                                </tbody>
                                                    
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                <?php */ ?>
                    <!-- users view card data ends -->
                    <!-- users view salary details start -->                    
                    <div class="row">
                     <div class="<?=$colsm?>">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success"><?=$salary['basic']?></h3>
                                            <h6>Basic</h6>
                                        </div>
                                        <div>
                                            <i class="la la-cubes success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($salary['housing'] != "0"){ ?>
                    <div class="<?=$colsm?>">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success"><?=$salary['housing']?></h3>
                                            <h6>Housing</h6>
                                        </div>
                                        <div>
                                            <i class="la la-home success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } if($salary['transport'] != "0"){ ?>
                    <div class="<?=$colsm?>">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success"><?=$salary['transport']?></h3>
                                            <h6>Transportion</h6>
                                        </div>
                                        <div>
                                            <i class="la la-cab success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } if($salary['other_pay'] != "0"){ ?>
                    <div class="<?=$colsm?>">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success"><?=$salary['other_pay']?></h3>
                                            <h6>Others</h6>
                                        </div>
                                        <div>
                                            <i class="la la-bullseye success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="<?php echo ($tolslry==3) ? 'col-lg-3' : 'col-lg-4' ; ?>">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success"><?=$employee['salary']?></h3>
                                            <h6>Total Salary</h6>
                                        </div>
                                        <div>
                                            <i class="la la-money success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- users view salary details ends -->
                </section>
                <!-- account setting page start -->
                <section class="card">
                <div id="invoice-template" class="card-body p-4">
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
                                                        <td>Iqama:</td>
                                                        <td class="text-right"><?=$employee['iqama']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Iqama Expiry: <span class='badge badge-danger'><?=$iqama_exp?></span></td>
                                                        <td class="text-right"><?=$employee['iqama_exp']?></td>
                                                    </tr>

                                                <?php if($employee['passport']!==""):?>
                                                    <tr>
                                                        <td>Passport:</td>
                                                        <td class="text-right"><?=$employee['passport']?></td>
                                                    </tr>
                                                <?php endif ?>
                                                <?php if($employee['passport']!==""):?>
                                                    <tr>
                                                        <td>Passport Expiry:</td>
                                                        <td class="text-right"><?=$employee['passport_exp']?></td>
                                                    </tr>
                                                <?php endif ?>

                                                    <tr>
                                                        <td>Mobile:</td>
                                                        <td class="text-right"><?=$employee['mobile']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nationality:</td>
                                                        <td class="text-right"><?=$employee['country']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date of Birth: <span class='badge badge-info'><?=$years?></span></td>
                                                        <td class="text-right"><?=$employee['dob']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gender:</td>
                                                        <td class="text-right"><?=ucfirst($employee['sex'])?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Marital Status:</td>
                                                        <td class="text-right"><?=ucfirst($employee['mar_status'])?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Blood Type:</td>
                                                        <td class="text-right"><?=$employee['blood_type']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>T-Shirt Size:</td>
                                                        <td class="text-right"><?=$employee['t_shirt_size']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email Address:</td>
                                                        <td class="text-right"><?=$employee['email']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Home Address:</td>
                                                        <td class="text-right"><?=$employee['address']?></td>
                                                    </tr>
                                                    

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p class="lead">Others Information</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Employee ID:</td>
                                                <td class="text-right"><?=$employee['emp_id']?></td>
                                            </tr>
                                            <tr>
                                                <td>Joining Date:</td>
                                                <td class="text-right"><?=$employee['joining_date']?></td>
                                            </tr>
                                            <tr>
                                                <td>Department:</td>
                                                <td class="text-right"><?=$employee['dept']?></td>
                                            </tr>
                                            <tr>
                                                <td>Section:</td>
                                                <td class="text-right"><?=$employee['sectin_nme']?></td>
                                            </tr>
                                            <tr>
                                                <td>Employee Role:</td>
                                                <td class="text-right"><?=$employee['emptype']?></td>
                                            </tr>
                                            <tr>
                                                <td>Total Salary:</td>
                                                <td class="text-right"><?=$employee['salary']?></td>
                                            </tr>
                                            <tr>
                                                <td>Contract Period:</td>
                                                <td class="text-right"><?=$employee['vac_period']?></td>
                                            </tr>
                                            <tr>
                                                <td>Vacation Days:</td>
                                                <td class="text-right"><?=$employee['vacation_days']?></td>
                                            </tr>
                                            <tr>
                                                <td>Insurance No:</td>
                                                <td class="text-right"><?=$employee['insurance_no']?></td>
                                            </tr>
                                            <tr>
                                                <td>Insurance Expire:</td>
                                                <td class="text-right"><?=$employee['insurance_exp']?></td>
                                            </tr>
                                            <tr>
                                                <td>Bank Name:</td>
                                                <td class="text-right"><?=$employee['bank_name']?></td>
                                            </tr>
                                            <tr>
                                                <td>IBAN:</td>
                                                <td class="text-right"><?=$employee['iban']?></td>
                                            </tr>
                                            <tr>
                                                <td>Emergency Information:</td>
                                                <td class="text-right"><?=$employee['emg_name']." ( ".$employee['emp_relation']." ) ".$employee['emg_mobile']?></td>
                                            </tr>
                                            <tr>
                                                <td>Home Country Address:</td>
                                                <td class="text-right"><?=$employee['emg_address']?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                <!-- account setting page end -->
                <!-- users view ends -->
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
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pages/account-setting.js"></script>


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

    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/bootstrap-timepicker.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri/bootstrap-hijri-datetimepicker.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/hijri/bootstrap-hijri-datetimepicker.min.js"></script>

    <script src="<?= base_url('/') ?>/app-assets/js/scripts/cards/card-statistics.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){

        var buttonConfig = [];
        var columnsConfig = [ 0, 1, 2, 3, 4 ];
        var exportTitle = "All Expiry ID Employees";

        buttonConfig.push({extend:'excel',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-success'});
        buttonConfig.push({extend:'pdf',exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-danger'});
        buttonConfig.push({extend:'print' ,exportOptions: {columns: columnsConfig} ,title: exportTitle,className: 'btn-dark'});

        // $('.fileexport').DataTable( {
        $('.fileexport').DataTable( {
            dom: 'Bfrtip',
            buttons: buttonConfig
        } );
    });

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
                        url: '<?=base_url("vacation/delete/")?>/'+itemId,
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


    /***************************/

$(".LocalVacation").click(function() {
    $("#LocalVacationDIV").removeClass("noneDIV");
    $("#LocalVacationDIV").addClass("showDIV");

    //Make sure schoolDIV is not visible
    $("#FlyDIV").removeClass("showDIV");
    $("#EncashedDIV").removeClass("showDIV");
    $("#FlyDIV").addClass("noneDIV");
    $("#EncashedDIV").addClass("noneDIV");

    $("#LocalVacationDIV :input").prop('required',true);
    $("#FlyDIV :input").prop('required',null);
    $("#EncashedDIV :input").prop('required',null);
    
    $("input#return_date_v:text").attr('name','return_date');
    $("input#return_dated:text").removeAttr('name');
    $("select#replacement_per_fly").removeAttr('name');
    $("select#replacement_per_local").attr('name','replacement_per');
    
});

$(".showFly").click(function() {
    $("#FlyDIV").removeClass("noneDIV");
    $("#FlyDIV").addClass("showDIV");

    //Make sure bankDIV is not visible
    $("#LocalVacationDIV").removeClass("showDIV");
    $("#EncashedDIV").removeClass("showDIV");
    $("#LocalVacationDIV").addClass("noneDIV");
    $("#EncashedDIV").addClass("noneDIV");

    $("#FlyDIV :input").prop('required',true);
    $("#LocalVacationDIV :input").prop('required',null);
    $("#EncashedDIV :input").prop('required',null);
    
    $("input#return_dated:text").attr('name','return_date');
    $("input#return_date_v:text").removeAttr('name');
    $("select#replacement_per_local").removeAttr('name');
    $("select#replacement_per_fly").attr('name','replacement_per');
    
});
    
$(".showEncashed").click(function() {
    $("#EncashedDIV").removeClass("noneDIV");
    $("#EncashedDIV").addClass("showDIV");

    //Make sure bankDIV is not visible
    $("#FlyDIV").removeClass("showDIV");
    $("#LocalVacationDIV").removeClass("showDIV");
    $("#FlyDIV").addClass("noneDIV");
    $("#LocalVacationDIV").addClass("noneDIV");

    $("#FlyDIV :input").prop('required',null);
    $("#LocalVacationDIV :input").prop('required',null);
    
    $("input#return_dated:text").attr('name','');
    $("input#return_date_v:text").attr('name','');
    $("input#remarks:text").attr('name','');
    $("select#replacement_per_local").attr('name','');
    $("select#replacement_per_fly").attr('name','');
});
    /***************************/

    jQuery(document).ready(function () {
        $('#date_select').datepicker({
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
        });

    });

    </script>


<?= $this->endSection(); ?>
<!-- End: Script-->