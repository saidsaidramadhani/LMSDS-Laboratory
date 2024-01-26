<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 
 
$routes->setDefaultController('Auth');
$routes->get('/', 'Auth::index');
$routes->match(['get', 'post'], 'check', 'Auth::check');
$routes->match(['get', 'post'], 'log', 'Auth::log');
$routes->match(['get', 'post'], 'auth/logout', 'Auth::logout');
$routes->match(['get', 'post'], 'admin/dashboard', 'Admin\Dashboard::index');
$routes->match(['get', 'post'], 'Prog_offered', 'mo_dept\Prog_offered::index');
$routes->match(['get', 'post'], 'systems', 'Admin\Systems::index');
$routes->match(['get', 'post'], 'systems/ajax_update', 'Admin\Systems::ajax_update');
$routes->match(['get', 'post'], 'systems/ajax_edit', 'Admin\Systems::ajax_edit');
$routes->match(['get', 'post'], 'systems/ajax_edit/(:num)', 'Admin\Systems::ajax_edit/$1');
$routes->match(['get', 'post'], 'systems/delete/(:num)', 'Admin\Systems::delete/$1');
//$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard/hr_dashboard', 'Dashboard::hr_dashboard');

$routes->match(['get', 'post'], 'schools', 'Admin\Schools::index');
$routes->match(['get', 'post'], 'schools/ajax_update', 'Admin\Schools::ajax_update');
$routes->match(['get', 'post'], 'schools/ajax_edit', 'Admin\Schools::ajax_edit');
$routes->match(['get', 'post'], 'schools/ajax_edit/(:num)', 'Admin\Schools::ajax_edit/$1');
$routes->match(['get', 'post'], 'schools/delete/(:num)', 'Admin\Schools::delete/$1');

$routes->match(['get', 'post'], 'laboratories', 'Admin\Laboratories::index');
$routes->match(['get', 'post'], 'laboratories/ajax_update', 'Admin\Laboratories::ajax_update');
$routes->match(['get', 'post'], 'laboratories/ajax_edit', 'Admin\Laboratories::ajax_edit');
$routes->match(['get', 'post'], 'laboratories/ajax_edit/(:num)', 'Admin\Laboratories::ajax_edit/$1');
$routes->match(['get', 'post'], 'laboratories/delete/(:num)', 'Admin\Laboratories::delete/$1');

$routes->match(['get', 'post'], 'sections', 'Admin\Sections::index');
$routes->match(['get', 'post'], 'sections/ajax_update', 'Admin\Sections::ajax_update');
$routes->match(['get', 'post'], 'sections/ajax_edit', 'Admin\Sections::ajax_edit');
$routes->match(['get', 'post'], 'sections/ajax_edit/(:num)', 'Admin\Sections::ajax_edit/$1');
$routes->match(['get', 'post'], 'sections/delete/(:num)', 'Admin\Sections::delete/$1');

$routes->match(['get', 'post'], 'item_locations', 'Admin\ItemLocations::index');
$routes->match(['get', 'post'], 'item_locations/ajax_update', 'Admin\ItemLocations::ajax_update');
$routes->match(['get', 'post'], 'item_locations/ajax_edit', 'Admin\ItemLocations::ajax_edit');
$routes->match(['get', 'post'], 'item_locations/ajax_edit/(:num)', 'Admin\ItemLocations::ajax_edit/$1');
$routes->match(['get', 'post'], 'item_locations/delete/(:num)', 'Admin\ItemLocations::delete/$1');

$routes->match(['get', 'post'], 'item_types', 'Admin\ItemTypes::index');
$routes->match(['get', 'post'], 'item_types/ajax_update', 'Admin\ItemTypes::ajax_update');
$routes->match(['get', 'post'], 'item_types/ajax_edit', 'Admin\ItemTypes::ajax_edit');
$routes->match(['get', 'post'], 'item_types/ajax_edit/(:num)', 'Admin\ItemTypes::ajax_edit/$1');
$routes->match(['get', 'post'], 'item_types/delete/(:num)', 'Admin\ItemTypes::delete/$1');

