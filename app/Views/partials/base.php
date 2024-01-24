<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
  	<title><?= $this->renderSection('title'); ?></title>
    <link rel="apple-touch-icon" href="<?= base_url('/') ?>/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('/') ?>/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/fonts/material-icons/material-icons.css">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/material-vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/material.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/material-extended.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/material-colors.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/css/colors.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <?= $this->renderSection('pageCSS'); ?>
    <!-- END: Page CSS-->

    <!-- BEGIN: Icons CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/fonts/feather/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/fonts/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/fonts/material-icons/materialdesign.css">
    <!-- END: Icons CSS-->

    <!-- BEGIN: Custom CSS-->
    <!-- <link rel="stylesheet" type="text/css" href="<?// base_url('/') ?>/assets/css/style.css"> -->
    <!-- END: Custom CSS-->

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/material-vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/') ?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->

<style type="text/css">
    .datepicker table tr td span {
        display: block !important;
        width: 23% !important;
        height: 54px !important;
        line-height: 54px !important;
        float: left !important;
        margin: 1% !important;
        cursor: pointer !important;
        -webkit-border-radius: 4px !important;
        -moz-border-radius: 4px !important;
        border-radius: 4px !important;
    } 
    .datepicker td, .datepicker th {
        text-align: center !important;
    }
    .datepicker td.disabled, .datepicker th.disabled {
        /*color: #c1c1c1 !important;*/
        color: #ffb2b2 !important;
    }
    .datepicker tbody tr > td.day.range {
        color: #fff !important;
        background: #606060 !important;
    }
</style>


</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-compact-menu material-vertical-layout material-layout 2-columns fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    

    <!-- END: Main Menu-->
    <?php if (session()->get('user')['user_type'] == 'employee'): ?>
        <?= $this->include('partials/emp_menu'); ?>
    <?php else: ?>
        <?= $this->include('partials/menu'); ?>
    <?php endif ?>



  <?= $this->renderSection('content'); ?>


  	<div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2009 - <?= date('Y') ?></span><span class="float-md-right d-none d-lg-block">SnapS Production<i class="ft-heart pink"></i><span id="scroll-top"></span></span></p>
    </footer>
    <!-- END: Footer-->



    <?= $this->renderSection('script'); ?>



    <!-- BEGIN: Theme JS-->
    <script src="<?= base_url('/') ?>/app-assets/js/core/app-menu.js"></script>
    <script src="<?= base_url('/') ?>/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?= base_url('/') ?>/app-assets/js/scripts/pages/material-app.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
