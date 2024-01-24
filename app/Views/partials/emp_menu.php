<?php

     $request   = \Config\Services::request();
     $this->db  = \Config\Database::connect();
     // $request->uri->getTotalSegments();
     $url       = $request->uri->getSegment(1);
     $suburl    = $request->uri->getSegment(2);
     $path      = $request->uri->getPath();
     $countapl  = $this->db->table('apply_vacation')->where('status','apply')->get()->getResultArray();


    /*echo "<pre>";
    print_r (session()->get('user'));
    echo "</pre>";
    exit();*/


?>

<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-shadow navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="javascript:void(0);"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item"><a class="navbar-brand" href="<?=base_url('/employeedash')?>"><img class="brand-logo" alt="admin logo" src="<?=base_url('/')?>/app-assets/images/logo/LogoWithoutText.png">
                            <h3 class="brand-text">Mochachino System</h3>
                        </a></li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="material-icons mt-50">more_vert</i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left"></ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="javascript:void(0);" data-toggle="dropdown"><span class="mr-1 user-name text-bold-700"><?= session()->get('user')['fullname'] ?></span><span class="avatar avatar-online"><img src="<?=base_url(session()->get('user')['emp_data']['avatar'])?>" alt="avatar"><i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="<?=base_url('/employee/profile/edit')?>"><i class="material-icons">person_outline</i> Edit Profile</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="<?=base_url('/logout')?>"><i class="material-icons">power_settings_new</i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

    <div class="main-menu material-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item <?=($url=='employeedash')?'active':'';?>">
                    <a href="<?=base_url('/employeedash')?>"><i class="mbri-desktop"></i><span class="menu-title">Dashboard</span></a>
                </li>
                <li class="nav-item <?=($path=='vacation/apply')?'active':'';?>">
                    <a href="<?=base_url('vacation/apply')?>"><i class="mbri-help"></i><span class="menu-title">Apply Leave</span></a>
                </li>
                <li class="nav-item <?=($path=='vacation/list')?'active':'';?>">
                    <a href="<?=base_url('vacation/list')?>"><i class="la la-comments"></i><span class="menu-title">Leave History</span></a>
                </li>
                <li class=" nav-item"><a href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/documentation" target="_blank"><i class="mbri-file"></i><span class="menu-title" data-i18n="Document">Document</span></a>
                </li>
            </ul>
        </div>
    </div>