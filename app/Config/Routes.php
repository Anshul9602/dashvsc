<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin\Auth::login');

// Public routes
$routes->group('admin', function($routes) {
    $routes->get('login', 'Admin\Auth::login');
    $routes->post('login', 'Admin\Auth::attemptLogin');
});

   // Protected routes
    $routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard/(:segment)', 'Admin\Dashboard::index/$1');
    $routes->get('spreadsheets/(:segment)', 'Admin\Dashboard::hr/$1');
    $routes->get('dashboard/calendar/(:segment)', 'Admin\Dashboard::calendar/$1');
    $routes->get('dashboard/calendar_table/(:segment)', 'Admin\Dashboard::calendar_table/$1');
    $routes->post('dashboard/calendar_task_save/(:segment)', 'Admin\Dashboard::calendar_save/$1');
    $routes->post('dashboard/calendar_task_update/(:segment)', 'Admin\Dashboard::calendar_update/$1');
    $routes->post('dashboard/calendar_task_delete/(:segment)', 'Admin\Dashboard::calendar_delete/$1');
    $routes->post('dashboard/calendar_task_complte/(:segment)', 'Admin\Dashboard::calendar_complte/$1');
    $routes->post('dashboard/calendar_task_comment/(:segment)', 'Admin\Dashboard::calendar_comment/$1');
    $routes->get('logout', 'Admin\Auth::logout');

  // Candidate routes
  $routes->get('candidates/(:segment)', 'Admin\Candidates\Candidates::listAllCandidates/$1');
  $routes->get('candidates/candidates_form/(:segment)', 'Admin\Candidates\Candidates::addCandidate/$1');
  $routes->post('candidates/candidates_form/(:segment)', 'Admin\Candidates\Candidates::listCandidate_save/$1');
  $routes->get('candidates/candidates_form_value/(:num)', 'Admin\Candidates\Candidates::listCandidate_getByid/$1');
  $routes->get('candidates/view/(:num)/(:segment)', 'Admin\Candidates\Candidates::listAllCandidates/$1');
  $routes->post('candidates/view/delete/(:num)', 'Admin\Candidates\Candidates::listCandidate_delete/$1');
  $routes->post('catalog/category_form/(:segment)', 'Admin\Category\Category::listAllCategory_Form_save/$1');
  $routes->post('candidates/view/status_update/(:num)', 'Admin\Candidates\Candidates::listCandidate_status/$1');
  $routes->get('candidates/view/getbyid/(:num)', 'Admin\Candidates\Candidates::listCandidate_getByid/$1');
 

  // Category routes
  $routes->get('category/(:segment)', 'Admin\Category\Category::listAllCategory/$1');
  $routes->get('category_export/(:segment)', 'Admin\Category\Category::listAllCategory_export/$1');
  $routes->get('category/category_form/(:segment)', 'Admin\Category\Category::listAllCategory_Form/$1');
  $routes->post('catalog/category_form_save/(:segment)', 'Admin\Category\Category::listAllCategory_Form_save/$1');
  $routes->get('cat/category_form_value/(:num)', 'Admin\Category\Category::listAllcat_Form_value/$1');
  $routes->post('cat/category_status/(:num)', 'Admin\Category\Category::listcat_status/$1');
  $routes->get('cat/category_delete/(:num)', 'Admin\Category\Category::listcat_delete/$1');
  $routes->get('catalog/category_list/(:segment)', 'Admin\Category\Category::listAllCategory_list/$1');
  
  
  $routes->post('candidates/view/delete/(:num)', 'Admin\Candidates\Candidates::listCandidate_delete/$1');
  $routes->post('candidates/view/save', 'Admin\Candidates\Candidates::listCandidate_save');
  $routes->post('candidates/view/status_update/(:num)', 'Admin\Candidates\Candidates::listCandidate_status/$1');
  $routes->get('candidates/view/getbyid/(:num)', 'Admin\Candidates\Candidates::listCandidate_getByid/$1');
  $routes->get('candidates/view_app/getbyid/(:num)', 'Admin\Candidates\Candidates::listCandidate_app_getByid/$1');

  // Role routes
  
  $routes->get('roles/(:segment)', 'Admin\Role\Role::listAllRoles/$1');
  $routes->get('role/role_form/(:segment)', 'Admin\Role\Role::listAllRole_Form/$1');
  $routes->post('role/role_status/(:num)', 'Admin\Role\Role::listRole_status/$1');
  $routes->get('role/role_form_value/(:num)', 'Admin\Role\Role::listAllRole_Form_value/$1');
  $routes->get('role/role_delete/(:num)', 'Admin\Role\Role::listRole_delete/$1');
  $routes->post('role/role_form/(:segment)', 'Admin\Role\Role::listRole_save/$1');


