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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'admin';

// Topics
$route['topics/index'] = 'topics/index';
$route['topics/create'] = 'topics/create';
$route['topics/filter'] = 'topics/filter';
$route['topics/edit/(:any)'] = 'topics/edit/$1';
$route['topics/edit'] = 'topics/edit';
$route['topics/delete/(:any)'] = 'topics/delete/$1';
$route['topics/(:any)'] = 'topics/view/$1';

// Topic Types
$route['topic-types'] = 'topicTypes/index';
$route['topic-types/index'] = 'topicTypes/index';
$route['topic-types/create'] = 'topicTypes/create';
$route['topic-types/filter'] = 'topicTypes/filter';
$route['topic-types/edit/(:any)'] = 'topicTypes/edit/$1';
$route['topic-types/edit'] = 'topicTypes/edit';
$route['topic-types/delete/(:any)'] = 'topicTypes/delete/$1';
$route['topic-types/(:any)'] = 'topicTypes/view/$1';

// Document Types
$route['document-types'] = 'documentTypes/index';
$route['document-types/index'] = 'documentTypes/index';
$route['document-types/index/(:any)'] = 'documentTypes/index';
$route['document-types/filter'] = 'documentTypes/filter';
$route['document-types/create'] = 'documentTypes/create';
$route['document-types/edit/(:any)'] = 'documentTypes/edit/$1';
$route['document-types/edit'] = 'documentTypes/edit';
$route['document-types/delete/(:any)'] = 'documentTypes/delete/$1';
$route['document-types/(:any)'] = 'documentTypes/view/$1';
$route['document-types/view/(:any)'] = 'documentTypes/view/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