$routes->match(['get', 'post'], 'items', 'Admin\Items::index');
$routes->match(['get', 'post'], 'items/ajax_update', 'Admin\Items::ajax_update');
$routes->match(['get', 'post'], 'items/ajax_edit', 'Admin\Items::ajax_edit');
$routes->match(['get', 'post'], 'items/ajax_edit/(:num)', 'Admin\Items::ajax_edit/$1');
$routes->match(['get', 'post'], 'items/delete/(:num)', 'Admin\Items::delete/$1');

$routes->match(['get', 'post'], 'services', 'Admin\Services::index');
$routes->match(['get', 'post'], 'services/ajax_update', 'Admin\Services::ajax_update');
$routes->match(['get', 'post'], 'services/ajax_edit', 'Admin\Services::ajax_edit');
$routes->match(['get', 'post'], 'services/ajax_edit/(:num)', 'Admin\Services::ajax_edit/$1');
$routes->match(['get', 'post'], 'services/delete/(:num)', 'Admin\Services::delete/$1');


$routes->match(['get', 'post'], 'user_types', 'Admin\UserTypes::index');
$routes->match(['get', 'post'], 'user_types/ajax_update', 'Admin\UserTypes::ajax_update');
$routes->match(['get', 'post'], 'user_types/ajax_edit', 'Admin\UserTypes::ajax_edit');
$routes->match(['get', 'post'], 'user_types/ajax_edit/(:num)', 'Admin\UserTypes::ajax_edit/$1');
$routes->match(['get', 'post'], 'user_types/delete/(:num)', 'Admin\UserTypes::delete/$1');

$routes->match(['get', 'post'], 'roles', 'Admin\Roles::index');
$routes->match(['get', 'post'], 'roles/ajax_update', 'Admin\Roles::ajax_update');
$routes->match(['get', 'post'], 'roles/role_update', 'Admin\Roles::role_update');
$routes->match(['get', 'post'], 'roles/ajax_edit', 'Admin\Roles::ajax_edit');
$routes->match(['get', 'post'], 'roles/edit_role', 'Admin\Roles::edit_role');
$routes->match(['get', 'post'], 'roles/ajax_edit/(:num)', 'Admin\Roles::ajax_edit/$1');
$routes->match(['get', 'post'], 'roles/edit_role/(:num)', 'Admin\Roles::edit_role/$1');
$routes->match(['get', 'post'], 'roles/delete/(:num)', 'Admin\Roles::delete/$1');

$routes->match(['get', 'post'], 'permissions', 'Admin\Permissions::index');
$routes->match(['get', 'post'], 'permissions/ajax_update', 'Admin\Permissions::ajax_update');
$routes->match(['get', 'post'], 'permissions/ajax_edit', 'Admin\Permissions::ajax_edit');
$routes->match(['get', 'post'], 'permissions/ajax_edit/(:num)', 'Admin\Permissions::ajax_edit/$1');
$routes->match(['get', 'post'], 'permissions/delete/(:num)', 'Admin\Permissions::delete/$1');

$routes->match(['get', 'post'], 'users', 'Admin\Users::index');
$routes->match(['get', 'post'], 'users/ajax_update', 'Admin\Users::ajax_update');
$routes->match(['get', 'post'], 'users/ajax_edit', 'Admin\Users::ajax_edit');
$routes->match(['get', 'post'], 'users/ajax_edit/(:num)', 'Admin\Users::ajax_edit/$1');
$routes->match(['get', 'post'], 'users/delete/(:num)', 'Admin\Users::delete/$1');

