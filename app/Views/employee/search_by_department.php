<?= $this->extend('partials/base'); ?>
<?= $this->section('title'); ?>
Mochachino Co | Employees List
<?= $this->endSection(); ?>

<?= $this->section('pageCSS'); ?>
    <!-- BEGIN: Vendor CSS-->
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/material-vendors.min.css"> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/menu/menu-types/material-vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/core/colors/material-palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/fonts/mobiriseicons/24px/mobirise/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/pages/page-users.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/extensions/sweetalert2.min.css">

    <!-- END: Vendor CSS-->
<?php

    if (session()->get('user')['user_type'] == 'dept_user') {
        $employees  = $employees->where('status','active')->where('dept',session()->get('user')['user_dept'])->paginate('12');
    }else{
        $employees  = $employees->where('status','active')->paginate('12');
    }

    $pager      = $pager->pager;
    $request = \Config\Services::request();


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
<!-- search start -->
<section id="search-images" class="card overflow-hidden">
    
    <div class="card-header card-head-inverse bg-blue">
        <h4 class="card-title text-white"><?=$_GET['q']?> Department Employee's</h4>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                <li><a data-action="close"><i class="ft-x"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show">

        <div class="card-body align-content-center">
            <?php /* if(count($employees) > 0){ ?>
                <div class="alert bg-success alert-icon-left alert-dismissible mb-2" role="alert">
                    <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                    <strong>Well done!</strong> Employee search results <b>('<?=count($employees);?>')</b> are found. You try to search with <strong><?=$_GET['q'];?></strong>.
                </div>
            <?php } else { ?>
                <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
                    <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                    <strong>Oh snap!</strong> Employee search results <b>('<?=$_GET['q'];?>')</b> are not found.
                </div>
            <?php } */ ?>
        </div>
        <!--Search Result-->
        <div id="search-results" class="card-body">
            <div class="my-gallery" itemscope="" data-pswp-uid="1">
                <div class="card-deck-wrapper">
                    <div class="card-deck">
                        
                        <?php foreach ($employees as $value): ?>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card border-<?=($value['status']=='active')?"blue":"red"?> border-lighten-2 pull-up" style="box-shadow: 10px !important;">
                                <div class="text-center">
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
                                    

                                    <?php if($value['status']=='active'){ ?>
                                    <a href="<?=base_url('employee/view')."/".$value['id']?>" class="btn btn-outline-<?=($value['status']=='active')?"info":"danger"?> btn-md btn-round mr-1"><i class="ft ft-eye"></i> View</a>
                                    <?php }else{ ?>
                                    <a href='<?=base_url('employee/view')."/".$value['id']?>' class="btn btn-outline-<?=($value['status']=='active')?"info":"danger"?> btn-md btn-round mr-1"><i class="ft ft-slash"></i> Not Active</a>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
<!-- 
                <div class="text-center">
                    
                </div> -->

                

            </div>

            <!--/ PhotoSwipe -->
        </div>
        
        <div class="card-footer">
            <div class="row">
                <div class="col-6">
                    <div class="float-left"><ul class="pagination">Showing: <?=(($pager->getCurrentPage()*$pager->getPerPage())-$pager->getPerPage()+1)?> to <?=$pager->getPerPage()*$pager->getCurrentPage()?> of <?=$pager->getTotal()?> entries</ul></div>
                </div>
                <div class="col-6">
                    <div class="float-right"><?= $pager->links('default','bootstap_full'); ?></div>
                </div>
            </div>
        </div>

    </div>
    <!--/ Search Result-->
</section>
<!-- search list ends -->
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

    <script src="<?= base_url('/') ?>/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/vendors/js/extensions/polyfill.min.js"></script>


    <!-- BEGIN: Page JS-->
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pages/material-app.js"></script>
    <!-- END: Page JS-->

<?= $this->endSection(); ?>
<!-- End: Script-->