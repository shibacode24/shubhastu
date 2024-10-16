<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use Facade\FlareClient\Api;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('send_mobile_verify_otp',[ApiController::class,'send_mobile_verify_otp']);
Route::post('user_registration',[ApiController::class,'user_registration']);
Route::post('get_promotor_sale_report',[ApiController::class,'get_promotor_sale_report']);
Route::get('get_promotersale_all',[ApiController::class,'get_promotersale_all']);
Route::get('get_year_month',[ApiController::class,'get_year_month']);
Route::get('year',[ApiController::class,'year']);
Route::get('company',[ApiController::class,'company']);
Route::get('get_promotersale_month',[ApiController::class,'get_promotersale_month']);
Route::post('get_doctor_name',[ApiController::class,'get_doctor_name']);
Route::post('admin_login',[ApiController::class,'admin_login']);
Route::post('get_promotersale_all_data',[ApiController::class,'get_promotersale_all_data']);
Route::get('user_registration_for_data',[ApiController::class,'user_registration_for_data']);
Route::get('marque_msg',[ApiController::class,'marque_msg']);
Route::get('image',[ApiController::class,'image']);
Route::get('get_all_medical',[ApiController::class,'get_all_medical']);
Route::get('promotersalereport',[ApiController::class,'promotersalereport']);
Route::post('all_data',[ApiController::class,'all_data']);
Route::get('get_promotersale_summary_data',[ApiController::class,'get_promotersale_summary_data']);
Route::get('pdf',[ApiController::class,'pdf']);
Route::get('get_promotersale_summary_data_for_doctor',[ApiController::class,'get_promotersale_summary_data_for_doctor']);
Route::post('get_promotor_data_for_doctor',[ApiController::class,'get_promotor_data_for_doctor']);
Route::get('doctor_search_by_name',[ApiController::class,'doctor_search_by_name']);
Route::get('promotor_sale_report_data_by_psid',[ApiController::class,'promotor_sale_report_data_by_psid']);

Route::get('process_data', [ApiController::class, 'processData']);
Route::get('generateReport', [ApiController::class, 'generateReport']);
Route::get('pdf', [ApiController::class, 'pdf']);

Route::get('get_all_doctor', [ApiController::class, 'get_all_doctor']);

Route::get('doctor_report', [ApiController::class, 'doctor_report']);

