<?php


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::resource('/home', 'HomeController');
Route::resource('/users', 'UsersController');
//Route::post('/users', 'UsersController@destroy');
Route::resource('/roles', 'RolesController');
//Route::post('/roles', 'RolesController@destroy');
Route::resource('/permissions', 'PermissionsController');
//Route::post('/permissions', 'PermissionsController@destroy');
Route::resource('/medicines', 'MedicineController');
//Route::post('/medicines', 'MedicineController@destroy');
Route::resource('/specialties', 'SpecialtyController');
//Route::post('/specialties', 'SpecialtyController@destroy');
Route::resource('/citations', 'CitationController');
Route::resource('/records', 'RecordController');
Route::resource('/recipes', 'RecipeController');
Route::get('/roles/{id}/permissions','RolesController@permissions');
Route::put('/roles/{id}/assignpermissions','RolesController@assignpermissions');
Route::get('/users/{id}/permissions','UsersController@permissions');
Route::put('/users/{id}/assignpermissions','UsersController@asignarPermisos');