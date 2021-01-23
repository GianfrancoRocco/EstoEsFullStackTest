<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProjectController::class, 'index']);
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/getProjects', [ProjectController::class, 'getProjects']);
Route::get('/projects/new', [ProjectController::class, 'new']);
Route::post('/projects/new', [ProjectController::class, 'save']);
Route::get('/projects/delete', [ProjectController::class, 'delete']);
Route::get('/projects/{id}', [ProjectController::class, 'edit']);
Route::post('/projects/{id}', [ProjectController::class, 'save']);

