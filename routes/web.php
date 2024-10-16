<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StockistController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\TdsController;
use App\Http\Controllers\AddcompanyController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\LinkStockistMedicalController;
use App\Http\Controllers\Addmedicinecontroller;
use App\Http\Controllers\PrimarySaleController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\AddedmedicineController;
use App\Http\Controllers\PromotorSaleController;
use App\Http\Controllers\SecondarySaleController;
use App\Http\Controllers\StokistAdjustmentIssueController;
use App\Http\Controllers\UpdatemedicineController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PromotersaleReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\New_Medicine_MasterController;
use App\Http\Controllers\NewPromotorSaleController;
use App\Http\Controllers\NewUpdateMedicineController;
use App\Http\Controllers\SecondarysaleReportController;
use App\Http\Controllers\BatchnoController;
use App\Http\Controllers\Profit_and_loss_Controller;
use App\Http\Controllers\EmployeregistrationController;
use App\Http\Controllers\ExpenceEntryController;
use App\Http\Controllers\MedicinesaleReportController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\TdsReportController;
use App\Models\EmployeRegister;
use App\Http\Controllers\ProfitlossController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdverbsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::view('/excel', 'excel');

Route::get('array_merge',[TdsReportController::class,'array_merge'])->name('array_merge');

Route::get('/',[UserController::class,'index'])->name('login');
Route::post('login_submit',[UserController::class,'check_login'])->name('login_submit');
Route::get('logout',[UserController::class,'log_out'])->name('logout');

Route::get('marketing_login_page',[UserController::class,'marketing_login_page'])->name('marketing_login_page');
Route::post('marketing_login_submit',[UserController::class,'marketing_login_submit'])->name('marketing_login_submit');
Route::get('marketing_log_out',[UserController::class,'marketing_log_out'])->name('marketing_log_out');

