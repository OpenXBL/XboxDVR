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




/*
| -------------------------------------------------------------------------
| DEFAULT ROUTES
| -------------------------------------------------------------------------
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/*
| -------------------------------------------------------------------------
| OPENXBL LOGIN ROUTES
| -------------------------------------------------------------------------
*/
$route['auth/callback'] = 'auth/callback';
$route['auth/logout'] = 'auth/logout';


/*
| -------------------------------------------------------------------------
| LIBRARY ROUTES
| -------------------------------------------------------------------------
*/
$route['library/clips'] = 'library/clips';
$route['library/screenshots'] = 'library/screenshots';


/*
| -------------------------------------------------------------------------
| BROWSE BY GAME ROUTES
| -------------------------------------------------------------------------
*/
$route['browse'] = 'search';
$route['browse/(:num)'] = 'search/results/$1';


/*
| -------------------------------------------------------------------------
| API SERVICE ROUTES
| -------------------------------------------------------------------------
*/
$route['api/dvr/gameclips'] = 'ApiService/get_dvr_gameclips';
$route['api/dvr/screenshots'] = 'ApiService/get_dvr_screenshots';
$route['api/share'] = 'library/share';


/*
| -------------------------------------------------------------------------
| SHOWCASE ROUTES
| -------------------------------------------------------------------------
*/
$route['showcase'] = 'shares';
$route['showcase/(:num)'] = 'shares/item/$1';


/*
| -------------------------------------------------------------------------
| EXTRA ROUTES
| -------------------------------------------------------------------------
*/
$route['policy'] = 'home/policy';


/*
| -------------------------------------------------------------------------
| ADMIN ROUTES
| -------------------------------------------------------------------------
| Remember to disable migrations when you are not using them.
*/
$route['admin/migrate'] = 'migrate';