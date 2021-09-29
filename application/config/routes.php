<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['resources/index'] = 'resources/index';
$route['resources/create'] = 'resources/create';
$route['resources/show'] = 'resources/show';
$route['resources/statistics'] = 'resources/statistics';
$route['resources/saved_for_later'] = 'resources/saved_for_later';

$route['posts/create'] = 'posts/create';
$route['posts/update'] = 'posts/update';
$route['resources/(:any)'] = 'resources/view/$1';
$route['posts'] = 'posts/index';

$route['clients/login'] = 'clients/login';


$route['dashboard'] = 'dashboard/index';

$route['packages'] = 'packages/index';

$route['search'] = 'search/index';

$route['schools'] = 'schools/index';
$route['schools/index'] = 'schools/index';

$route['departments'] = 'departments/index';

$route['researchers'] = 'researchers/index';
$route['researchers/index'] = 'researchers/index';


$route['trips'] = 'trips/index';
$route['routes'] = 'routes/index';


$route['students'] = 'students/index';

$route['resources'] = 'resources/index';



$route['default_controller'] = 'pages/view';

$route['categories'] = 'categories/index';
$route['categories/create'] = 'categories/create';
$route['categories/posts/(:any)'] = 'categories/posts/$1';

$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
