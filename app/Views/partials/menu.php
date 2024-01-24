<?php
        
    $request           = \Config\Services::request();
    $this->db          = \Config\Database::connect();

    use App\Libraries\Permission1;
    $this->Permission1 = new Permission1();

    // $request->uri->getTotalSegments();
    $url       = $request->uri->getSegment(1);
    $suburl    = $request->uri->getSegment(2);
    $path      = $request->uri->getPath();


if (session()->get('user')['user_type'] == 'dept_user') {
    $countapl  = $this->db->table('apply_vacation')->where('status','apply')->where('dept',session()->get('user')['user_dept'])->get()->getResultArray();
} else {
    $countapl       = $this->db->table('apply_vacation')->where('status','dept_approve')->get()->getResultArray();
    $countdocu      = $this->db->table('employee_temp_contants')->where('status','A')->get()->getResultArray();
}
    
    $modules  = $this->db->table('modules')
                                ->select('*, modules.id as menu_id, modules.description as mdescription, modules.directory as mdirectory, modules.icon as micon, modules.name as mname, sub_module.mid as menu_item_id, sub_module.name as sname')
                                ->join('sub_module', 'modules.id=sub_module.mid', 'left')
                                ->join('role_permission', 'sub_module.mid=role_permission.module_id')
                                ->where('modules.status','1')
                                ->where('role_permission.r_read','1')
                                ->groupBy('modules.name')
                                ->orderBy('modules.id','ACS')
                                ->get()
                                ->getResultArray();
    $sub_module  = $this->db->table('sub_module')->get()->getResultArray();


 /*
?>

<ul>
    <?php foreach ($modules as $menu) :?>
        <?php if ($menu['menu_id'] != $menu['menu_item_id']): ?>
            <li><a href="">Register Customer</a></li>
        <?php else: ?>
            <li>
                <a href="javascript:void(0);"><?=$menu['mname']?></a>
                <ul class="menu-content">
                    <?php foreach ($sub_module as $smenu) :?>
                        <?php if ($menu['menu_id'] == $smenu['mid']): ?>
                            <li><a href=""><?=$smenu['name']?></a></li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ul>   
            </li>
        <?php endif ?>
    <?php endforeach ?>
</ul>

<?php exit() */ ?>
    

