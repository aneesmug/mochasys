<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/login', 'Page::index', ['filter' => 'guest']);
$routes->post('/login', 'User::login', ['filter' => 'guest']);

/*$routes->get('/register', 'Page::employee_register', ['filter' => 'guest']);
$routes->post('/register', 'User::register', ['filter' => 'guest']);*/

$routes->match(['get','post'], 'register', 'User::register', ['filter' => 'guest']);

$routes->group('', ['filter'=>'isLoggedIn'], function ($routes) {
	$routes->get('/logout', 'User::logout');
	// $routes->get('/', 'Dashboard::dashboardView', ['filter' => 'guest'/*,'noreturn'*/]);
	//Dashboard
	$routes->get('/', 'Dashboard::dashboardView');
	$routes->get('/dashboard', 'Dashboard::index');
	//Employee handling
	$routes->post('/employee/getEmployeeIDExp', 'Employee::getEmployeeIDExp');
	$routes->post('/employee/getSection', 'Employee::getSection');
	$routes->post('/employee/delete/(:num)', 'Employee::delete/$1');
	$routes->get('/employee/view/(:num)', 'Employee::view/$1');
	$routes->post('/employee/edit/(:num)', 'Employee::edit/$1');
	$routes->get('/employee/edit/(:num)', 'Employee::edit/$1');
	$routes->get('/employee/list', 'Employee::list');
	$routes->get('/employee/register', 'Employee::register');
	$routes->post('/employee/register', 'Employee::register');
	$routes->get('/employee/find', 'Employee::find');
	$routes->post('/employee/upload/(:num)', 'Employee::upload/$1');
	$routes->get('/employee/contant/list', 'Employee::tempContant');
	$routes->get('/employee/contant/register', 'Employee::contantRegister');
	$routes->post('/employee/storeFile/(:num)', 'Employee::storeFile/$1');
	$routes->get('/employee/by/department', 'Employee::employeeByDepartment');
	$routes->get('/employeedash', 'User::view');
	$routes->get('/employee/profile/edit', 'User::edit');
	$routes->get('/employee/profile/edit', 'User::edit');
	$routes->post('/employee/profile/edit', 'User::edit');
	$routes->post('/employee/contantStatus/(:num)', 'Employee::contantStatus/$1');
	//Customer handling
	$routes->get('/customer/list', 'Customer::index');
	$routes->get('/customer/getCustomers', 'Customer::getCustomers');
	/*$routes->get('/customer/getCustomers', 'Customer::getCustomers', ['as'=>'get.all.customers']);*/
	$routes->post('/customer/delete/(:num)', 'Customer::delete/$1');
	$routes->get('/customer/register', 'Customer::register');
	$routes->post('/customer/register', 'Customer::register');
	$routes->post('/customer/edit/(:num)', 'Customer::edit/$1');
	$routes->get('/customer/edit/(:num)', 'Customer::edit/$1');
	$routes->get('/customer/view/(:num)', 'Customer::view/$1');
	$routes->post('/customer/view/(:num)', 'Customer::update_card/$1');
	$routes->post('/customer/delete_card/(:num)', 'Customer::delete_card/$1');
	//Employee Vacation handling
	$routes->post('/vacation/register/(:num)', 'Vacation::register/$1');
	$routes->get('/vacation/applied/list', 'Vacation::list');
	$routes->get('/vacation/approved/list', 'Vacation::list');
	$routes->get('/vacation/rejected/list', 'Vacation::list');
	$routes->post('/vacation/delete_vac/(:num)', 'Vacation::delete_vac/$1');
	$routes->post('/vacation/updatehr/(:num)', 'Vacation::updateHr/$1');
	$routes->get('/vacation/view/(:num)', 'Vacation::view/$1');
	$routes->post('/vacation/apply', 'User::applyVac');
	$routes->get('/vacation/apply', 'User::applyVac');
	$routes->get('/vacation/list', 'Vacation::list');
	//Permission handling
	$routes->get('/permission/users/list', 'RolePermission::userslist');
	$routes->get('/permission/edit/(:num)', 'RolePermission::update/$1');
	$routes->post('/permission/update/(:num)', 'RolePermission::update/$1');
	$routes->post('/permission/user/delete/(:num)', 'RolePermission::delete_user/$1');
	$routes->post('/permission/secrole/edit', 'RolePermission::secEdit');
	$routes->post('/permission/secrole/add', 'RolePermission::secAdd');
	$routes->get('/permission/secrole/delete/(:num)', 'RolePermission::role_delete/$1');
	$routes->post('/permission/secrole/useredit', 'RolePermission::userEdit');
	$routes->get('/permission/module/list', 'RolePermission::modules');
	$routes->post('/permission/module/moduleedit', 'RolePermission::moduleEdit');
	$routes->post('/permission/module/submoduleedit', 'RolePermission::subModuleEdit');
	$routes->post('/permission/module/moduleadd', 'RolePermission::moduleAdd');
	$routes->post('/permission/module/submoduleadd', 'RolePermission::subModuleAdd');
	$routes->get('/permission/module/moduledelete/(:num)', 'RolePermission::moduleDelete/$1');
	$routes->get('/permission/module/submoduledelete/(:num)', 'RolePermission::subModuleDelete/$1');
	$routes->post('/permission/user/edit/password', 'User::updatePassword');

	//Location handling
	$routes->get('/location/list', 'Location::locationList');
	$routes->match(['get','post'], '/location/register', 'Location::registerLocation');
	$routes->match(['get','post'], '/location/edit/(:num)', 'Location::editLocation/$1');
	$routes->post('/location/delete/(:num)', 'Location::deleteLocation/$1');
	$routes->get('/location/view/(:num)', 'Location::view/$1');
	$routes->post('/location/registerContract/(:num)', 'Location::registerContract/$1');
	$routes->post('/location/uploadImg/(:num)', 'Location::uploadImg/$1');
	$routes->get('/location/loadmachines/(:num)', 'Location::loadMachines/$1');
	$routes->post('/location/transToLoc', 'Location::transferToLocation');
	$routes->post('/location/statusLocat', 'Location::statusLocat');
	$routes->post('/location/contract/edit', 'Location::contractEdit');

	//Item Menu handling
	$routes->get('/item/list', 'Item::items_list');
	$routes->match(['get','post'], '/item/edit/category', 'Item::categoryEdit');
	$routes->match(['get','post'], '/item/edit', 'Item::itemEdit');
	$routes->match(['get','post'], '/item/category/register', 'Item::categoryAdd');
	$routes->post('/item/delete/category/(:num)', 'Item::categoryDelete/$1');
	$routes->post('/item/delete/(:num)', 'Item::itemDelete/$1');
	$routes->match(['get','post'], '/item/register', 'Item::itemAdd');
	//Machines handling
	$routes->get('/machine/list', 'Machine::machineList');
	$routes->match(['get','post'], '/item/brand/register/', 'Machine::brandAdd');
	$routes->post('/machine/delete/(:num)', 'Machine::machineDelete/$1');
	$routes->match(['get','post'], '/machine/edit', 'Machine::machineEdit');
	$routes->match(['get','post'], '/machine/register/', 'Machine::machineAdd');
	$routes->post('/machine/delete/invno/(:any)', 'Machine::invDelete/$1');
	$routes->get('/machine/view/(:num)', 'Machine::view/$1');
	$routes->post('/machine/add/inv/', 'Machine::invAdd');
	$routes->post('/machine/transfer/', 'Machine::transferAdd');
	$routes->get('/machine/invoice/view/(:any)', 'Machine::viewInvoice/$1');
	//Smart Request handling
	$routes->get('/smartrequest/list', 'SmartRequest::smartrequestList');
	$routes->match(['get','post'], '/smart/request/create/(:any)', 'SmartRequest::mrequestAdd/$1');
	$routes->match(['get','post'], '/smart/request/view/(:any)', 'SmartRequest::mrequestView/$1');
	$routes->post('/smartrequest/delete/(:any)', 'SmartRequest::requestDelete/$1');
	$routes->post('/smartrequest/attach/upload', 'SmartRequest::fileUpload');

});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
