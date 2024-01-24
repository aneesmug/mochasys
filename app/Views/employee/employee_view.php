<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Employees View
<?= $this->endSection(); ?>
<?php
if (!$permission->authorize($permission->method('/employee/list','read')->access())) {
    session()->setFlashData('error', "You do not have permission to access. Please contact with administrator.");
    \Config\Services::response()->redirect(base_url('/dashboard'))->send();
}
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

    <?php /* ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/js/scripts/pickers/bootstrap-timepicker/bootstrap-timepicker.min.css">
    <?php */ ?>

    <!-- END: Vendor CSS-->
    <style type="text/css">.noneDIV { display:none; }, .showDIV { display:block; } </style>
<?php

if($employee['emp_sup_type'] == 'mocha'){
    $finalvacd = $employee['vacation_days'] - $SUMDAYS = (count($vacation)>'0')?$vacation['SUMDAYS']:"";
    $baldays = ($finalvacd >= $employee['vacation_days']) ? "<span class='badge badge-info'>$finalvacd Days</span>" : "<span class='badge badge-danger'>$finalvacd Days</span>" ;
}else{
    $baldays = "";
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


    $lastvac = $lastvac->select('*')
                        ->where('emp_id',$employee['emp_id'])
                        ->where('status','apply')
                        ->where('review','A')
                        ->orderBy('id','DESC')
                        ->limit('1')
                        ->get()
                        ->getRowArray();
    // $lastcheck = (count($lastvac) > 0) ? $lastvac['status'] : "" ;
    $contants  = $emp_docu
                        // ->select('employee_temp_contants.*,employees.name,employees.dept')
                        // ->join('employees','employees.emp_id=employee_temp_contants.emp_id')
                        ->where('emp_id',$employee['emp_id'])
                        ->where('status','A')
                        ->get()
                        ->getResultArray();

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
                                <a class="mr-1" href="javascript:void(0);">
                                    <img src="<?=base_url($employee['avatar'])?>" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="90" width="90">
                                </a>
                                <div class="media-body pt-25">
                                    <h4 class="media-heading"><span class="users-view-name"><?= $employee['name'] ?></span></h4>
                                    <span>Employee ID:</span>
                                    <span class="users-view-id"><?= $employee['emp_id'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                            <label class="btn btn-sm mr-25 btn-success cursor-pointer" for="img-crop" ><?=($employee['avatar']!=="./assets/emp_pics/defult.png")?"Change Picture":"Add New Picture";?></label>
                            <!-- <input type="file" name="image" class="image" hidden="" id="upload_image" accept="image/*"> -->
                            <input type="file" name="image" class="image" hidden="" id="img-crop" accept="image/*">

                            <a href="javascript:void(0);" class="btn btn-sm mr-25 btn-primary" data-toggle="modal" data-target="#modalDocu" data-keyboard="true" data-backdrop="static" >Add Documents</a>
                            <?php if (isset($lastvac['status'])  == 'apply'): ?>
                                <a href="javascript:void(0);" class="btn btn-sm mr-25 btn-warning">Vacation Applied</a>
                            <?php else: ?>
                                <a href="javascript:void(0);" class="btn btn-sm mr-25 btn-dark" data-toggle="modal" data-target="#large" >Apply Vacation</a>
                            <?php endif ?>
                            <a href="<?=base_url('employee/edit')."/".$employee['id']?>" class="btn btn-sm btn-info">Edit</a>
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
                                    <div class="col-12 col-md-2">
                                        <img src="<?=base_url('Employee/qrcode/'.$employee['id']) ?>" />
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
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-2 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex active" id="account-pill-profile" data-toggle="pill" href="#profile" aria-expanded="true">
                                        <i class="ft-user mr-50"></i>
                                        Profile
                                    </a>
                                </li>
                                <?php if(session()->get('user')['user_type'] !== "dept_user"){ ?>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-vacation_details" data-toggle="pill" href="#vacation_details" aria-expanded="false">
                                        <i class="ft-lock mr-50"></i>
                                        Vacation Details
                                    </a>
                                </li>
                                <?php } ?>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-documents" data-toggle="pill" href="#documents" aria-expanded="false">
                                        <i class="ft-info mr-50"></i>
                                        Documents
                                    </a>
                                </li>
                                <?php if ($employee['emptype'] == "Manager") { ?>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-employees" data-toggle="pill" href="#employees" aria-expanded="false">
                                        <i class="ft-camera mr-50"></i>
                                        Employees
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- right content section -->
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="profile" aria-labelledby="account-pill-profile" aria-expanded="true">
                                                <div class="table-responsive">
                                                    
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Name of Employee:</th>
                                                                <th>Iqama / ID:</th>
                                                                <th>Passport No.:</th>
                                                                <th>Date of Birth:</th>
                                                                <th>Gender:</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?= $employee['name'] ?></td>
                                                                <td><?= $employee['iqama'] ?></td>
                                                                <td><?= $employee['passport'] ?></td>
                                                                <td><?= $employee['dob'] ?></td>
                                                                <td><?= ucfirst($employee['sex']) ?></td>
                                                            </tr>
                                                        </tbody>

                                                        <thead>
                                                            <tr>
                                                                <th>Mobile No.:</th>
                                                                <th>Email:</th>
                                                                <th>Marital Status:</th>
                                                                <th>T-Shirt Size:</th>
                                                                <th>Section Area:</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?= $employee['mobile'] ?></td>
                                                                <td><?= $employee['email'] ?></td>
                                                                <td><?= $employee['mar_status'] ?></td>
                                                                <td><?= $employee['t_shirt_size'] ?></td>
                                                                <td><?= $employee['sectin_nme'] ?></td>
                                                            </tr>
                                                        </tbody>

                                                        <thead>
                                                            <tr>
                                                                <th>Date Hired:</th>
                                                                <th>Iqama / ID Expiry:</th>
                                                                <th>Passport Expiry:</th>
                                                                <th>Emergency Contact:</th>
                                                                <th>Emergency Name:</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?= $employee['joining_date'] ?></td>
                                                                <td><?= $employee['iqama_exp'] ?>
                                                                    <h6 class='badge badge-pill badge-info'>
                                                                    <?= $iqama_exp ?>
                                                                    </h6>
                                                                </td>
                                                                <td><?= $employee['passport_exp'] ?></td>
                                                                <td><?= $employee['emg_mobile'] ?></td>
                                                                <td><?= $employee['emg_name'] ?></td>
                                                            </tr>
                                                        </tbody>
                                                        <thead>
                                                            <tr>
                                                                
                                                                <th>Contract Period:</th>
                                                                <th>Country:</th>
                                                                <th>Department:</th>
                                                                <th>Current Total Salary:</th>
                                                                <th colspan="2">Address:</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?= $employee['vac_period'] ?></td>
                                                                <td><?= $employee['country'] ?></td>
                                                                <td><?= $employee['dept'] ?></td>
                                                                <td><?= $employee['salary'] ?></td>
                                                                <td colspan="2"><?= $employee['address'] ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            </div>
                                            </div>
                                            <?php if(session()->get('user')['user_type'] !== "dept_user"){ ?>
                                                
                                            <div class="tab-pane fade" id="vacation_details" role="tabpanel" aria-labelledby="account-pill-vacation_details" aria-expanded="false">
                                                <table class="table table-hover fileexport" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Vacation Date</th>
                                                    <th>Return Date</th>
                                                    <th>Permit No</th>
                                                    <th>Notes</th>
                                                    <th>Days</th>
                                                    <th>Arrived</th>
                                                    <th>Remarks</th>
                                                    <th>Apply Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($vaclists as $value) : ?>
                                                <tr>
                                                    <td><?= $value['date'] ?></td>
                                                    <td><?= $value['return_date'] ?></td>
                                                    <td><?= $value['permit_no'] ?></td>
                                                    <td><?= $value['note'] ?></td>
                                                    <td><?= $value['vacdays'] ?></td>
                                                    <td><?= $value['arrived_date'] ?></td>
                                                    <td><?= $value['remarks'] ?></td>
                                                    <td><?= $value['created_at'] ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="<?=$value['id']?>" class="btn btn-info"><i class='la la-pencil-square'></i></a>
                                                            <a href="javascript:void(0);" class="btn btn-danger delete" data-id="<?=$value['id']?>">
                                                                <i class='la la-trash-o'></i>
                                                            </a>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Vacation Date</th>
                                                    <th>Return Date</th>
                                                    <th>Permit No</th>
                                                    <th>Notes</th>
                                                    <th>Days</th>
                                                    <th>Arrived</th>
                                                    <th>Remarks</th>
                                                    <th>Apply Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                            </div>
                                            <?php } ?>

                                            <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
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
                                                            <?php foreach ($contants as $contant) : ?>
                                                            <tr>
                                                                <td><?=$contant['id']?></td>
                                                                <td><?=$contant['docu_typ'] ?></td>
                                                                <td><?=$contant['docu_ext']?></td>
                                                                <td><?=$contant['created_at']?></td>
                                                                <td>
                                                                    <?php  ?>
                                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                                        <a href="<?=base_url("/employee/download/".$contant['id'])?>" class="btn btn-dark"><i class='ft ft-download'></i></a>
                                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#large<?=$contant['id']?>" class="btn btn-info"><i class='ft ft-eye'></i></a>
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

                                            <?php if ($employee['emptype'] == "Manager") { ?>
                                            <div class="tab-pane fade " id="employees" role="tabpanel" aria-labelledby="account-pill-employees" aria-expanded="false">
                                                <div class="row mt-2">
                                                <?php 
                                                if ($empsuprt) : ;
                                                foreach ($empsuprt as $value): ?>

                                                <div class="col-xl-3 col-md-6 col-12">
                                                    <div class="card border-blue border-lighten-2 pull-up">
                                                        <div class="text-center ">
                                                            <div class="card-body">
                                                                <img src="<?=base_url($value['avatar'])?>" class="rounded-circle  height-150" alt="Card image">
                                                            </div>
                                                            <div class="card-body">
                                                                <h4 class="card-title"><?=$value['name']?></h4>
                                                                <h6 class="card-subtitle text-muted">
                                                                    <span class="badge badge-secondary users-view-status">
                                                                        ID: <?=$value['emp_id']?>
                                                                    </span>
                                                                    <span class="badge bg-blue-grey users-view-status">
                                                                        Iqama / ID: <?=$value['iqama']?>
                                                                    </span>
                                                                </h6>
                                                            </div>
                                                            <div class="card-body">
                                                            <a href="<?=base_url('employee/view')."/".$value['id']?>" class="btn btn-outline-info btn-md btn-round mr-1"><i class="ft ft-eye"></i> View</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php endforeach; else :  ?>
                                                <div class="card-body align-content-center">
                                                    <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
                                                        <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                                        <strong>Oh snap!</strong> No Employee registerd under this Manager.
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
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
<!-- Modal -->
<div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= base_url('/vacation/register/'.$employee['id']) ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Vacation Apply Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Employee Name</label>
                        <input type="text" value="<?=$employee['name']?>" class="form-control" name="emp_name" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="emp_id">Employee ID.</label>
                        <input type="text" value="<?=$employee['emp_id']?>" class="form-control" name="emp_id" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="type">Department</label>
                        <input type="text" value="<?=$employee['dept']?>" class="form-control" name="dept" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_select" >Vacation Date<span class="text-danger">*</span></label>
                        <input type="text" name="vac_strt_date" parsley-trigger="change" placeholder="yyyy-mm-dd" class="form-control" id="date_select" autocomplete="off">
                    </div>
                   
                   <div class="form-group col-md-6">
                        <label for="inlineRadio3" class="radioalign">Remarks<span class="text-danger">*</span></label>
                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio3" value="Local Vacation" name="vac_type" class="LocalVacation" >
                            <b for="inlineRadio3"><i class="fa fa-odnoklassniki"></i> Local Vacation</b>
                        </div>
                        <?php //if($row->country <> "Saudi Arabia" && $row->country <> "Myanmar" ){?>
                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio1" value="Fly" name="vac_type" class="showFly" />
                            <b for="inlineRadio1"><i class="fa fa-plane"></i> Fly </b>
                        </div>
                        <?php //} ?>
                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio2" value="Encashed" name="vac_type" class="showEncashed">
                            <b for="inlineRadio2"><i class="mdi mdi-square-inc-cash"></i> Encashed</b>
                        </div>                                              
                    </div> 
                    
                </div>
                    <div class="form-row noneDIV" id="LocalVacationDIV">
                    <div class="form-group col-md-6">
                    <label for="type">Replacement Person!<span class="text-danger">*</span></label>
                    <select class="custom-select" name="replacement_per" id="replacement_per_local">
                        <option value="">Select</option>
                    <?php
                        foreach ($empreplace as $value): 
                    ?>
                        <option value="<?=$value['name']?>"><?=$value['name']?></option>
                    <?php endforeach ?>
                    </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="return_date_v">Return Date<span class="text-danger">*</span></label>
                        <input type="text" name="return_date" id="return_date_v" parsley-trigger="change" placeholder="yyyy-mm-dd" class="form-control" autocomplete="off">
                    </div>
                    <!-- <div class="form-group col-md-12">
                        <label for="remarks">Notes<span class="text-danger">*</span></label>
                        <input type="text" name="remarks" parsley-trigger="change" class="form-control" id="remarks"  autocomplete="off">
                    </div> -->
                    </div>
                
                    <div class="form-row noneDIV" id="FlyDIV">
                   
                   <div class="form-group col-md-6">
                    <label for="type">Replacement Person!<span class="text-danger">*</span></label>
                    <select class="custom-select" name="replacement_per" id="replacement_per_fly">
                        <option value="">Select</option>
                    <?php
                        foreach ($empreplace as $value): 
                    ?>
                        <option value="<?=$value['name']?>"><?=$value['name']?></option>
                    <?php endforeach ?>
                    </select>
                    </div>
                   
                    <div class="form-group col-md-6">
                        <label for="return_dated" >Return Date<span class="text-danger">*</span></label>
                        <input type="text" name="return_date" parsley-trigger="change" placeholder="yyyy-mm-dd" class="form-control" id="return_dated" autocomplete="off" required>
                    </div>
                    <div class="form-group col-md-12">
                    <label for="type" class="radioalign">Select Vacation Type<span class="text-danger">*</span></label>
                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="vac_type1" value="annual" name="fly_type">
                            <b for="vac_type1"><i class="mdi mdi-all-inclusive"></i> Annual Vacation</b>
                        </div>
                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="vac_type2" value="emergency" name="fly_type">
                            <b for="vac_type2"><i class="mdi mdi-chemical-weapon"></i> Emergency Vacation</b>
                        </div>  
                    </div>
                    </div>

                <input type="hidden" name="joining_date" value="<?=$employee['joining_date']?>" />
                <input type="hidden" name="vac_period" value="<?=$employee['vac_period']?>" />

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Apply Vacation</button>
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


<div class="modal fade" id="modalDocu" tabindex="-1" role="dialog" aria-labelledby="modalLabelDocu" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?=base_url('/employee/storeFile/'.$employee['id'])?>" method="post" enctype="multipart/form-data">
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
                                    <option value="Iqama/ID">Iqama/ID</option>
                                    <option value="Passport">Passport</option>
                                    <option value="Certificates">Certificates</option>
                                    <option value="Baladiya Card">Baladiya Card</option>
                                    <option value="Contract">Contract</option>
                                    <option value="CV">CV</option>
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

    <!-- <script src="<?// base_url('/') ?>/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="<?// base_url('/') ?>/app-assets/vendors/js/extensions/polyfill.min.js"></script>
    <script src="<?// base_url('/') ?>/app-assets/js/scripts/pages/account-setting.js"></script> -->

    <script src="<?= base_url('/') ?>/app-assets/js/scripts/croppie/croppie.js" type="text/javascript"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/croppie/croppie.min.js" type="text/javascript"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/croppie/exif.js" type="text/javascript"></script>

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

    <script src="<?= base_url('/') ?>/app-assets/vendors/js/extensions/cropper.js"></script>
    <!-- <script src="<?// base_url('/') ?>/app-assets/vendors/js/extensions/cropper.min.js"></script> -->
    <!-- <script src="<?// base_url('/') ?>/app-assets/js/scripts/extensions/image-cropper.js"></script> -->
    <script>
        var bs_modal = $('#modalAvatar');
        var image = document.getElementById('image');
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
                width: 250,
                height: 250,
            });
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "<?=base_url('/employee/upload/'.$employee['id'])?>",
                        data: {image: base64data, 'type': 'Profile Picture', [csrfName]: csrfHash},
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
        /*$(document).ready(function () {
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
            $('#img-crop').on('change', function () {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $image_crop.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#imageModel').modal('show');
            });
            $('.crop_my_image').click(function (event) {
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                var csrfHash = $('.txt_csrfname').val(); // CSRF hash
                $image_crop.croppie('result', {
                    }).then(function (response) {
                    $.ajax({
                        url: "<?//base_url('/employee/upload/'.$employee['id'])?>",
                        type: "POST",
                        data: {"image": response, [csrfName]: csrfHash},
                        success: function (data) {
                            // console.log(data.message);
                            if (data.success == true) {
                                $('#imageModel').modal('hide');
                                alert('Message Header Here', data.message );
                                location.reload(); //refresh page after uploading
                                //html = '<img src="' + resp + '" />';
                                //$("#upload_emp_img_i").html(html);
                            } else {
                                $("body").append("<div class='upload-error'> File Error </div>");
                            }
                        }
                    });
                });
            });
        });*/
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

    </script>

<?= $this->endSection(); ?>
<!-- End: Script-->