Route::group(['middleware'=>'CheckLogin'],function(){

//dashboard
Route::view('superadmin_dashboard','superadmin_dashboard')->name('superadmin_dashboard');
Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');

Route::post('assign_technician',[DashboardController::class,'assign_technician'])->name('assign_technician');
Route::get('destroy_dashboard/{id}',[DashboardController::class,'destroy'])->name('destroy_dashboard');

//Addcompany
Route::get('company',[AddcompanyController::class,'index'])->name('company');
Route::post('create-company',[AddcompanyController::class,'create'])->name('create-company');
Route::get('edit-company/{id}',[AddcompanyController::class,'edit'])->name('edit-company');
Route::post('update-company',[AddcompanyController::class,'update'])->name('update-company');
Route::get('destroy-company/{id}',[AddcompanyController::class,'destroy'])->name('destroy-company');

//city
Route::get('city',[CityController::class,'index'])->name('city');
Route::post('create_city',[CityController::class,'create'])->name('create_city');
Route::get('edit-city/{id}',[citycontroller::class,'edit'])->name('edit-city');
Route::post('update-city',[citycontroller::class,'update'])->name('update-city');
Route::get('destroy-city/{id}',[citycontroller::class,'destroy'])->name('destroy-city');

//stockist
Route::get('stockist',[StockistController::class,'index'])->name('stockist');
Route::post('create_stockist',[StockistController::class,'create'])->name('create_stockist');
Route::get('edit-stockist/{id}',[StockistController::class,'edit'])->name('edit-stockist');
Route::post('update-stockist',[StockistController::class,'update'])->name('update-stockist');
Route::get('destroy-stockist/{id}',[StockistController::class,'destroy'])->name('destroy-stockist');

//add_medical
Route::get('medical',[MedicalController::class,'index'])->name('medical');
Route::post('create_medical',[MedicalController::class,'create'])->name('create_medical');
Route::get('edit-medical/{id}',[MedicalController::class,'edit'])->name('edit-medical');
Route::post('update-medical',[MedicalController::class,'update'])->name('update-medical');
Route::get('destroy-medical/{id}',[MedicalController::class,'destroy'])->name('destroy-medical');

//marketing
Route::get('marketing',[MarketingController::class,'index'])->name('marketing');
Route::post('create_marketing',[MarketingController::class,'create'])->name('create_marketing');
Route::get('edit-marketing/{id}',[MarketingController::class,'edit'])->name('edit-marketing');
Route::post('update-marketing',[MarketingController::class,'update'])->name('update-marketing');
Route::get('destroy-marketing/{id}',[MarketingController::class,'destroy'])->name('destroy-marketing');

//add_doctor
Route::get('doctor',[DoctorController::class,'index'])->name('doctor');
Route::post('create_doctor',[DoctorController::class,'create'])->name('create_doctor');
Route::get('edit-doctor/{id}',[DoctorController::class,'edit'])->name('edit-doctor');
Route::post('update-doctor',[DoctorController::class,'update'])->name('update-doctor');
Route::get('destroy-doctor/{id}',[DoctorController::class,'destroy'])->name('destroy-doctor');
Route::get('password',[DoctorController::class,'password'])->name('password');

//year
Route::get('year',[YearController::class,'index'])->name('year');
Route::post('create_year',[YearController::class,'create'])->name('create_year');
Route::get('edit-year/{id}',[YearController::class,'edit'])->name('edit-year');
Route::post('update-year',[YearController::class,'update'])->name('update-year');
Route::get('destroy-year/{id}',[YearController::class,'destroy'])->name('destroy-year');

//tds
Route::get('tds',[TdsController::class,'index'])->name('tds');
Route::get('destroy_tds/{id}',[TdsController::class,'destroy'])->name('destroy-tds');
Route::post('create_tds',[TdsController::class,'update'])->name('create_tds');

//add_medicine
Route::get('medicine',[MedicineController::class,'index'])->name('medicine');
Route::post('create_medicine',[MedicineController::class,'create'])->name('create_medicine');
Route::get('edit-medicine/{id}',[MedicineController::class,'edit'])->name('edit-medicine');
Route::post('update-medicine',[MedicineController::class,'update'])->name('update-medicine');
Route::get('destroy-medicine/{id}',[MedicineController::class,'destroy'])->name('destroy-medicine');

//link_stockist_medical
Route::get('linkstockist',[LinkStockistMedicalController::class,'index'])->name('linkstockist');
Route::post('create_linkstockist',[LinkStockistMedicalController::class,'create'])->name('create_linkstockist');
Route::get('edit-linkstockist/{id}',[LinkStockistMedicalController::class,'edit'])->name('edit-linkstockist');
Route::post('update-linkstockist',[LinkStockistMedicalController::class,'update'])->name('update-linkstockist');
Route::get('destroy-linkstockist/{id}',[LinkStockistMedicalController::class,'destroy'])->name('destroy-linkstockist');



//medicine

Route::get('medicine_master',[Addmedicinecontroller::class,'index'])->name('medicine_master');

// Route::post('updatemedicinemasedit',[Addmedicinecontroller::class,'updatemedicineedit'])->name('updatemedicinemasedit');
// Route::get('updatemedicinemaster',[Addmedicinecontroller::class,'updatemedicinemas'])->name('updatemedicinemaster');
// Route::get('medicine_master1',[Addmedicinecontroller::class,'medlist'])->name('medicine_master1');
// Route::get('medicine_master1',[Addmedicinecontroller::class,'search'])->name('medicine_master1');
// Route::get('/search', 'SearchController@search')->name('search');
Route::post('create_medicinem',[Addmedicinecontroller::class,'create'])->name('create_medicinem');
Route::get('edit-medicinem/{id}',[Addmedicinecontroller::class,'edit'])->name('edit-medicinem');
// Route::post('update-medicinem',[Addmedicinecontroller::class,'update'])->name('update-medicinem');
Route::get('destroy-medicinem/{id}',[Addmedicinecontroller::class,'destroy'])->name('destroy-medicinem');

Route::get('get_medicine_from_company',[Addmedicinecontroller::class,'get_medicine_from_company'])->name('get_medicine_from_company');
Route::get('get_batch_from_medicine_company',[Addmedicinecontroller::class,'get_batch_from_medicine_company'])->name('get_batch_from_medicine_company');


//update_medicine
Route::post('updatemedicinemasedit',[UpdatemedicineController::class,'updatemedicineedit'])->name('updatemedicinemasedit');
Route::get('updatemedicinemaster',[UpdatemedicineController::class,'updatemedicinemas'])->name('updatemedicinemaster');
Route::get('getMed',[UpdatemedicineController::class,'getMedicine'])->name('getMed');
Route::get('get_batch_by_id1',[UpdatemedicineController::class,'batch1'])->name('get_batch_by_id1');
Route::get('get_mrppurchase_by_id',[UpdatemedicineController::class,'ptrmarket'])->name('get_mrppurchase_by_id');
// Route::post('updat-medicine',[UpdatemedicineController::class,'update'])->name('updat_medicine');


//primary_sale
Route::get('primary',[PrimarySaleController::class,'index'])->name('primary');
Route::post('create_primary',[PrimarySaleController::class,'create'])->name('create_primary');
Route::get('edit-primary/{id}',[PrimarySaleController::class,'edit'])->name('edit-primary');
Route::post('update-primary',[PrimarySaleController::class,'update'])->name('update-primary');
Route::get('destroy-primary/{id}',[PrimarySaleController::class,'destroy'])->name('destroy-primary');

//batch_no
Route::get('batch',[BatchController::class,'index'])->name('batch');
Route::post('create_batch',[BatchController::class,'create'])->name('create_batch');
Route::get('edit-batch/{id}',[BatchController::class,'edit'])->name('edit-batch');
Route::post('update-batch',[BatchController::class,'update'])->name('update-batch');
Route::get('destroy-batch/{id}',[BatchController::class,'destroy'])->name('destroy-batch');

//addedmecine
Route::get('addedmed',[AddedmedicineController::class,'index'])->name('addedmed');
Route::post('create_addedmedicine',[AddedmedicineController::class,'create'])->name('create_addedmedicine');

// Route::get('edit-addedmedicine/{id}',[AddedmedicineController::class,'edit'])->name('edit-addedmedicine');
// Route::post('update-addedmedicine',[AddedmedicineController::class,'update'])->name('update-addedmedicine');
Route::get('destroy-addedmedicine/{id}',[MedicineController::class,'destroy'])->name('destroy-addedmedicine');



// //promotor_sale
// Route::get('promotor',[PromotorSaleController::class,'index'])->name('promotor');
// Route::post('create_promotor',[PromotorSaleController::class,'create'])->name('create_promotor');
// Route::get('get_market_by_id',[PromotorSaleController::class,'market'])->name('get_market_by_id');
// Route::get('get_medical_by_id',[PromotorSaleController::class,'medical'])->name('get_medical_by_id');
// Route::get('get_medicine_by_id',[PromotorSaleController::class,'medicine'])->name('get_medicine_by_id');
// Route::get('get_ptrmarketing_by_id',[PromotorSaleController::class,'ptrmarket'])->name('get_ptrmarketing_by_id');
// Route::get('scheme_medicine',[PromotorSaleController::class,'scheme_medicine'])->name('scheme_medicine');
// Route::get('get_batch_by_id',[PromotorSaleController::class,'batch'])->name('get_batch_by_id');


// Route::get('scheme_medicine','Hello@scheme_medicine')->name('scheme_medicine');
// Route::get('get_qntymps_by_id',[PromotorSaleController::class,'qntymps'])->name('get_qntymps_by_id');


//promotor_sale
Route::get('promotor',[NewPromotorSaleController::class,'index'])->name('promotor');
Route::post('create_promotor',[NewPromotorSaleController::class,'create'])->name('create_promotor');
Route::get('get_market_by_id',[NewPromotorSaleController::class,'market'])->name('get_market_by_id');
Route::get('get_medical_by_id',[NewPromotorSaleController::class,'medical'])->name('get_medical_by_id');
// Route::get('get_medicine_by_id',[NewPromotorSaleController::class,'medicine'])->name('get_medicine_by_id');
Route::get('get_medicine_by_id2',[NewPromotorSaleController::class,'medicine2'])->name('get_medicine_by_id2');
Route::get('get_ptrmarketing_by_id',[NewPromotorSaleController::class,'ptrmarket'])->name('get_ptrmarketing_by_id');
Route::get('scheme_medicine',[NewPromotorSaleController::class,'scheme_medicine'])->name('scheme_medicine');
Route::get('get_batch_by_id',[NewPromotorSaleController::class,'batch'])->name('get_batch_by_id');
Route::get('get_previous_added_data',[NewPromotorSaleController::class,'get_previous_added_data'])->name('get_previous_added_data');



//secondary_sale
Route::get('secondary',[SecondarySaleController::class,'index'])->name('secondary');
Route::post('create-secondary',[SecondarySaleController::class,'create'])->name('create_secondary');
Route::get('get_medicine_by_id',[SecondarySaleController::class,'medicine'])->name('get_medicine_by_id');
Route::get('get_batch_no_by_id',[SecondarySaleController::class,'batchnocompany'])->name('get_batch_no_by_id');
Route::get('get_purchase_by_id',[SecondarySaleController::class,'purchase'])->name('get_purchase_by_id');

//stockist_issue
Route::get('stockist_issue',[StokistAdjustmentIssueController::class,'index'])->name('stockist_issue');
Route::get('get_scheme_by_id',[PromotorSaleController::class,'get_scheme'])->name('get_scheme_by_id');

//PromotersaleReport
Route::get('promotorreport',[PromotersaleReportController::class,'index'])->name('promotorreport');
Route::get('sale_entry_details',[PromotersaleReportController::class,'promotersalereport'])->name('sale_entry_details');
Route::get('market',[PromotersaleReportController::class,'marketing'])->name('market');
// Route::get('edit-promotorsalereport/{id}',[PromotersaleReportController::class,'editpromotorsalereport'])->name('edit-promotorsalereport');
// Route::post('update-promotorsalereport',[PromotersaleReportController::class,'updatepromotorsalereport'])->name('update-promotorsalereport');
Route::get('addsummary',[PromotersaleReportController::class,'addsummary'])->name('addsummary');
Route::get('pdf/{id}',[PromotersaleReportController::class,'pdf'])->name('pdf');
// Route::get('promotersledestroy',[PromotersaleReportController::class,'destroy'])->name('promotersledestroy');

//addmedicine_company_add
Route::post('create_company',[Addmedicinecontroller::class,'create_company'])->name('create_company');
Route::post('create_company_medicine',[Addmedicinecontroller::class,'create_company_medicine'])->name('create_company_medicine');
Route::post('create_batch_company',[Addmedicinecontroller::class,'create_batch_company'])->name('create_batch_company');



//promotor sale company modal add
Route::post('create_company_pro',[PromotorSaleController::class,'create_company_pro'])->name('create_company_pro');
Route::post('create_marketing_pro',[PromotorSaleController::class,'create_marketing_pro'])->name('create_marketing_pro');
Route::post('create_doctor_pro',[PromotorSaleController::class,'create_doctor_pro'])->name('create_doctor_pro');
Route::post('create_stockist_pro',[PromotorSaleController::class,'create_stockist_pro'])->name('create_stockist_pro');
Route::post('create_medical_pro',[PromotorSaleController::class,'create_medical_pro'])->name('create_medical_pro');
Route::post('create_medicine_pro',[PromotorSaleController::class,'create_medicine_pro'])->name('create_medicine_pro');



//promotor sale report mail
Route::post('mail',[PromotersaleReportController::class,'mail_and_downloadpdf'])->name('mail');
// Route::get('edit-promotorsalereport/{id}',[MedicinesaleReportController::class,'editpromotorsalereport'])->name('edit-promotorsalereport');
// Route::post('update-promotorsalereport',[MedicinesaleReportController::class,'updatepromotorsalereport'])->name('update-promotorsalereport');
Route::get('destroy-promotor_Sale/{id}',[PromotersaleReportController::class,'destroy'])->name('destroy-promotor_Sale');


//new medicine master

Route::get('new_medicine_master',[New_Medicine_MasterController::class,'index'])->name('new_medicine_master');
Route::get('medicine_master1',[New_Medicine_MasterController::class,'medlist'])->name('medicine_master1');
Route::post('create_new_medicine_master',[New_Medicine_MasterController::class,'create'])->name('create_new_medicine_master');
Route::get('edit-update_medicine_master/{id}',[New_Medicine_MasterController::class,'editupdate_medicine'])->name('edit-update_medicine_master');
Route::post('update_medicine_master',[New_Medicine_MasterController::class,'updatemedicineeditmaster'])->name('update_medicine_master');
Route::get('disable_medicine/{id}',[New_Medicine_MasterController::class,'disable_medicine'])->name('disable_medicine');
Route::get('destroy-anew_medicine_master/{id}',[New_Medicine_MasterController::class,'destroy'])->name('destroy-new_medicine_master');
Route::get('superadmin_medicine_report',[New_Medicine_MasterController::class,'superadmin_medicine_report'])->name('superadmin_medicine_report');

//update_new medicine_master
Route::get('edit_new_medicine_master',[NewUpdateMedicineController::class,'edit_new_medicine_master'])->name('edit_new_medicine_master');
Route::post('update_new_medicine_master',[NewUpdateMedicineController::class,'update_new_medicine_master'])->name('update_new_medicine_master');
Route::get('getMedii',[NewUpdateMedicineController::class,'getMedicines'])->name('getMedii');


//SecondarysaleReport
Route::get('secondaryreport',[SecondarysaleReportController::class,'index'])->name('secondaryreport');
Route::get('secondary_sale_entry_details',[SecondarysaleReportController::class,'secondarysalereport'])->name('secondary_sale_entry_details');

Route::get('edit-secondarysalesreport/{id}',[SecondarysaleReportController::class,'editsecondarysalesreport'])->name('edit-secondarysalesreport');
Route::post('update-secondarysalesreport',[SecondarysaleReportController::class,'updatesecondarysalesreport'])->name('update-secondarysalesreport');
Route::get('edit-secondarysalesreport_for_marketing/{secondary_sales}',[SecondarysaleReportController::class,'editsecondarysalesreport_for_marketing'])->name('edit-secondarysalesreport_for_marketing');
Route::post('updatesecondarysalesreport_for_marketing',[SecondarysaleReportController::class,'updatesecondarysalesreport_for_marketing'])->name('updatesecondarysalesreport_for_marketing');

Route::get('destroy-secondary_sale/{id}',[SecondarysaleReportController::class,'destroy'])->name('destroy-secondary_sale');

Route::get('stockist1',[SecondarysaleReportController::class,'stockists'])->name('stockist1');

Route::get('secondaryaddsummary',[SecondarysaleReportController::class,'secondaryaddsummary'])->name('secondaryaddsummary');
//mailsecondary
Route::post('secondarymail',[SecondarysaleReportController::class,'secondarymail'])->name('secondarymail');

Route::get('get_previous_added_data_form_secondary_sale',[SecondarysaleReportController::class,'get_previous_added_data_form_secondary_sale'])->name('get_previous_added_data_form_secondary_sale');

Route::get('edit_secondary_sale/{id}',[SecondarysaleReportController::class,'edit_secondary_sale'])->name('edit_secondary_sale');



//batch number datatable
Route::get('batchno',[BatchnoController::class,'index'])->name('batchno');

//medicine sale report

Route::get('medicinesalereport',[MedicinesaleReportController::class,'medicinesalereport'])->name('medicinesalereport');
Route::post('mail_medicinesalereport',[MedicinesaleReportController::class,'mail_medicinesalereport'])->name('mail_medicinesalereport');
Route::get('edit-medicinesalereport/{id}',[MedicinesaleReportController::class,'editmedicinesalereport'])->name('edit-medicinesalereport');
Route::post('update-medicinesalereport',[MedicinesaleReportController::class,'updatemedicinesalereport'])->name('update-medicinesalereport');
Route::get('edit-promotorsalereport/{id}',[MedicinesaleReportController::class,'editpromotorsalereport'])->name('edit-promotorsalereport');
Route::post('update-promotorsalereport',[MedicinesaleReportController::class,'updatepromotorsalereport'])->name('update-promotorsalereport');
Route::get('destroy-medicinesalereport/{id}',[MedicinesaleReportController::class,'destroy'])->name('destroy-medicinesalereport');
Route::get('get_marketing_medicinesale_report',[MedicinesaleReportController::class,'get_marketing_medicinesale_report'])->name('get_marketing_medicinesale_report');
Route::get('get_market_by_id1',[MedicinesaleReportController::class,'get_market'])->name('get_market_by_id1');
Route::get('tdsreport',[TdsReportController::class,'tdsreport'])->name('tdsreport');
Route::get('tdsreport_ecxel',[TdsReportController::class,'tdsreport_ecxel'])->name('tdsreport_ecxel');

//export excel
Route::get('tds_export',[TdsReportController::class, 'get_tds_data'])->name('tds.export');
Route::get('db_backup',[TdsReportController::class, 'database_backup'])->name('db_backup');

//employe registration
Route::get('employe_register',[EmployeregistrationController::class,'index'])->name('employe_register');
Route::post('create_employee_register',[EmployeregistrationController::class,'create'])->name('create_employee_register');
Route::get('edit_employee_register/{id}',[EmployeregistrationController::class,'edit'])->name('edit_employee_register');
Route::post('update_employee_register',[EmployeregistrationController::class,'update'])->name('update_employee_register');
Route::get('destroy_employee_register/{id}',[EmployeregistrationController::class,'destroy'])->name('destroy_employee_register');



//category
Route::get('category',[ExpenceEntryController::class,'category'])->name('category');
Route::post('create_category',[ExpenceEntryController::class,'create_category'])->name('create_category');
Route::get('edit_category/{id}',[ExpenceEntryController::class,'edit_category'])->name('edit_category');
Route::post('update_category',[ExpenceEntryController::class,'update_category'])->name('update_category');
Route::get('destroy_category/{id}',[ExpenceEntryController::class,'destroy_category'])->name('destroy_category');


//Expence entry
Route::get('expence_entry',[ExpenceEntryController::class,'index'])->name('expence_entry');
Route::post('create_expence_entry',[ExpenceEntryController::class,'create_expence_entry'])->name('create_expence_entry');
Route::get('edit_expence_entry/{id}',[ExpenceEntryController::class,'edit_expence_entry'])->name('edit_expence_entry');
Route::post('update_expence_entry',[ExpenceEntryController::class,'update_expence_entry'])->name('update_expence_entry');
Route::get('destroy_expence_entry/{id}',[ExpenceEntryController::class,'destroy_expence_entry'])->name('destroy_expence_entry');
Route::get('get_expense_id',[ExpenceEntryController::class,'get_expense_head'])->name('get_expense_id');
Route::get('get_record',[ExpenceEntryController::class,'getrecord'])->name('get_record');
Route::get('get_star',[ExpenceEntryController::class,'get_star'])->name('get_star');
Route::get('delete_added_expence_entry/{id}',[ExpenceEntryController::class,'delete_added_expence_entry'])->name('delete_added_expence_entry');
Route::get('superadmin_expence_report',[ExpenceEntryController::class,'superadmin_expence_report'])->name('superadmin_expence_report');


//Profit loss
Route::get('profit_loss',[Profit_and_loss_Controller::class,'index'])->name('profit_loss');
Route::post('create_profit_loss',[Profit_and_loss_Controller::class,'create_profit_loss'])->name('create_profit_loss');
Route::get('edit_profit_loss/{id}',[Profit_and_loss_Controller::class,'edit_profit_loss'])->name('edit_profit_loss');
Route::post('update_profit_loss',[Profit_and_loss_Controller::class,'update_profit_loss'])->name('update_profit_loss');
Route::get('destroy_profit_loss/{id}',[Profit_and_loss_Controller::class,'destroy_profit_loss'])->name('destroy_profit_loss');

//expence_head
Route::get('expence_head',[ExpenceEntryController::class,'expence_head'])->name('expence_head');
Route::post('create_expence_head',[ExpenceEntryController::class,'create_expence_head'])->name('create_expence_head');
Route::get('edit_expence_head/{id}',[ExpenceEntryController::class,'edit_expence_head'])->name('edit_expence_head');
Route::post('update_expence_head',[ExpenceEntryController::class,'update_expence_head'])->name('update_expence_head');
Route::get('destroy_expence_head/{id}',[ExpenceEntryController::class,'destroy_expence_head'])->name('destroy_expence_head');
Route::get('get_records',[ExpenceEntryController::class,'get_records'])->name('get_records');

//star
Route::get('star',[ExpenceEntryController::class,'star'])->name('star');
Route::post('create_star',[ExpenceEntryController::class,'create_star'])->name('create_star');
Route::get('edit_star/{id}',[ExpenceEntryController::class,'edit_star'])->name('edit_star');
Route::post('update_star',[ExpenceEntryController::class,'update_star'])->name('update_star');
Route::get('destroy_star/{id}',[ExpenceEntryController::class,'destroy_star'])->name('destroy_star');



//vendor registration
Route::get('vendor',[ExpenceEntryController::class,'vendor'])->name('vendor');
Route::post('create_vendor',[ExpenceEntryController::class,'create_vendor'])->name('create_vendor');
Route::get('edit_vendor/{id}',[ExpenceEntryController::class,'edit_vendor'])->name('edit_vendor');
Route::post('update_vendor',[ExpenceEntryController::class,'update_vendor'])->name('update_vendor');
Route::get('destroy_vendor/{id}',[ExpenceEntryController::class,'destroy_vendor'])->name('destroy_vendor');



//default_otp
Route::get('otp',[OtpController::class,'index'])->name('otp');
// Route::get('destroy_tds/{id}',[TdsController::class,'destroy'])->name('destroy-tds');
Route::post('create_otp',[OtpController::class,'update'])->name('create_otp');


// Route::post('get-total',[MedicinesaleReportController::class,'getTotal'])->name('get-total');
Route::get('getdata_profitloss',[ProfitlossController::class,'index'])->name('getdata_profitloss');
Route::get('profit',[ProfitlossController::class,'profit'])->name('profit');

// Route::get('message',[AdverbsController::class,'msg'])->name('message');
Route::get('adverbs',[AdverbsController::class,'adverbs'])->name('adverbs');
Route::post('msg',[AdverbsController::class,'msg'])->name('msg');
Route::post('update_msg',[AdverbsController::class,'update_msg'])->name('update_msg');

Route::post('create_image',[AdverbsController::class,'create_image'])->name('create_image');
Route::post('create_image111',[AdverbsController::class,'create_image'])->name('create_image11');
Route::get('delete_img/{id}',[AdverbsController::class,'delete_img'])->name('delete_img');

Route::get('report',[ReportController::class,'report'])->name('report');
Route::get('secondary_mix_report',[ReportController::class,'secondary_mix_report'])->name('secondary_mix_report');
Route::get('report_qnt_ptr_mps',[ReportController::class,'report_qnt_ptr_mps'])->name('report_qnt_ptr_mps');
Route::get('profit_and_loss_mix_report',[ReportController::class,'profit_and_loss_mix_report'])->name('profit_and_loss_mix_report');

});

//shiba
// routes/web.php

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return redirect()->back();
    //return "All cache cleared!";
});