<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-shadow navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="javascript:void(0);"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item"><a class="navbar-brand" href="<?=base_url('/dashboard')?>"><img class="brand-logo" alt="admin logo" src="<?= base_url('/') ?>/app-assets/images/logo/LogoWithoutText.png">
                            <h3 class="brand-text">Mochachino System</h3>
                        </a></li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="material-icons mt-50">more_vert</i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle" href="javascript:void(0);"><i class="ft-menu"></i></a></li>
                        <li class="nav-item"><a class="nav-link nav-link-expand" href="javascript:void(0);"><i class="ficon ft-maximize"></i></a></li>
                        <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="javascript:void(0);"><i class="material-icons">search</i></a>
                            <div class="search-input">
                                <form method="get" action="<?=base_url('/employee/find')?>">
                                    <input class="input round form-control search-box" type="text" placeholder="Explore your request" name="q" onchange="this.form.submit()" autocomplete="off">
                                </form>
                            </div>
                        </li>
                    </ul>
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
            <?php  ?>
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item <?=($url == 'dashboard') ? 'active' : '';?>">
                    <a href="<?=base_url('/dashboard')?>"><i class="mbri-desktop"></i><span class="menu-title">Dashboard</span></a>
                </li>
                
                <!-- <li class="nav-item"><a href="index.html"><i class="mbri-desktop"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="dashboard-ecommerce.html"><i class="material-icons">add_shopping_cart</i><span data-i18n="eCommerce">eCommerce</span></a>
                        </li>
                        <li><a class="menu-item" href="dashboard-crypto.html"><i class="material-icons">filter_1</i><span data-i18n="Crypto">Crypto</span></a>
                        </li>
                        <li class="active"><a class="menu-item" href="dashboard-sales.html"><i class="material-icons">local_atm</i><span data-i18n="Sales">Sales</span></a>
                        </li>
                    </ul>
                </li> -->
            <?php if( $this->Permission1->method('/employee/list','read')->access() || $this->Permission1->method('/employee/contant/list','read')->access() || $this->Permission1->method('/employee/by/department','read')->access() || $this->Permission1->method('/employee/register','read')->access() ){?>

                <li class="nav-item <?=($url == 'employee') ? 'active' : '';?>"><a href="javascript:void(0);"><i class="icon-users"></i><span class="menu-title" data-i18n="Employees">Employees</span></a>
                    <ul class="menu-content">
                    <?php if($this->Permission1->method('/employee/register','create')->access() ){?>
                        <li><a class="menu-item <?=($path=='employee/register')?'active':'';?>" href="<?=base_url('/employee/register')?>"><i class="ft-user-plus"></i><span data-i18n="register_new">Register Employee</span></a>
                        </li>
                    <?php } if($this->Permission1->method('/employee/list','read')->access() ){ ?>
                        <li><a class="menu-item <?=($path=='employee/list')?'active':'';?>" href="<?=base_url('/employee/list')?>"><i class="ft-users"></i><span data-i18n="employee_list">Employees List</span></a>
                        </li>
                    <?php } if($this->Permission1->method('/employee/contant/list','read')->access() ){ ?>
                        <li><a class="menu-item <?=($path=='employee/contant/list')?'active':'';?>" href="<?=base_url('/employee/contant/list')?>"><i class="ft-aperture"></i><span data-i18n="employee_contant_list">Contant List</span>
                            <span class="badge badge badge-info float-right mr-2"><?=(count($countdocu)>0)?count($countdocu):""?></span>
                        </a>
                        </li>
                    <?php } if($this->Permission1->method('/employee/by/department','read')->access() ){ ?>
                        <li><a class="menu-item <?=($path=='employee/by/department')?'active':'';?>" href="<?=base_url('/employee/by/department')?>"><i class="ft-codepen"></i><span data-i18n="employee_by_dept">By Department</span></a>
                        </li>
                    <?php } ?>
                    </ul>
                </li>
            <?php } if( $this->Permission1->method('/customer/register','read')->access() || $this->Permission1->method('/customer/list','read')->access() ){ ?>
                <li class="nav-item <?=($url=='customer')?'active':'';?>"><a href="javascript:void(0);"><i class="la la-user-secret"></i><span class="menu-title" data-i18n="Customers">Customers</span></a>
                    <ul class="menu-content">
                    <?php if($this->Permission1->method('/customer/register','create')->access() ){ ?>
                        <li><a class="menu-item <?=($path=='customer/register')?'active':'';?>" href="<?=base_url('/customer/register')?>"><i class="la la-user-plus"></i><span data-i18n="register_new">Register Customer</span></a>
                        </li>
                    <?php } if($this->Permission1->method('/customer/list','read')->access() ){ ?>
                        <li><a class="menu-item <?=($path=='customer/list')?'active':'';?>" href="<?=base_url('/customer/list')?>"><i class="la la-users"></i><span data-i18n="customer_list">Customers List</span></a>
                        </li>
                    <?php } ?>
                    </ul>
                </li>
            <?php } if( $this->Permission1->method('/vacation/applied/list','read')->access() || $this->Permission1->method('/vacation/approved/list','read')->access() || $this->Permission1->method('/vacation/rejected/list','read')->access() ){ ?>
                <li class="nav-item <?=($url == 'vacation') ? 'active' : '';?>"><a href="javascript:void(0);"><i class="la la-calendar"></i><span class="menu-title" data-i18n="Vacations">Vacations</span></a>
                    <ul class="menu-content">
                    <?php if($this->Permission1->method('/vacation/applied/list','read')->access()){ ?>
                        <li><a class="menu-item <?=($suburl == 'applied') ? 'active' : '';?>" href="<?=base_url('/vacation/applied/list')?>"><i class="la la-calendar-plus-o"></i><span data-i18n="vacation_applied_list">Applied List</span><span class="badge badge badge-info float-right mr-2"><?=(count($countapl)>0)?count($countapl):""?></span></a>
                        </li>
                    <?php } if($this->Permission1->method('/vacation/approved/list','read')->access()){ ?>
                        <li><a class="menu-item <?=($suburl == 'approved') ? 'active' : '';?>" href="<?=base_url('/vacation/approved/list')?>"><i class="la la-calendar-check-o"></i><span data-i18n="vacation_approved_list">Approved List</span></a>
                        </li>
                    <?php } if($this->Permission1->method('/vacation/rejected/list','read')->access()){ ?>
                        <li><a class="menu-item <?=($suburl == 'rejected') ? 'active' : '';?>" href="<?=base_url('/vacation/rejected/list')?>"><i class="la la-calendar-times-o"></i><span data-i18n="vacation_approved_list">Rejected List</span></a>
                        </li>
                    <?php } ?>
                    </ul>
                </li>
            <?php } if( $this->Permission1->method('/location/list','read')->access() ){ ?>
                <li class="nav-item <?=($url == 'location') ? 'active' : '';?>"><a href="javascript:void(0);"><i class="la la-sitemap"></i><span class="menu-title" data-i18n="Locations">Locations</span></a>
                    <ul class="menu-content">
                    <?php if($this->Permission1->method('/location/register','create')->access()){ ?>
                        <li><a class="menu-item <?=($path == 'location/register') ? 'active' : '';?>" href="<?=base_url('/location/register')?>"><i class="ft ft-plus"></i><span data-i18n="Location_create">Register Location</span></a>
                        </li>
                    <?php } if($this->Permission1->method('/location/list','read')->access()){ ?>
                        <li><a class="menu-item <?=($path == 'location/list') ? 'active' : '';?>" href="<?=base_url('/location/list')?>"><i class="ft ft-map"></i><span data-i18n="Location_list">Locations List</span></a>
                        </li>
                    <?php } ?>
                    </ul>
                </li>
            <?php } if( $this->Permission1->method('/item/list','read')->access() ){ ?>
                <li class="nav-item <?=($url == 'item') ? 'active' : '';?>"><a href="<?=base_url('/item/list')?>"><i class="mdi mdi-qrcode-scan"></i><span class="menu-title" data-i18n="item">Items</span></a>
                    <?php /* ?>
                    <ul class="menu-content">
                    <?php if($this->Permission1->method('/item/register','create')->access()){ ?>
                        <li><a class="menu-item <?=($path == 'item/register') ? 'active' : '';?>" href="<?=base_url('/item/register')?>"><i class="ft ft-plus"></i><span data-i18n="item_create">Register Item</span></a>
                        </li>
                    <?php } if($this->Permission1->method('/item/list','read')->access()){ ?>
                        <li><a class="menu-item <?=($path == 'item/list') ? 'active' : '';?>" href="<?=base_url('/item/list')?>"><i class="ft ft-map"></i><span data-i18n="item_list">Items List</span></a>
                        </li>
                    <?php } ?>
                    </ul>
                    <?php */ ?>
                </li>
            <?php } if( $this->Permission1->method('/machine/list','read')->access() ){ ?>
                <li class="nav-item <?=($url == 'machine') ? 'active' : '';?>"><a href="<?=base_url('/machine/list')?>"><i class="mdi mdi-blender"></i><span class="menu-title" data-i18n="machine">Machines</span></a>
                </li>
            <?php } if( $this->Permission1->method('/smartrequest/list','read')->access() ){ ?>
                <li class="nav-item <?=($url == 'smartrequest') ? 'active' : '';?>"><a href="<?=base_url('/smartrequest/list')?>"><i class="la la-paste"></i><span class="menu-title" data-i18n="smartrequest">S. Request</span></a>
                </li>
            <?php } ?>



            <?php if( $this->Permission1->method('/permission/users/list','read')->access() || $this->Permission1->method('/permission/module/list','read')->access() ){ ?>
                <li class="nav-item <?=($url == 'permission') ? 'active' : '';?>"><a href="javascript:void(0);"><i class="la la-unlock"></i><span class="menu-title" data-i18n="Permission">Permissions</span></a>
                    <ul class="menu-content">
                    <?php if($this->Permission1->method('/permission/users/list','read')->access()){ ?>
                        <li><a class="menu-item <?=($suburl == 'users') ? 'active' : '';?>" href="<?=base_url('/permission/users/list')?>"><i class="la la-street-view"></i><span data-i18n="permission_users_list">Users List</span></a>
                        </li>
                    <?php } if($this->Permission1->method('/permission/module/list','read')->access()){ ?>
                        <li><a class="menu-item <?=($suburl == 'module') ? 'active' : '';?>" href="<?=base_url('/permission/module/list')?>"><i class="la la-cogs"></i><span data-i18n="permission_modules_list">Modules List</span></a>
                        </li>
                    <?php } ?>
                    </ul>
                </li>
        <?php } ?>

            
                <li class=" nav-item"><a href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/documentation" target="_blank"><i class="mbri-file"></i><span class="menu-title" data-i18n="Document">Document</span></a>
                </li>
            </ul>
            <?php /* ?>

            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item <?=($url == 'dashboard') ? 'active' : '';?>">
                    <a href="<?=base_url('/dashboard')?>"><i class="mbri-desktop"></i><span class="menu-title">Dashboard</span></a>
                </li>
            <?php foreach ($modules as $menu) :?>
                <?php if ($menu['menu_id'] != $menu['menu_item_id']): ?>
                     <li class="nav-item <?=($url == $menu['mdescription']) ? 'active' : '';?>">
                        <a href="<?=base_url('/').$menu['mdirectory']?>"><i class="<?=$menu['micon']?>"></i>
                            <span class="menu-title"><?=$menu['mname']?></span>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item <?=($url == $menu['mdescription']) ? 'active' : '';?>">
                        <a href="javascript:void(0);">
                            <i class="<?=$menu['micon']?>"></i><span class="menu-title"><?=$menu['mname']?></span>
                        </a>
                        <ul class="menu-content">
                            <?php foreach ($sub_module as $smenu) :?>
                                <?php if ($menu['menu_id'] == $smenu['mid']): ?>
                                    <li><a class="menu-item <?=($path == $smenu['description']) ? 'active' : '';?>" href="<?=base_url('/').$smenu['directory']?>"><i class="<?=$smenu['icon']?>"></i><span><?=$smenu['name']?> List</span></a>
                                    </li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                    </li>
                <?php endif ?>
            <?php endforeach ?>
            </ul>
            <?php */ ?>
        </div>
    </div>