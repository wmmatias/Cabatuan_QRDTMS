<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'users';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['signin/validate'] = 'users/process_signin';

$route['dashboard'] = 'dashboards';
$route['dashboard/signoff'] = 'dashboards/logoff';
$route['dashboard/users'] = 'dashboards/users';
$route['dashboard/vendor'] = 'dashboards/vendor';
$route['dashboard/item'] = 'dashboards/item';
$route['dashboard/request'] = 'dashboards/request';
$route['dashboard/pr_details'] = 'dashboards/pr_details';
$route['dashboard/order'] = 'dashboards/order';
$route['dashboard/list_request'] = 'dashboards/list_request';
$route['dashboard/list_order'] = 'dashboards/list_order';
$route['dashboard/approval_request'] = 'dashboards/approval_request';
$route['dashboard/approval_order'] = 'dashboards/approval_order';
$route['dashboard/logs'] = 'dashboards/list_logs';
$route['dashboard/report'] = 'dashboards/report';

$route['users/block/(:any)'] = 'users/block/$1';
$route['users/unblock/(:any)'] = 'users/unblock/$1';
$route['users/edit/(:any)'] = 'users/edit/$1';
$route['users/profile/(:any)'] = 'users/profile/$1';
$route['users/credentials'] = 'users/edit_credentials';
$route['users/edit/(:any)/validate'] = 'users/process_user_modification';

$route['dashboard/add'] = 'dashboards/addusers';
$route['dashboard/create'] = 'users/process_registration';

$route['vendors/create'] = 'vendors/process_create';
$route['vendors/edit/(:any)'] = 'vendors/edit/$1';
$route['vendors/edit/(:any)/validate'] = 'vendors/validate_update';
$route['vendors/block/(:any)'] = 'vendors/block/$1';
$route['vendors/unblock/(:any)'] = 'vendors/unblock/$1';

$route['items/create'] = 'items/process_create';
$route['items/edit/(:any)'] = 'items/edit/$1';
$route['items/edit/(:any)/validate'] = 'items/validate_update';
$route['items/delete/(:any)'] = 'items/delete/$1';

$route['requests/items/(:any)'] = 'requests/process_create/$1';
$route['requests/view/(:any)'] = 'requests/view/$1';
$route['requests/cancel_requests/(:any)'] = 'requests/cancel_requests/$1';
$route['requests/qrcode/(:any)'] = 'requests/qrcode/$1';
$route['requests/approved/(:any)'] = 'requests/approved/$1';
$route['requests/disapproved/(:any)'] = 'requests/disapproved/$1';
$route['requests/approved_po/(:any)'] = 'requests/approved_po/$1';
$route['requests/disapproved_po/(:any)'] = 'requests/disapproved_po/$1';

$route['orders/view/(:any)'] = 'orders/view/$1';
$route['orders/view_docu/(:any)'] = 'orders/view_docu/$1';  
$route['orders/create_po'] = 'orders/create_po';