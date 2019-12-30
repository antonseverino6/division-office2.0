<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('userHas-record', 'API\UserController@hasRecord');
Route::get('userHas-MoreRecord', 'API\UserController@moreDetailsHasRecord');
Route::get('get-user', 'API\UserController@getUser');
Route::get('user-profile', 'API\UserController@userProfile');
Route::get('user-more-details', 'API\UserController@userMoreDetails');
Route::resource('users','API\UserController');
Route::get('user-header', 'API\UserController@headerProfile');
Route::resource('representatives', 'API\RepresentativesController');
Route::resource('subjects', 'API\SubjectsController');
Route::resource('areas', 'API\AreasController');
Route::resource('components', 'API\ComponentsController');
Route::resource('typeOfEmployees', 'API\TypeOfEmployeesController');
Route::resource('employeeBase', 'API\EmployeeBaseController');
Route::resource('positions', 'API\PositionsController');
Route::patch('linkSubject/{position}', 'API\PositionsController@link_subject');
Route::resource('levelsOfCivil', 'API\LevelsOfCivilsController');
Route::resource('grade-levels', 'API\GradeLevelsController');
Route::resource('employment-status', 'API\EmploymentStatusController');
Route::resource('civil-status', 'API\CivilStatusController');
Route::resource('employees','API\EmployeePersonalDetailsController');
Route::resource('more-details','API\MoreDetailsController');
// Route::get('users', 'API\UserController');