// hr routes
$routes->get('hr/(:segment)', 'Admin\Hr\Hr::listAllHr_policies1/$1');
$routes->get('hr_policies/(:segment)', 'Admin\Hr\Hr::listAllHr_policies/$1');
$routes->get('hr_policies/hr_form/(:segment)', 'Admin\Hr\Hr::listAllHr_form/$1');
  $routes->get('hr_policies/view/(:num)/(:segment)', 'Admin\Hr\Hr::listAllHr_policie/$1');
  $routes->get('hr/hr_delete/(:num)', 'Admin\Hr\Hr::listHr_delete/$1');
  $routes->get('hr/hr_form_value/(:num)', 'Admin\Hr\Hr::listAllHr_form_value/$1');
  $routes->post('hr_policies/hr_form/(:segment)', 'Admin\Hr\Hr::listHr_save/$1');
  $routes->post('hr_policies/status_update/(:num)', 'Admin\Hr\Hr::listHr_status/$1');
  $routes->get('hr_policies/view/getbyid/(:num)', 'Admin\Hr\Hr::listHr_getByid/$1');


// Hr Notice Borad

  $routes->get('hr_notice/(:segment)', 'Admin\Hr\Hr_notice::listAllHr_notice1/$1');
  $routes->get('hr_notice/hr_form/(:segment)', 'Admin\Hr\Hr_notice::listAllHr_form/$1');
  $routes->get('hr_policies/view/(:num)/(:segment)', 'Admin\Hr\Hr_notice::listAllHr_policie/$1');
  $routes->get('hr_notice/hr_delete/(:num)', 'Admin\Hr\Hr_notice::listHr_delete/$1');
  $routes->get('hr_notice/hr_form_value/(:num)', 'Admin\Hr\Hr_notice::listAllHr_form_value/$1');
  $routes->post('hr_notice/hr_form/(:segment)', 'Admin\Hr\Hr_notice::listHr_save/$1');
  $routes->post('hr_notice/status_update/(:num)', 'Admin\Hr\Hr_notice::listHr_status/$1');
  $routes->get('hr_notice/view/getbyid/(:num)', 'Admin\Hr\Hr_notice::listHr_getByid/$1');


 

// Reports routes
$routes->get('reports/(:segment)', 'Admin\Reports\Reports::listAllReports/$1');



  // Settings routes
   $routes->get('settings/(:segment)', 'Admin\Settings::index/$1');
   $routes->get('settings/listAdmins/(:segment)', 'Admin\Settings::listAdmins/$1');
   $routes->post('settings/storeAdmin', 'Admin\Settings::storeAdmin');
   $routes->get('settings/editAdmin/(:num)', 'Admin\Settings::editAdmin/$1');
   $routes->post('settings/updateAdmin/(:num)', 'Admin\Settings::updateAdmin/$1');
   $routes->post('settings/deleteAdmin/(:num)', 'Admin\Settings::deleteAdmin/$1');
    
   // API Users Sheet
   $routes->get('category/unit_product_form/(:segment)', 'Admin\Category\Category::listAllunit_product_form/$1');
   $routes->get('category/unit_product_list/(:segment)', 'Admin\Category\Category::listAllunit_product_list/$1');
   $routes->get('category/unit_sheet_list/(:segment)', 'Admin\Category\Category::listAllunit_product_list_card/$1');
   $routes->post('sheet_form/(:segment)', 'Admin\Category\Category::listAllunit_product_list_save/$1');
   $routes->post('sheet_form_update/(:segment)', 'Admin\Category\Category::listAllunit_product_list_update/$1');
   $routes->get('category/sheet_delete/(:num)', 'Admin\Category\Category::listSheet_delete/$1');
   $routes->get('category/sheet_value/(:num)', 'Admin\Category\Category::listAllSheet_value/$1');
   $routes->post('category/sheet_permission/(:segment)', 'Admin\Category\Category::sheet_permission/$1');
   $routes->post('category/sheet_status/(:num)', 'Admin\Category\Category::listSheet_status/$1');
   
   // Additional settings routes
   $routes->get('settings/listDataMaster/(:segment)', 'Admin\Settings::listDataMaster/$1');




$routes->post('create-google-sheet/(:segment)', 'GoogleSheetController::createSheet');
$routes->get('sheet_view/(:num)', 'Admin\Category\Category::listAllSheet_View/$1');
});