$routes->match(['get', 'post'], 'samples', 'Client\Samples::index');
$routes->match(['get', 'post'], 'samples/ajax_update', 'Client\Samples::ajax_update');
$routes->match(['get', 'post'], 'samples/ajax_edit', 'Client\Samples::ajax_edit');
$routes->match(['get', 'post'], 'samples/ajax_edit/(:num)', 'Client\Samples::ajax_edit/$1');
$routes->match(['get', 'post'], 'samples/delete/(:num)', 'Client\Samples::delete/$1');


$routes->match(['get', 'post'], 'equipments', 'Manager\Equipments::index');
$routes->match(['get', 'post'], 'equipments/ajax_update', 'Manager\Equipments::ajax_update');
$routes->match(['get', 'post'], 'equipments/ajax_edit', 'Manager\Equipments::ajax_edit');
$routes->match(['get', 'post'], 'equipments/ajax_edit/(:num)', 'Manager\Equipments::ajax_edit/$1');
$routes->match(['get', 'post'], 'equipments/delete/(:num)', 'Manager\Equipments::delete/$1');

$routes->match(['get', 'post'], 'equipment_types', 'Manager\EquipmentTypes::index');
$routes->match(['get', 'post'], 'equipment_types/ajax_update', 'Manager\EquipmentTypes::ajax_update');
$routes->match(['get', 'post'], 'equipment_types/ajax_edit', 'Manager\EquipmentTypes::ajax_edit');
$routes->match(['get', 'post'], 'equipment_types/ajax_edit/(:num)', 'Manager\EquipmentTypes::ajax_edit/$1');
$routes->match(['get', 'post'], 'equipment_types/delete/(:num)', 'Manager\EquipmentTypes::delete/$1');

$routes->match(['get', 'post'], 'inventories', 'Manager\Inventories::index');
$routes->match(['get', 'post'], 'inventories/ajax_update', 'Manager\Inventories::ajax_update');
$routes->match(['get', 'post'], 'inventories/ajax_edit', 'Manager\Inventories::ajax_edit');
$routes->match(['get', 'post'], 'inventories/ajax_edit/(:num)', 'Manager\Inventories::ajax_edit/$1');
$routes->match(['get', 'post'], 'inventories/delete/(:num)', 'Manager\Inventories::delete/$1');

$routes->match(['get', 'post'], 'suppliers', 'Manager\Suppliers::index');
$routes->match(['get', 'post'], 'suppliers/ajax_update', 'Manager\Suppliers::ajax_update');
$routes->match(['get', 'post'], 'suppliers/ajax_edit', 'Manager\Suppliers::ajax_edit');
$routes->match(['get', 'post'], 'suppliers/ajax_edit/(:num)', 'Manager\Suppliers::ajax_edit/$1');
$routes->match(['get', 'post'], 'suppliers/delete/(:num)', 'Manager\Suppliers::delete/$1');


$routes->match(['get', 'post'], 'borrows', 'Client\Borrows::index');
$routes->match(['get', 'post'], 'borrows/ajax_update', 'Client\Borrows::ajax_update');
$routes->match(['get', 'post'], 'borrows/ajax_edit', 'Client\Borrows::ajax_edit');
$routes->match(['get', 'post'], 'borrows/ajax_edit/(:num)', 'Client\Borrows::ajax_edit/$1');
$routes->match(['get', 'post'], 'borrows/delete/(:num)', 'Client\Borrows::delete/$1');

$routes->match(['get', 'post'], 'borrowings', 'Client\Borrowings::index');
$routes->match(['get', 'post'], 'borrowings/ajax_update', 'Client\Borrowings::ajax_update');
$routes->match(['get', 'post'], 'borrowings/ajax_edit', 'Client\Borrowings::ajax_edit');
$routes->match(['get', 'post'], 'borrowings/ajax_edit/(:num)', 'Client\Borrowings::ajax_edit/$1');
$routes->match(['get', 'post'], 'borrowings/delete/(:num)', 'Client\Borrowings::delete/$1');


$routes->match(['get', 'post'], 'registrations', 'Client\Registrations::index');

$routes->add('logout', 'Auth::logout');

service('auth')->routes($routes);

