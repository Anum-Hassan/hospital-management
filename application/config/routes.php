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
|	https://codeigniter.com/userguide3/general/routing.html
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

$route['default_controller'] = 'Hospital/login';
$route['dashboard'] = 'hospital/dashboard';
$route['register'] = 'hospital/register';
$route['login'] = 'hospital/login';
$route['doctors'] = 'hospital/doctors';
$route['staff'] = 'hospital/staff';
$route['patients'] = 'hospital/patients';
$route['schedule'] = 'hospital/schedule';
$route['departments'] = 'hospital/depart';
$route['appointments'] = 'hospital/appt';
$route['rooms'] = 'hospital/room';
$route['billing'] = 'hospital/bill';
$route['prescriptions'] = 'hospital/pres';
$route['users'] = 'hospital/users';
$route['contacts'] = 'hospital/contacts';


$route['manage-doctors'] = 'hospital/addDoctor';
$route['manage-staff'] = 'hospital/addStaff';
$route['manage-patients'] = 'hospital/addPatient';
$route['manage-schedule'] = 'hospital/addSchedule';
$route['manage-departments'] = 'hospital/addDepart';
$route['manage-appointments'] = 'hospital/addAppt';
$route['manage-rooms'] = 'hospital/addRoom';
$route['manage-billing'] = 'hospital/addBill';
$route['manage-prescriptions'] = 'hospital/addPres';
$route['manage-users'] = 'hospital/addUsers';
$route['manage-contacts'] = 'hospital/addContacts';
$route['generateBillingPdf/(:num)'] = 'Hospital/generateBillingPdf/$1';

$route['manage-medical-history/(:num)'] = 'Hospital/managePatientHistory/$1';

// $route['doctor/delete/(:any)/(:num)'] = 'hospital/deleteRecord/$1/$2';
// $route['staff/delete/(:any)/(:num)'] = 'hospital/deleteRecord/$1/$2';
// $route['patient/delete/(:any)/(:num)'] = 'hospital/deleteRecord/$1/$2';
// $route['department/delete/(:any)/(:num)'] = 'hospital/deleteRecord/$1/$2';
// $route['appointment/delete/(:any)/(:num)'] = 'hospital/deleteRecord/$1/$2';

$route['manage-doctors/(:num)'] = 'Hospital/editDoctor/$1';
$route['manage-staff/(:num)'] = 'Hospital/editStaff/$1';
$route['manage-patients/(:num)'] = 'Hospital/editPatient/$1';
$route['manage-departments/(:num)'] = 'Hospital/editDepart/$1';
$route['manage-schedule/(:num)'] = 'Hospital/editSchedule/$1';
$route['manage-appointments/(:num)'] = 'Hospital/editAppt/$1';
$route['manage-rooms/(:num)'] = 'Hospital/editRoom/$1';
$route['manage-billing/(:num)'] = 'Hospital/editBill/$1';
$route['manage-prescriptions/(:num)'] = 'Hospital/editPres/$1';
$route['manage-users/(:num)'] = 'Hospital/editUsers/$1';
$route['manage-Contacts/(:num)'] = 'Hospital/editContacts/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
