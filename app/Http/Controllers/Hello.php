<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Add_company;//Model Is Load Every time.jitne table par crud operation karege is controller me use load karna hoga
use App\Add_marketing; 
use App\Add_medicine; 
use App\Add_doctor;
use App\Add_scheme;
use App\Add_assign;
use App\Add_entry;
use App\Add_entry_details;
use App\Add_user;
use App\Add_transaction;
use App\Expense_entries_admin;
use App\Expense_entry;
use DB,Session;
use Carbon\Carbon;
use Http;
class Hello extends Controller
{
//     public function main_page(){

//         $verified=session()->get('verified');
//         $login=session()->get('login_data');
//         $login_doctor=session()->get('login_data_doctor');
//         $login_market=session()->get('login_data_market');
//         if ($login!='' &&  $verified!='') 
//                         {
//         return redirect()->route('home');
//                         }
     
//         else if ($login_doctor!='' &&  $verified!='')
//                         {
//         return redirect()->route('companies_report');
//                         }
      
//         else if ($login_market!='' &&  $verified!='')
//                         {
//         return redirect()->route('entry_level_form');
//                         }
//         else
//             {
//         return view('master/superadmin/main_page');
//                         }

//     }
    
//     public function layout(){
//     	return view('layout');
//     }
    
//     public function otp_verification(){
//         $login=session()->get('login_data');
//         $login_doctor=session()->get('login_data_doctor');
//         $login_doctor_company=session()->get('login_doctor_company_data');
//         if($login!='') 
//     {
        
//         return view('master/superadmin/otp_verification');
//     }
//     if($login_doctor!='') 
//     {
        
//         return view('master/superadmin/otp_verification');
//     }
//     else
//     {
//         return view('master/superadmin/admin_login');
//     }
    
//     }
//     //to verify OTP
//     public function otp_verified(Request $request){
//        $otp_a=$request->a;
//        $otp_b=$request->b;
//        $otp_c=$request->c;
//        $otp_d=$request->d;
//        $otp = $otp_a.''. $otp_b.''.$otp_c.''.$otp_d;
//        $login=session()->get('login_data');
//        $login_doctor=session()->get('login_data_doctor');
//        $login_doctor_company=session()->get('login_doctor_company_data');
//        if(session()->get('otp_data')==$otp){

//         Session::put('verified',true);
//         $this->data['company_data'] = Add_company::get();
//         $this->data['doctor_data'] = Add_doctor::get();
//         $this->data['medicine_data'] = DB::table('add_medicines')
//         ->whereIn('add_medicines.company',$login_doctor_company)
//         ->get();// to show database data
//         $this->data['show']= DB::table('add_entries')
//         ->whereIn('add_entries.company',$login_doctor_company)
//         ->join('add_entry_details','add_entries.id','=','add_entry_details.add_entries_id')
//         ->join('add_medicines','add_medicines.id','=','add_entry_details.medicine')
//         ->join('add_companies','add_companies.id','=','add_entries.company')
//         ->join('add_doctors','add_doctors.id','=','add_entries.doctor_select')
//         ->join('add_marketings','add_marketings.id','=','add_entries.scheme_marketing')
//         ->select('add_entries.*','add_entry_details.*','add_medicines.medicine as medicine_name','add_entries.id as add_entries_id','add_marketings.name as marketing_name','add_companies.name as company_name','add_doctors.medical_name as medical_name','add_doctors.name as doctor_name')
//         ->whereMonth('add_entries.date', Carbon::now()->subMonth()->month)
//         ->whereYear('add_entries.date', date('Y'))
//         ->groupByRaw('add_entries.id')
//         ->get();
//         $this->data['filter']=DB::table('add_entries')
//             ->select('add_entries.date',DB::raw('SUM(add_entries.grand_total_2)'))
//             ->groupByRaw('YEAR(`date`), MONTH(`date`)')
//             ->orderByRaw('YEAR(`date`) DESC, MONTH(`date`) DESC')
//             ->get();
//         return view('master/superadmin/companies_report',$this->data);
//        }
//        else
//        {
//         return view('master/superadmin/otp_verification');
//        }

//     }
//      public function company_master(){
//         $login=session()->get('login_data');
//         if($login!='') 
//     {
//         $this->data['company_data'] = Add_company::get();// to show database data
//         return view('master/superadmin/company_master',$this->data);
//     }
//     else
//     {
//         return view('master/superadmin/admin_login');
//     }
    
//     }
    	
//     public function doctors_registration()
//     {
//         $login=session()->get('login_data');
//         if($login!='') 
//     {
//         $this->data['doctor_data'] = Add_doctor::get();// to show database data
//         return view('master/superadmin/doctors_registration',$this->data);
//         }
//     else
//     {
//         return view('master/superadmin/admin_login');
//     }
//     }
        
//     public function doctor_registration_report(Request $request)
//     {
//         $login=session()->get('login_data');
//     //     if($login!='') 
//     // {
//         $this->data['company_data'] = Add_company::get();
//         // $this->data['doctor_data'] = Add_doctor::get();
//         $this->data['doctor_data'] = Add_assign::join('add_doctors','add_doctors.id','=','add_assigns.doctor')
//                                     ->join('add_companies','add_companies.id','=','add_assigns.company')
//                                     ->select('add_companies.name as company_name','add_doctors.*');
//                                     if(isset($request['company']) && $request['company']!='All'){
//                                     $this->data['doctor_data']=$this->data['doctor_data']->where('add_assigns.company',$request['company']);
//                                     }
//                                     $this->data['doctor_data']=$this->data['doctor_data']->orderBy('add_assigns.id','DESC')
//                                     ->get();
//         return view('master/superadmin/doctor_registration_report',$this->data);
//     //     }
//     // else
//     // {
//     //     return view('master/superadmin/admin_login');
//     // }
//     }
//     public function marketing_registration(){
//         $login=session()->get('login_data');
//         if($login!='') 
//     {   
//         $this->data['company_data'] = Add_company::get();
//         // $this->data['marketing_data']= DB::table('add_marketings')->get();


// $this->data['marketing_data'] = DB::table("add_marketings")
//             ->select("add_marketings.*",DB::raw("GROUP_CONCAT(add_companies.name) as company_name"))
//             ->leftjoin("add_companies",DB::raw("FIND_IN_SET(add_companies.id,add_marketings.company)"),">",DB::raw("'0'"))
//             ->groupBy("add_marketings.id")
//             ->get();



//         $this->data['$login'] = $login;// to show database data
//         return view('master/superadmin/marketing_registration',$this->data);
//     }
//         else
//     {
//         return view('master/superadmin/admin_login');
//     }
//     }
//     public function scheme(){
//         $login=session()->get('login_data');
//         if($login!='') 
//     {
//         $this->data['scheme_data'] = Add_scheme::get();// to show database data
//         return view('master/superadmin/scheme',$this->data);
//     }
//         else
//     {
//         return view('master/superadmin/admin_login');
//     }
//     }
//     public function assign(){
//         $login=session()->get('login_data');
//         if($login!='') 
//     {
//         $this->data['company_data'] = Add_company::get();
//         $this->data['doctor_data'] = Add_doctor::get();
//         $this->data['assign_data'] = Add_assign::get();// to show database data
//         return view('master/superadmin/assign',$this->data);
//     }
//         else
//     {
//         return view('master/superadmin/admin_login');
//     }
//     }
    // public function medicine_master(Request $request){
    // $login=session()->get('login_data');
    // $login_doctor=session()->get('login_data_doctor');
    // $login_doctor_company=session()->get('login_doctor_company_data');
    //     if($login!='') 

    // {   
    //     $this->data['medicine_data']= DB::table('add_medicines')
    //     ->join('add_companies','add_companies.id','=','add_medicines.company')
    //     ->select('add_medicines.*','add_companies.name as company_name','add_companies.id as company_id');
    //     if(isset($request['company']) && $request['company']!='All'){
    //         $this->data['medicine_data']=$this->data['medicine_data']->where('add_medicines.company',$request['company']);
    //     }
    //     $this->data['medicine_data']=$this->data['medicine_data']->orderBy('default_scheme', 'desc')
    //     ->get();
    //     $this->data['company_data'] = Add_company::get();
    //     $this->data['scheme_data'] = Add_scheme::get();// to show database data
    //     return view('master/superadmin/medicine_master',$this->data);
    // }
    // if($login_doctor!='') 

    // {   
    //     $this->data['medicine_data']= DB::table('add_medicines');
    //     if(isset($request['company']) && $request['company']!='All'){
    //         $this->data['medicine_data']=$this->data['medicine_data']->where('add_medicines.company',$request['company']);
    //     }
    //     $this->data['medicine_data']=$this->data['medicine_data']->join('add_companies','add_companies.id','=','add_medicines.company')
    //     ->select('add_medicines.*','add_companies.name as company_name','add_companies.id as company_id')
    //     ->get();
    //     $this->data['company_data'] = Add_company::get();
    //     $this->data['scheme_data'] = Add_scheme::get();// to show database data
    //     return view('medicine_master',$this->data);
    // }
    //     else
    // {
    //     return view('master/superadmin/admin_login');
    // }
    // }
    public function medicine_master_add(){
        $login=session()->get('login_data');
        $login_doctor=session()->get('login_data_doctor');
        $login_doctor_company=session()->get('login_doctor_company_data');
        if($login!='') 
    {   
        $this->data['medicine_data']= DB::table('add_medicines')
        ->join('add_companies','add_companies.id','=','add_medicines.company')
        ->select('add_medicines.*','add_companies.name as company_name','add_companies.id as company_id')->orderBy('default_scheme', 'desc')
        ->get();
        $this->data['company_data'] = Add_company::get();
        $this->data['scheme_data'] = Add_scheme::get();// to show database data
        return view('medicine_master',$this->data);
    }
    if($login_doctor!='') 

    {
        $this->data['medicine_data']= DB::table('add_medicines')
        ->whereIn('add_medicines.company',$login_doctor_company)
        ->join('add_companies','add_companies.id','=','add_medicines.company')
        ->select('add_medicines.*','add_companies.name as company_name','add_companies.id as company_id')
        ->get();
        $this->data['company_data'] = Addcompany::get();
        $this->data['scheme_data'] = Add_scheme::get();// to show database data
        return view('medicine_master',$this->data);
    }
        else
    {
        return view('master/superadmin/admin_login');
    }
    }
    public function user_management(){
    // $login=session()->get('login_data');
    //     if($login!='') 
    // {
        $this->data['company_data'] = Add_company::get();
        $this->data['user_data'] = Add_user::get();
        return view('medicine_master',$this->data);
    // }
    //     else
    // {
    //     return view('master/superadmin/admin_login');
    // }
    }
    // public function entry_level_form(){
    // $login=session()->get('login_data');
    // $login_market=session()->get('login_data_market');
    //     if($login!='') 
    // {
    //     $this->data['company_data'] = Add_company::get();
    //     $this->data['scheme_data'] = Add_scheme::get();
    //     $this->data['marketing_data'] = Add_marketing::get();
    //     $this->data['doctor_data'] = Add_doctor::get();
    //     return view('master/superadmin/entry_level_form',$this->data);
    // }
    // if($login_market!='') 
    // {
    //         $login_market_companies=explode(",", $login_market['company']);
    //     $this->data['company_data'] = DB::table('add_companies')
    //     ->whereIn('add_companies.id',$login_market_companies)->get();
    //     $this->data['scheme_data'] = Add_scheme::get();
    //     $this->data['marketing_data'] = DB::table('add_marketings')
    //     ->where('add_marketings.id',$login_market['id'])->first();
    //     $this->data['doctor_data'] = Add_doctor::get();
    //     return view('master/superadmin/entry_level_form',$this->data);
    // }
    //     else
    // {
    //     return view('master/superadmin/admin_login');
    // }
    // }
    
    // public function sale_entry_level_form(){
    // $login=session()->get('login_data');
    // $login_doctor=session()->get('login_data_doctor');
    // $login_doctor_company=session()->get('login_doctor_company_data');
    // $login_market=session()->get('login_data_market');
    //     if($login!='') 
    // {
    //     $this->data['company_data'] = Add_company::get();
    //     $this->data['show']= DB::table('add_entries')
    //     ->join('add_entry_details','add_entries.id','=','add_entry_details.add_entries_id')
    //     ->join('add_companies','add_companies.id','=','add_entries.company')
    //     ->join('add_doctors','add_doctors.id','=','add_entries.doctor_select')
    //     ->join('add_marketings','add_marketings.id','=','add_entries.scheme_marketing')
    //     ->select('add_entries.*','add_entry_details.*','add_entries.id as add_entries_id','add_companies.name as company_name','add_marketings.name as marketing_name','add_doctors.name as doctor_name')
    //     ->whereMonth('add_entries.date', Carbon::now()->subMonth()->month)
    //     ->whereYear('add_entries.date', date('Y'))
    //     ->groupByRaw('add_entries.id')
    //     ->orderByRaw('add_entries.id DESC')//After 16.04.2021 Update
    //     ->get();
    //     $this->data['filter']=DB::table('add_entries')
    //         ->select('add_entries.date',DB::raw('SUM(add_entries.grand_total_2)'))
    //         ->groupByRaw('YEAR(`date`), MONTH(`date`)')
    //         ->orderByRaw('YEAR(`date`) DESC, MONTH(`date`) DESC')
    //         ->get();
    //     return view('master/superadmin/sale_entry_level_form',$this->data);
    // }
    //  elseif($login_doctor!=''){
    //     $this->data['show']= DB::table('add_entries')
    //     ->whereIn('add_entries.company',$login_doctor_company)
    //     ->join('add_entry_details','add_entries.id','=','add_entry_details.add_entries_id')
    //     ->join('add_companies','add_companies.id','=','add_entries.company')
    //     ->join('add_doctors','add_doctors.id','=','add_entries.doctor_select')
    //     ->join('add_marketings','add_marketings.id','=','add_entries.scheme_marketing')
    //     ->select('add_entries.*','add_entry_details.*','add_entries.id as add_entries_id','add_companies.name as company_name','add_marketings.name as marketing_name','add_doctors.name as doctor_name')
    //     ->whereMonth('add_entries.date', Carbon::now()->subMonth()->month)
    //     ->whereYear('add_entries.date', date('Y'))
    //     ->groupByRaw('add_entries.id')
    //     ->get();
    //     $this->data['filter']=DB::table('add_entries')
    //         ->select('add_entries.date',DB::raw('SUM(add_entries.grand_total_2)'))
    //         ->groupByRaw('YEAR(`date`), MONTH(`date`)')
    //         ->orderByRaw('YEAR(`date`) DESC, MONTH(`date`) DESC')
    //         ->get();
    //     return view('master/superadmin/sale_entry_level_form',$this->data);
    //  }
    //  elseif($login_market!='')
    //  {
    // $login_market_companies=explode(",", $login_market['company']);

    //     $this->data['company_data'] = Add_company::get();
    //     $this->data['show']= DB::table('add_entries')
    //     ->where('add_entries.company',$login_market['company'])
    //     ->whereIn('add_entries.scheme_marketing',$login_market_companies)
    //     ->join('add_entry_details','add_entries.id','=','add_entry_details.add_entries_id')
    //     ->join('add_companies','add_companies.id','=','add_entries.company')
    //     ->join('add_doctors','add_doctors.id','=','add_entries.doctor_select')
    //     ->join('add_marketings','add_marketings.id','=','add_entries.scheme_marketing')
    //     ->select('add_entries.*','add_entry_details.*','add_entries.id as add_entries_id','add_companies.name as company_name','add_marketings.name as marketing_name','add_doctors.name as doctor_name')
    //     ->whereMonth('add_entries.date', Carbon::now()->subMonth()->month)
    //     ->whereYear('add_entries.date', date('Y'))
    //     ->groupByRaw('add_entries.id')
    //     ->get();
    //     $this->data['filter']=DB::table('add_entries')
    //         ->select('add_entries.date',DB::raw('SUM(add_entries.grand_total_2)'))
    //         ->groupByRaw('YEAR(`date`), MONTH(`date`)')
    //         ->orderByRaw('YEAR(`date`) ASC, MONTH(`date`) ASC')
    //         ->get();
    //     return view('master/superadmin/sale_entry_level_form',$this->data);
    //  }
    //     else
    // {
    //     return view('master/superadmin/admin_login');
    // }
    // }
    // public function sale_entry_level_form_search(Request $request){
    // $login=session()->get('login_data');
    // $login_doctor=session()->get('login_data_doctor');
    // $login_doctor_company=session()->get('login_doctor_company_data');
    // $login_market=session()->get('login_data_market');
    //     if($login!='') 
    // {
    //     $this->data['company_data'] = Add_company::get();
    //     $this->data['show']= DB::table('add_entries')
    //     ->join('add_entry_details','add_entries.id','=','add_entry_details.add_entries_id')
    //     ->join('add_companies','add_companies.id','=','add_entries.company')
    //     ->join('add_doctors','add_doctors.id','=','add_entries.doctor_select')
    //     ->join('add_marketings','add_marketings.id','=','add_entries.scheme_marketing')
    //     ->select('add_entries.*','add_entry_details.*','add_entries.id as add_entries_id','add_companies.name as company_name','add_marketings.name as marketing_name','add_doctors.name as doctor_name')
    //     ->whereMonth('add_entries.date', date('m',strtotime($request['start_date'])))
    //     ->whereYear('add_entries.date', date('Y',strtotime($request['start_date'])));
    //     if($request['company']!='All'){
    //         $this->data['show']=$this->data['show']->where('add_entries.company',$request['company']);
    //     }
    //     $this->data['show']=$this->data['show']->groupByRaw('add_entries.id')
    //     ->orderByRaw('add_entries.id DESC')//After 16.04.2021 Update
    //     ->get();
    //     $this->data['filter']=DB::table('add_entries')
    //         ->select('add_entries.date',DB::raw('SUM(add_entries.grand_total_2)'))
    //         ->groupByRaw('YEAR(`date`), MONTH(`date`)')
    //         ->orderByRaw('YEAR(`date`) DESC, MONTH(`date`) DESC')
    //         ->get();
    //     return view('master/superadmin/sale_entry_level_form',$this->data);
    // }
    //  elseif($login_doctor!=''){
    //     $this->data['show']= DB::table('add_entries')
    //     ->whereIn('add_entries.company',$login_doctor_company)
    //     ->join('add_entry_details','add_entries.id','=','add_entry_details.add_entries_id')
    //     ->join('add_companies','add_companies.id','=','add_entries.company')
    //     ->join('add_doctors','add_doctors.id','=','add_entries.doctor_select')
    //     ->join('add_marketings','add_marketings.id','=','add_entries.scheme_marketing')
    //     ->select('add_entries.*','add_entry_details.*','add_entries.id as add_entries_id','add_companies.name as company_name','add_marketings.name as marketing_name','add_doctors.name as doctor_name')
    //     ->whereMonth('add_entries.date', date('m',strtotime($request['start_date'])))
    //     ->whereYear('add_entries.date', date('Y',strtotime($request['start_date'])))
    //     ->groupByRaw('add_entries.id')
    //     ->get();
    //     $this->data['filter']=DB::table('add_entries')
    //         ->select('add_entries.date',DB::raw('SUM(add_entries.grand_total_2)'))
    //         ->groupByRaw('YEAR(`date`), MONTH(`date`)')
    //         ->orderByRaw('YEAR(`date`) DESC, MONTH(`date`) DESC')
    //         ->get();
    //     return view('master/superadmin/sale_entry_level_form',$this->data);
    //  }
    //  elseif($login_market!=''){
    // $login_market_companies=explode(",", $login_market['company']);
    //     $this->data['company_data'] = Add_company::get();
    //     $this->data['show']= DB::table('add_entries');
    //     if($request['company']!='All'){
    //         $this->data['show']=$this->data['show']->where('add_entries.company',$request['company']);
    //     }
    //     $this->data['show']=$this->data['show']->where('add_entries.scheme_marketing',$login_market['id'])
    //     ->join('add_entry_details','add_entries.id','=','add_entry_details.add_entries_id')
    //     ->join('add_companies','add_companies.id','=','add_entries.company')
    //     ->join('add_doctors','add_doctors.id','=','add_entries.doctor_select')
    //     ->join('add_marketings','add_marketings.id','=','add_entries.scheme_marketing')
    //     ->select('add_entries.*','add_entry_details.*','add_entries.id as add_entries_id','add_companies.name as company_name','add_marketings.name as marketing_name','add_doctors.name as doctor_name')
    //     ->whereMonth('add_entries.date', date('m',strtotime($request['start_date'])))
    //     ->whereYear('add_entries.date', date('Y',strtotime($request['start_date'])))
    //     ->groupByRaw('add_entries.id')
    //     ->get();
    //     $this->data['filter']=DB::table('add_entries')
    //         ->select('add_entries.date',DB::raw('SUM(add_entries.grand_total_2)'))
    //         ->groupByRaw('YEAR(`date`), MONTH(`date`)')
    //         ->orderByRaw('YEAR(`date`) ASC, MONTH(`date`) ASC')
    //         ->get();
    //     return view('master/superadmin/sale_entry_level_form',$this->data);
    //  }
    //     else
    // {
    //     return view('master/superadmin/admin_login');
    // }
    // }
    // public function admin_login(){
    // $login=session()->get('login_data');
    //     if($login!='') 
    // {
    //     return view('master/superadmin/admin_login');
    // }
    //     else
    // {
    //     return view('master/superadmin/admin_login');
    // }
    // }

    // public function doctor_login(){
    // $login=session()->get('login_data');
    //     if($login!='') 
    // {
    //     return view('master/superadmin/doctor_login');
    // }
    //     else
    // {
    //     return view('master/superadmin/doctor_login');
    // }
    // }

    // public function marketing_login(){
        
    // $login=session()->get('login_data');
    //     if($login!='') 
    // {
    //     return view('master/superadmin/marketing_login');
    // }
    //     else
    // {
    //     return view('master/superadmin/marketing_login');
    // }
    // }
    // public function expense_entry(){
    //     $login=session()->get('login_data');
    //     $login_market=session()->get('login_data_market');
    //     if($login!='') 
    // {
    //     $this->data['expense_data'] = DB::table('expense_entries')
    //     ->join('add_marketings','add_marketings.id','=','expense_entries.user_id')
    //     ->select('expense_entries.*','add_marketings.name')
    //     ->orderByRaw('expense_entries.id DESC')
    //     ->get();// to show database data
    //     $this->data['expense_entries_admins'] = DB::table('expense_entries_admins')
    //     ->join('add_users','add_users.id','=','expense_entries_admins.admin_user_id')
    //     ->select('expense_entries_admins.*','add_users.username')
    //     ->orderByRaw('expense_entries_admins.id DESC')
    //     ->get();// to show database data
    //     return view('master/superadmin/expense_entry',$this->data);
    // }
    // if($login_market!='') 
    // {
    //     $this->data['expense_data'] = DB::table('expense_entries')
    //     ->join('add_marketings','add_marketings.id','=','expense_entries.user_id')
    //     ->where('user_id',$login_market['id'])
    //     ->select('expense_entries.*','add_marketings.name')
    //     ->orderByRaw('expense_entries.id DESC')
    //     ->get();// to show database data
        
    //     return view('master/superadmin/expense_entry',$this->data);
    // }
    // else
    // {
    //     return view('master/superadmin/expense_entry');
    // }
    
    // }
    // public function entry_level_form_transaction(){
    // $login=session()->get('login_data');
    // $login_doctor=session()->get('login_data_doctor');
    // $login_doctor_company=session()->get('login_doctor_company_data');
    
    //     if($login!='') 
    // {   
    //     // $this->data['edit']= DB::table('add_transactions')
    //     // ->join('add_doctors','add_doctors.id','=','add_transactions.select_doctor')
    //     // ->select('add_transactions.*','add_doctors.name as doctor_name','add_doctors.id as doctors_id')
    //     // ->whereMonth('add_transactions.created_at', date('m'))
    //     // ->whereYear('add_transactions.created_at', date('Y'))->get();
    //     // $this->data['filter']= Add_entry::get()->GroupBy('date');
    //     // $this->data['filter']=Add_entry::select(DB::raw('YEAR(date) year, MONTH(date) month'))->groupby('year','month')->get();
        
    //         $this->data['filter']=DB::table('add_entries')
    //         ->select('add_entries.date',DB::raw('SUM(add_entries.grand_total_2)'))
    //         ->groupByRaw('YEAR(`date`), MONTH(`date`)')
    //         ->orderByRaw('YEAR(`date`) ASC, MONTH(`date`) ASC')
    //         ->get();
    //         // echo json_encode($this->data['filter']);
    //         //  exit();
    //     $this->data['company_data'] = Add_company::get();
    //     $this->data['doctor_data'] = Add_doctor::get();
    //     return view('master/superadmin/entry_level_form_transaction',$this->data);
    // }

    //     elseif($login_doctor!='')
    // {   
    //   $this->data['edit']= DB::table('add_transactions')
    //   ->join('add_doctors','add_doctors.id','=','add_transactions.select_doctor')
    //   ->select('add_transactions.*','add_doctors.name as doctor_name','add_doctors.id as doctors_id')
    //   ->get();
    //     // $this->data['filter']= Add_entry::get()->GroupBy('date');
    //     // $this->data['filter']=Add_entry::select(DB::raw('YEAR(date) year, MONTH(date) month'))->groupby('year','month')->get();
        
    //         $this->data['filter']=DB::table('add_entries')
    //         ->select('add_entries.date',DB::raw('SUM(add_entries.grand_total_2)'))
    //         ->groupByRaw('YEAR(`date`), MONTH(`date`)')
    //         ->orderByRaw('YEAR(`date`) ASC, MONTH(`date`) ASC')
    //         ->get();
    //         // echo json_encode($this->data['filter']);
    //         //  exit();

    //     $this->data['doctor_data'] = Add_doctor::get();
    //     // return view('master/superadmin/entry_level_form_transaction',$this->data);
    // }
    //     else
    // {
    //     return view('master/superadmin/admin_login');
    // }
    // }
    // //to data tally for entry level transaction
    // public function medicine_month(Request $request){
    //     $m = date('m',strtotime($request->select_month));
    //     $y = date('Y',strtotime($request->select_month));

    //                 $cal = DB::table('add_entries')
    //                 ->join('add_doctors','add_entries.doctor_select','=','add_doctors.id')
    //                 ->whereYear('date','=',$y)
    //                 ->whereMonth('date','=',$m)
    //                 ->where('doctor_select','=',$request->select_doctor)
    //                 ->select('add_doctors.*',DB::raw('SUM(add_entries.grand_total_2) as sum'))
    //                 ->get();
    //             echo json_encode($cal);
             

        // $this->data['filter']=DB::table('add_entries')
        //     ->select('add_entries.date',DB::raw('SUM(add_entries.grand_total)'))
        //     ->groupByRaw('YEAR(`date`), MONTH(`date`)')
        //     ->orderByRaw('YEAR(`date`) ASC, MONTH(`date`) ASC')
        //     ->get();
        //     echo json_encode($this->data['filter']);
        //      exit();
    }
    public function home(){
    $login=session()->get('login_data');
    $login_doctor=session()->get('login_data_doctor');
        if($login!='') 
    {   
      $this->data['count_medicine'] = Add_medicine::count();
      $this->data['count_doctor'] = Add_doctor::count();
      $this->data['count_company'] = Add_company::count();
      $this->data['count_marketing'] = DB::table('add_marketings')->join('add_companies','add_companies.id','=','add_marketings.company')->get()->count();
      $this->data['count_entry'] =Add_entry::whereDate('date', date('Y-m-d'))->get()->count();  
        return view('master/superadmin/home',$this->data);
    }
        elseif($login_doctor!='')
    {   
      $this->data['count_medicine'] = Add_medicine::count();
      $this->data['count_doctor'] = Add_doctor::count();
      $this->data['count_company'] = Add_company::count();
      $this->data['count_marketing'] = Add_marketing::count();
      $this->data['count_entry'] =Add_entry::whereDate('date', date('Y-m-d'))->get()->count();
        return view('master/superadmin/home',$this->data);
    }
     else
    {
        return view('master/superadmin/admin_login');
    }
    }

    //Dynamic Company
    public function add_company(Request $request){
        $insert = Add_company::create([
            'name'=>$request->name,
            'address'=>$request->address,
            'contact_person'=>$request->contact_person,
            'mobile'=>$request->mobile,
        ]);
        return redirect()->Route('company_master')->with('success',1);
    }
    //Dynamic Doctor
    public function add_doctor(Request $request){
        $companies=Add_company::select('id')->get()->toArray();
        // dd($companies);
        $insert = Add_doctor::create([
            'name'=>$request->name,
            'address'=>$request->address,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'beneficiary_name'=>$request->beneficiary_name,
            'account_number'=>$request->account_number,
            'ifsc'=>$request->ifsc,
            'username'=>$request->username,
            'password'=>$request->password,
            'medical_name'=>$request->medical_name,
            'role'=>2,
        ]);

        for($i=0;$i<count($companies);$i++)
        {
            Add_assign::create(
            [
                'company'   => $companies[$i]['id'],
                'doctor'    => $insert->id

            ]

            );
        }
        
        return redirect()->Route('doctors_registration')->with('success',1);
    }
    //Dynamic Market Reg
    public function add_marketing(Request $request){
        // $length=count($request->company);
       
        // for ($i = 0; $i < $length ; $i++) {
        // $insert = Add_marketing::create([
        //     'name'=>$request->name,
        //     'mobile'=>$request->mobile,
        //     'email'=>$request->email,
        //     'address'=>$request->address,
        //     'username'=>$request->username,
        //     'password'=>$request->password,
        //     'company'=>$request->company[$i],
        //     'role'=>3,
        // ]);
        // }

        $companies=implode(",", $request->company);
       
        $insert = Add_marketing::create([
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'address'=>$request->address,
            'username'=>$request->username,
            'password'=>$request->password,
            'company'=>$companies,
            'role'=>3,
        ]);
        return redirect()->Route('marketing_registration')->with('success',1);
    }
    //Dynamic Scheme
    public function add_scheme(Request $request){
        $insert = Add_scheme::create([
            'scheme'=>$request->scheme,
        ]);
        return redirect()->Route('scheme');
    }
    //Dynamic Assign
    public function add_assign(Request $request){
        $length=count($request->doctor);
       
        for ($i = 0; $i < $length ; $i++) {
        $insert = Add_assign::create([
            'company'=>$request->company,
            'doctor'=>$request->doctor[$i],
        ]);
    }
        return redirect()->Route('assign')->with('success',1);
    }
    //Dynamic Medicine
    public function add_medicine(Request $request){
        
       // $data = ["title" => "hello", "description" => "test test test"];

       //      return response()->json($data);

        $insert = Add_medicine::create([
            'company'=>$request->company,
            'medicine'=>$request->medicine,
            'mrp'=>$request->mrp,
            'given_gst'=>$request->given_gst,
            'purchase'=>$request->purchase,
            'gst'=>$request->gst,
            'amount_after_gst'=>$request->amount_after_gst,
            'retail_margin'=>$request->retail_margin,
            'ptr'=>$request->ptr,
            'stockist_margin'=>$request->stockist_margin,
            'pts'=>$request->pts,
            'management'=>$request->management,
            'promotion_cost'=>$request->promotion_cost,
            'scheme'=>$request->scheme,
            'default_scheme'=>$request->default_scheme,
            'scheme_amount_deduct'=>$request->scheme_amount_deduct,
            'transport_expiry_breakage'=>$request->transport_expiry_breakage,
            'tot'=>$request->tot,
            'marketing_working_cost'=>$request->marketing_working_cost,
            'company_profit'=>$request->company_profit,
            'percent_profit_to_investment'=>$request->percent_profit_to_investment,
            'marketing_promotion_scheme'=>$request->marketing_promotion_scheme,
            'percent_profit_to_ptr'=>$request->percent_profit_to_ptr,

        ]);
        $insert = Add_medicine::create([
            'company'=>$request->company,
            'medicine'=>$request->medicine,
            'mrp'=>$request->mrp,
            'given_gst'=>$request->given_gst,
            'purchase'=>$request->purchase,
            'gst'=>$request->gst_ten,
            'amount_after_gst'=>$request->amount_after_gst_ten,
            'retail_margin'=>$request->retail_margin_ten,
            'ptr'=>$request->ptr_ten,
            'stockist_margin'=>$request->stockist_margin_ten,
            'pts'=>$request->pts_ten,
            'management'=>$request->management_ten,
            'promotion_cost'=>$request->promotion_cost_ten,
            'scheme'=>$request->scheme_ten,
            'default_scheme'=>$request->default_scheme_ten,
            'scheme_amount_deduct'=>$request->scheme_amount_deduct_ten,
            'transport_expiry_breakage'=>$request->transport_expiry_breakage_ten,
            'tot'=>$request->tot_ten,
            'marketing_working_cost'=>$request->marketing_working_cost_ten,
            'company_profit'=>$request->company_profit_ten,
            'percent_profit_to_investment'=>$request->percent_profit_to_investment_ten,
            'marketing_promotion_scheme'=>$request->marketing_promotion_scheme_ten,
            'percent_profit_to_ptr'=>$request->percent_profit_to_ptr_ten,

        ]);
        $insert = Add_medicine::create([
            'company'=>$request->company,
            'medicine'=>$request->medicine,
            'mrp'=>$request->mrp,
            'given_gst'=>$request->given_gst,
            'purchase'=>$request->purchase,
            'gst'=>$request->gst_twenty,
            'amount_after_gst'=>$request->amount_after_gst_twenty,
            'retail_margin'=>$request->retail_margin_twenty,
            'ptr'=>$request->ptr_twenty,
            'stockist_margin'=>$request->stockist_margin_twenty,
            'pts'=>$request->pts_twenty,
            'management'=>$request->management_twenty,
            'promotion_cost'=>$request->promotion_cost_twenty,
            'scheme'=>$request->scheme_twenty,
            'default_scheme'=>$request->default_scheme_twenty,
            'scheme_amount_deduct'=>$request->scheme_amount_deduct_twenty,
            'transport_expiry_breakage'=>$request->transport_expiry_breakage_twenty,
            'tot'=>$request->tot_twenty,
            'marketing_working_cost'=>$request->marketing_working_cost_twenty,
            'company_profit'=>$request->company_profit_twenty,
            'percent_profit_to_investment'=>$request->percent_profit_to_investment_twenty,
            'marketing_promotion_scheme'=>$request->marketing_promotion_scheme_twenty,
            'percent_profit_to_ptr'=>$request->percent_profit_to_ptr_twenty,

        ]);
    
        return response()->json(1);
    }
    //Dynamic Entry Form
    public function add_entry(Request $request){
        $insert = Add_entry::create([
            'date'=>$request->date,
            'company'=>$request->company,
            'doctor_select'=>$request->doctor_select,
            'scheme_select'=>$request->scheme_select,
            'scheme_marketing'=>$request->scheme_marketing,
            'grand_total_2'=>$request->grand_total_2,
            'grand_total_3'=>$request->grand_total_3,
            

        ]);
        $last_id = $insert->id;
        for ($i = 1; $i <= $request->temp ; $i++) {
        $insert = Add_entry_details::create([
            'add_entries_id'=>$last_id,
            'medicine'=>$request['medicine'.$i],
            'mrp'=>$request['mrp'.$i],
            'gst_percent'=>$request['gst'.$i],
            'gst_rupees'=>$request['gsta'.$i],
            'purchase'=>$request['purchase'.$i],
            'amount_after_gst'=>$request['amount_after_gst'.$i],
            'retail_margin'=>$request['retail_margin'.$i],
            'ptr'=>$request['ptr'.$i],
            'stockist_margin'=>$request['stockist_margin'.$i],
            'pts'=>$request['pts'.$i],
            'management'=>$request['management'.$i],
            'quantity'=>$request['quantity'.$i],
            'promotion_cost'=>$request['promotion_cost'.$i],
            'scheme'=>$request['scheme'.$i],
            'scheme_amount_deduct'=>$request['scheme_amount_deduct'.$i],
            'transport_expiry_breakage'=>$request['transport_expiry_breakage'.$i],
            'tot'=>$request['tot'.$i],
            'marketing_working_cost'=>$request['marketing_working_cost'.$i],
            'company_profit'=>$request['company_profit'.$i],
            'percent_profit_to_investment'=>$request['percent_profit_to_investment'.$i],
            'marketing_promotion_scheme'=>$request['marketing_promotion_scheme'.$i],
            'percent_profit_ptr'=>$request['percent_profit_ptr'.$i],
            'total_2'=>$request['total_2'.$i],
            'total_3'=>$request['total_3'.$i],
            
        ]);
    }
        return redirect()->Route('entry_level_form')->with(['success'=>1,'date'=>$request->date,'company'=>$request->company,'scheme_marketing'=>$request->scheme_marketing]);
    }

    //Dynamic User
    public function add_user(Request $request){
        $insert = Add_user::create([
            'username'=>$request->username,
            'password'=>$request->password,
            'mobile'=>$request->mobile,
            'select_company'=>$request->select_company,
        ]);
        return redirect()->Route('user_management');
    }

    //Dynamic Transaction
    public function add_transaction(Request $request){
        $insert = Add_transaction::create([
            'date'=>$request->date,
            'select_month'=>$request->select_month,
            'select_doctor'=>$request->select_doctor,
            'beneficiary_name'=>$request->beneficiary_name,
            'beneficiary_account'=>$request->beneficiary_account,
            'beneficiary_ifsc'=>$request->beneficiary_ifsc,
            'paypal_amount'=>$request->paypal_amount,
        ]);
        return redirect()->Route('entry_level_form_transaction')->with('success',1);
    }

    public function add_expense(Request $request){
        $login=session()->get('login_data');
        if(!$login)
            $login=session()->get('login_data_doctor');
            if(!$login)
                $login=session()->get('login_data_market');

        $file = pathinfo($request->file_name->getClientOriginalName(), PATHINFO_FILENAME);

         $fileName = $file.'_'.time().'.'.$request->file_name->extension();  
   
         $request->file_name->move(public_path('expense_reports'), $fileName);
        $insert = Expense_entry::create([
            'user_id'=>$login['id'],
            'date'=>$request->date,
            'expense_name'=>$request->expense_name,
            'expense_charge'=>$request->expense_charge,
            'expense_charge_approved'=>0,
            'description'=>$request->description,
            'expense_report_excel'=>$fileName,
        ]);
        return redirect()->Route('expense_entry');
    }
    public function add_expense_admin(Request $request){
    $login=session()->get('login_data');
    $file = pathinfo($request->file_name_admin->getClientOriginalName(), PATHINFO_FILENAME);

         $fileName = $file.'_'.time().'.'.$request->file_name_admin->extension();  
   
         $request->file_name_admin->move(public_path('expense_reports_admin'), $fileName);
        $insert = Expense_entries_admin::create([
            'admin_user_id'=>$login['id'],
            'date'=>$request->date,
            'expense_name'=>$request->expense_name,
            'expense_charge'=>$request->expense_charge,
            'expense_charge_approved'=>0,
            'description'=>$request->description,
            'expense_report_excel'=>$fileName,
        ]);
        return redirect()->Route('expense_entry');
    }
    //Delete Company
    public function delete_company(Request $request){
        $delete = Add_company::where('id',$request['id'])->delete();
        return redirect()->Route('company_master');
    }
    //Delete Doctor
    public function delete_doctor(Request $request){
        $delete = Add_doctor::where('id',$request['id'])->delete();
        return redirect()->Route('doctors_registration');
    }
    //Delete Marketing
    public function delete_marketing(Request $request){
        $delete = Add_marketing::where('id',$request['id'])->delete();
        return redirect()->Route('marketing_registration');
    }
    //Delete Scheme
    public function delete_scheme(Request $request){
        $delete = Add_scheme::where('id',$request['id'])->delete();
        return redirect()->Route('scheme');
    }
    //Delete Assign
    public function delete_assign(Request $request){
        $delete = Add_assign::where('id',$request['id'])->delete();
        return redirect()->Route('assign');
    }
    //Delete Medicine
    public function delete_medicine(Request $request){
        $delete = Add_medicine::where('id',$request['id'])->delete();
        return redirect()->Route('medicine_master');
    }
    //Delete User
    public function delete_user(Request $request){
        $delete = Add_user::where('id',$request['id'])->delete();
        return redirect()->Route('user_management');
    }
    //Delete Transaction
    public function delete_transaction(Request $request){
        $delete = Add_transaction::where('id',$request['id'])->delete();
        return redirect()->Route('entry_level_form_transaction');
    }
    //Delete Transaction
    public function delete_add_medicines(Request $request){
        $delete = Add_entry::where('id',$request['id'])->delete();
        $delete = Add_entry_details::where('id',$request['id'])->delete();
        // return redirect()->Route('sale_entry_level_form');
        return redirect('/sale_entry_level_form_search?start_date='.$request['start_date'].'&company='.$request['company'].'');
    }
    public function delete_add_medicines1(Request $request){
        $delete = Add_entry::where('id',$request['id'])->delete();
        $delete = Add_entry_details::where('id',$request['id'])->delete();
        // return redirect()->Route('sale_entry_level_form');
        return redirect('/sale_entry_level_form');
    }
    public function delete_expense(Request $request){
        $delete = Expense_entry::where('id',$request['id'])->delete();
        return redirect()->Route('expense_entry');
    }
    public function delete_expense_admin(Request $request){
        $delete = Expense_entries_admin::where('id',$request['id'])->delete();
        return redirect()->Route('expense_entry');
    }

    public function otp_calling(Request $request){
            $otp= rand(1111,9999);
            $request->session()->put('otp_data',$otp);
            $login=session()->get('login_data_doctor');
            $mob_no=$login['mobile'];
            $otp_send=session()->get('otp_data');
            // echo json_encode($otp_send);
            // exit();
            // $request = Http::get('http://service.bulksmsnagpur.net/sendsms?uname=habitm1&pwd=habitm1&senderid=WMEDIA&to='.$mob_no.'&msg=Your OTP '.$otp_send.' for login.&route=T');
            $name='Sir/Mam';
            $msg='Dear '.$name.', Your OTP is '.$otp.'. Send by WEBMEDIA';
            $msg=urlencode($msg);
            $to=$mob_no;  
            $data="uname=habitm1&pwd=habitm1&senderid=WMEDIA&to=".$to."&msg=".$msg."&route=T&peid=1701159196421355379&tempid=1707161527969328476";
            $ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            echo json_encode($result);
            // exit();
        
            return redirect()->Route('otp_verification');
    }
    //User Login:
    public function user_entry(Request $request){

        $login = Add_user::where('username',$request['username'])->where('password',$request['password'])->first();
        if ($login!='') {
            $request->session()->put('login_data',$login);
            $request->session()->put('verified',true);
            // return $this->otp_calling($request);
            return redirect()->Route('home');
        }
        else
        {
            return redirect()->Route('admin_login')->with('error',1);
        }
        
    }
    //Doctor Login:
    public function doctor_entry(Request $request){
$login_doctor_company=array();
        $login_doctor = Add_doctor::where('username',$request['username'])->where('password',$request['password'])->first();

        if ($login_doctor!='') {
            $request->session()->put('login_data_doctor',$login_doctor);
            $login_doctor=session()->get('login_data_doctor');
            $login_doctor_companies = Add_assign::where('doctor',$login_doctor['id'])->select('company')->get();
            foreach ($login_doctor_companies as $key) 
            {
                array_push($login_doctor_company, $key->company);
            }
            // var_dump($login_doctor_company[0]);
            $request->session()->put('login_doctor_company_data',$login_doctor_company);
            return $this->otp_calling($request);
            return redirect()->Route('companies_report');
        }
        else
        {
            return redirect()->Route('doctor_login')->with('error',1);
        }
        
    }
    //Marketing Login:
    public function marketing_entry(Request $request){

    $login_market = Add_marketing::where('username',$request['username'])->where('password',$request['password'])->first();
        if ($login_market!='') {
            $request->session()->put('login_data_market',$login_market);
            $request->session()->put('verified',true);
            // return $this->otp_calling($request);
            return redirect()->Route('entry_level_form');
        }
        else
        {  
            return redirect()->Route('marketing_login')->with('error',1);
        }
        
    }
    //User Logout
    public function logout()
    { 
        // $login=session()->get('login_data');
        // $login_doctor=session()->get('login_data_doctor');
        // $login_market=session()->get('login_data_market');
        // if ($login!='') 
        //                 {
        // session()->forget('login_data');
        // return redirect()->route('admin_login');
        //                 }
     
        // if ($login_doctor!='')
        //                 {
        // session()->forget('login_data_doctor');
        // return redirect()->route('doctor_login');
        //                 }
      
        // if ($login_market!='')
        //                 {
        // session()->forget('login_data_market');
        // return redirect()->route('marketing_login');
        //                 }
        // else
        //     {
        // return redirect()->route('admin_login');
        //                 }

        
        session()->forget('login_data');
        session()->forget('login_data_doctor');
        session()->forget('login_data_market');
        session()->forget('verified');
        return redirect()->route('main_page');

    }
    //to data tally for entry level
    public function scheme_medicine(Request $request){
        $show = Add_medicine::where('default_scheme',$request['scheme_select'])->where('company',$request['company'])->get();
        echo json_encode($show);
    }
    
    //to data tally for Sale Entry Level Form
    public function sale_entry_details(Request $request){
        $login=session()->get('login_data');
        $login_market=session()->get('login_data_market');
        $login_doctor=session()->get('login_data_doctor');
        $login_doctor_company=session()->get('login_doctor_company_data');
        if($login!=''){
            $this->data['show']= DB::table('add_entries')
        ->where('add_entries.id',$request['entry_id'])
        ->join('add_entry_details','add_entries.id','=','add_entry_details.add_entries_id')
        ->join('add_companies','add_companies.id','=','add_entries.company')
        ->join('add_doctors','add_doctors.id','=','add_entries.doctor_select')
        ->join('add_marketings','add_marketings.id','=','add_entries.scheme_marketing')
        ->join('add_medicines','add_medicines.id','=','add_entry_details.medicine')
        ->select('add_entries.*','add_entry_details.*','add_entries.id as add_entries_id','add_companies.name as company_name','add_doctors.name as doctor_name','add_marketings.name as marketing_name','add_medicines.medicine as medicine_name')
        ->get();
        echo json_encode($this->data['show']);
        }
        if($login_market!='')
        {
        // $show = Add_medicine::where('default_scheme',$request['entry_id'])->get();
        $this->data['show']= DB::table('add_entries')
        ->where('add_entries.id',$request['entry_id'])
        ->where('add_entries.scheme_marketing',$login_market['id'])
        ->join('add_entry_details','add_entries.id','=','add_entry_details.add_entries_id')
        ->join('add_companies','add_companies.id','=','add_entries.company')
        ->join('add_doctors','add_doctors.id','=','add_entries.doctor_select')
        ->join('add_marketings','add_marketings.id','=','add_entries.scheme_marketing')
        ->join('add_medicines','add_medicines.id','=','add_entry_details.medicine')
        ->select('add_entries.*','add_entry_details.*','add_entries.id as add_entries_id','add_companies.name as company_name','add_doctors.name as doctor_name','add_marketings.name as marketing_name','add_medicines.medicine as medicine_name')
        ->get();
        echo json_encode($this->data['show']);
        }
        if($login_doctor!=''){
            $this->data['show']= DB::table('add_entries')
        ->where('add_entries.id',$request['entry_id'])
        ->whereIn('add_entries.company',$login_doctor_company)
        ->join('add_entry_details','add_entries.id','=','add_entry_details.add_entries_id')
        ->join('add_companies','add_companies.id','=','add_entries.company')
        ->join('add_doctors','add_doctors.id','=','add_entries.doctor_select')
        ->join('add_marketings','add_marketings.id','=','add_entries.scheme_marketing')
        ->join('add_medicines','add_medicines.id','=','add_entry_details.medicine')
        ->select('add_entries.*','add_entry_details.*','add_entries.id as add_entries_id','add_companies.name as company_name','add_doctors.name as doctor_name','add_marketings.name as marketing_name','add_medicines.medicine as medicine_name')
        ->get();
        echo json_encode($this->data['show']);
             }
    }



    //edit 
    public function edit_company(Request $request){
      $this->data['edit'] = Add_company::where('id',$request['id'])->first();
      $this->data['company_data'] = Add_company::where('id',$request['id'])->first(); 
        return view('master/superadmin/edit_company_master',$this->data);
    }
    public function edit_company_complete(Request $request){
        $update = Add_company::where('id',$request['id'])->update([
            'name'=>$request->name,
            'address'=>$request->address,
            'contact_person'=>$request->contact_person,
            'mobile'=>$request->mobile,
        ]);
        return redirect()->Route('company_master');
    }
    public function edit_doctor(Request $request){
      $this->data['edit'] = Add_doctor::where('id',$request['id'])->first();
      $this->data['doctor_data'] = Add_doctor::where('id',$request['id'])->first(); 
        return view('master/superadmin/edit_doctors_registration',$this->data);
    }
    public function edit_doctor_complete(Request $request){
        $update = Add_doctor::where('id',$request['id'])->update([
            'name'=>$request->name,
            'address'=>$request->address,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'beneficiary_name'=>$request->beneficiary_name,
            'account_number'=>$request->account_number,
            'ifsc'=>$request->ifsc,
            'username'=>$request->username,
            'password'=>$request->password,
            'medical_name'=>$request->medical_name,
        ]);
        return redirect()->Route('doctors_registration');
    }
    public function edit_marketing(Request $request){
      $this->data['company_data'] = Add_company::get();
      
      $this->data['edit'] = Add_marketing::where('id',$request['id'])->first();
      $this->data['marketing_data'] = Add_marketing::where('id',$request['id'])->first(); 
        return view('master/superadmin/edit_marketing_registration',$this->data);
    }
    public function edit_marketing_complete(Request $request){
        $companies=implode(",", $request->company);
        $update = Add_marketing::where('id',$request['id'])->update([
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'address'=>$request->address,
            'username'=>$request->username,
            'password'=>$request->password,
            'company'=>$companies,

        ]);
        return redirect()->Route('marketing_registration');
    }
    public function edit_assign(Request $request){
      $this->data['edit']= DB::table('add_assigns')->join('add_companies','add_companies.id','=','add_assigns.company')->join('add_doctors','add_doctors.id','=','add_assigns.doctor')->select('add_assigns.*','add_companies.name','add_companies.id as company_id','add_doctors.name as doctor_name','add_doctors.id as doctors_id')->where('add_assigns.id',$request['id'])->first();
      $this->data['doctor_data'] = Add_doctor::get();
      $this->data['company_data'] = Add_company::get();
        return view('master/superadmin/edit_assign',$this->data);
    }
    public function edit_assign_complete(Request $request){
        $update = Add_assign::where('id',$request['id'])->update([
            'company'=>$request->company,
            'doctor'=>$request->doctor,
        ]);
        return redirect()->Route('assign');
    }
    public function edit_user(Request $request){
      $this->data['company_data'] = Add_company::get();
      $this->data['edit']= DB::table('add_users')->join('add_companies','add_companies.id','=','add_users.select_company')->select('add_users.*','add_companies.name','add_companies.id as company_id')->where('add_users.id',$request['id'])->first();
      $this->data['user_data'] = Add_user::where('id',$request['id'])->first();
      // $this->data['company_data'] = Add_company::get();
      // $this->data['user_data'] = Add_user::get(); 
        return view('master/superadmin/edit_user_management',$this->data);
    }
    public function edit_user_complete(Request $request){
        $update = Add_user::where('id',$request['id'])->update([
            'username'=>$request->username,
            'password'=>$request->password,
            'mobile'=>$request->mobile,
            'select_company'=>$request->select_company,
        ]);
        return redirect()->Route('user_management');
    }

    public function edit_medicine(Request $request){
      $this->data['company_data'] = Add_company::get();
      $this->data['edit']= DB::table('add_medicines')
      ->join('add_companies','add_companies.id','=','add_medicines.company')
      ->select('add_medicines.*','add_companies.name','add_companies.id as company_id')
      ->where('add_medicines.id',$request['id'])
      ->first(); 
        return view('master/superadmin/edit_medicine_master',$this->data);
    }
    public function edit_medicine_complete(Request $request){
      $update = Add_medicine::where('id',$request['id'])->update([
            'company'=>$request->company,
            'medicine'=>$request->medicine,
            'mrp'=>$request->mrp,
            'given_gst'=>$request->given_gst,
            'purchase'=>$request->purchase,
            'gst'=>$request->gst,
            'amount_after_gst'=>$request->amount_after_gst,
            'retail_margin'=>$request->retail_margin,
            'ptr'=>$request->ptr,
            'stockist_margin'=>$request->stockist_margin,
            'pts'=>$request->pts,
            'management'=>$request->management,
            'promotion_cost'=>$request->promotion_cost,
            'scheme'=>$request->scheme,
            'default_scheme'=>$request->default_scheme,
            'scheme_amount_deduct'=>$request->scheme_amount_deduct,
            'transport_expiry_breakage'=>$request->transport_expiry_breakage,
            'tot'=>$request->tot,
            'marketing_working_cost'=>$request->marketing_working_cost,
            'company_profit'=>$request->company_profit,
            'percent_profit_to_investment'=>$request->percent_profit_to_investment,
            'marketing_promotion_scheme'=>$request->marketing_promotion_scheme,
            'percent_profit_to_ptr'=>$request->percent_profit_to_ptr,
        ]);
        return redirect()->Route('medicine_master');
    }

    public function edit_transaction(Request $request){
      $this->data['show']= DB::table('add_transactions')->join('add_doctors','add_doctors.id','=','add_transactions.select_doctor')->select('add_transactions.*','add_doctors.name as doctor_name','add_doctors.id as doctors_id')->where('add_transactions.id',$request['id'])->first();
        
            $this->data['filter']=DB::table('add_entries')
            ->select('add_entries.date',DB::raw('SUM(add_entries.grand_total_2)'))
            ->groupByRaw('YEAR(`date`), MONTH(`date`)')
            ->orderByRaw('YEAR(`date`) ASC, MONTH(`date`) ASC')
            ->get();
            // echo json_encode($this->data['filter']);
            //  exit();

        $this->data['doctor_data'] = Add_doctor::get();
      $this->data['edit']= DB::table('add_transactions')->join('add_doctors','add_doctors.id','=','add_transactions.select_doctor')->select('add_transactions.*','add_doctors.name as doctor_name','add_doctors.id as doctors_id')->where('add_transactions.id',$request['id'])->first(); 
        return view('master/superadmin/edit_entry_level_form_transaction',$this->data);
    }
    public function edit_transaction_complete(Request $request){
      $update = Add_transaction::where('id',$request['id'])->update([
            'date'=>$request->date,
            'select_month'=>$request->select_month,
            'select_doctor'=>$request->select_doctor,
            'beneficiary_name'=>$request->beneficiary_name,
            'beneficiary_account'=>$request->beneficiary_account,
            'beneficiary_ifsc'=>$request->beneficiary_ifsc,
            'paypal_amount'=>$request->paypal_amount,
        ]);
        return redirect()->Route('entry_level_form_transaction');
    }
    public function edit_expense_charge_approved(Request $request){
      $update = Expense_entry::where('id',$request['id'])->update([
            'expense_charge_approved'=>$request->expense_charge_approved,]);
      return redirect()->Route('expense_entry');
    }
    public function edit_expense_charge_approved_admin(Request $request){
      $update = Expense_entries_admin::where('id',$request['id'])->update([
            'expense_charge_approved'=>$request->expense_charge_approved_admin,]);
      return redirect()->Route('expense_entry');
    }
    public function edit_entry_level_form1(Request $request){
         $this->data['company_data'] = Add_company::get();
         $this->data['scheme_data'] = Add_scheme::get();
         $this->data['marketing_data'] = Add_marketing::get();
         $this->data['doctor_data'] = Add_doctor::get();

      $this->data['show']= DB::table('add_entries')
        ->where('add_entries.id',$request['id'])
        ->join('add_companies','add_companies.id','=','add_entries.company')
        ->join('add_doctors','add_doctors.id','=','add_entries.doctor_select')
        ->join('add_marketings','add_marketings.id','=','add_entries.scheme_marketing')
        ->select('add_entries.*','add_entries.id as add_entries_id','add_companies.name as company_name','add_companies.id as company_id','add_doctors.name as doctor_name','add_doctors.id as doctor_id','add_marketings.name as marketing_name','add_marketings.id as marketing_id')
        ->first();
        $this->data['show_2']= DB::table('add_entry_details')
        ->where('add_entry_details.add_entries_id',$request['id'])
        ->join('add_medicines','add_medicines.id','=','add_entry_details.medicine')
        ->select('add_entry_details.*','add_entry_details.id as add_entry_details_id','add_medicines.medicine as medicine_name','add_medicines.id as medicine_id')
        ->get();

        return view('master/superadmin/edit_entry_level_form',$this->data);
    }
    public function edit_entry_level_form(Request $request){
         $this->data['company_data'] = Add_company::get();
         $this->data['scheme_data'] = Add_scheme::get();
         $this->data['marketing_data'] = Add_marketing::get();
         $this->data['doctor_data'] = Add_doctor::get();

      $this->data['show']= DB::table('add_entries')
        ->where('add_entries.id',$request['id'])
        ->join('add_companies','add_companies.id','=','add_entries.company')
        ->join('add_doctors','add_doctors.id','=','add_entries.doctor_select')
        ->join('add_marketings','add_marketings.id','=','add_entries.scheme_marketing')
        ->select('add_entries.*','add_entries.id as add_entries_id','add_companies.name as company_name','add_companies.id as company_id','add_doctors.name as doctor_name','add_doctors.id as doctor_id','add_marketings.name as marketing_name','add_marketings.id as marketing_id')
        ->first();
        $this->data['show_2']= DB::table('add_entry_details')
        ->where('add_entry_details.add_entries_id',$request['id'])
        ->join('add_medicines','add_medicines.id','=','add_entry_details.medicine')
        ->select('add_entry_details.*','add_entry_details.id as add_entry_details_id','add_medicines.medicine as medicine_name','add_medicines.id as medicine_id')
        ->get();

$this->data['start_date']=$request->start_date;
$this->data['company']=$request->company;

        return view('master/superadmin/edit_entry_level_form',$this->data);
    }
    public function edit_entry_level_form_complete(Request $request){

      $update = Add_entry::where('id',$request['add_entries_id'])
      ->update([
            'date'=>$request->date,
            'company'=>$request->company,
            'doctor_select'=>$request->doctor_select,
            'scheme_select'=>$request->scheme_select,
            'scheme_marketing'=>$request->scheme_marketing,
            'grand_total_2'=>$request->grand_total_2,
            'grand_total_3'=>$request->grand_total_3,
        ]);
      $temp=count($request['medicine']);
      for ($i = 0; $i < $temp ; $i++) {
        $update = Add_entry_details::where('id',$request['add_entry_details_id'][$i])
        ->update([
            'add_entries_id'=>$request['add_entries_id'],
            'medicine'=>$request['medicine'][$i],
            'gst_rupees'=>$request['gst_rupees'][$i],
            'ptr'=>$request['ptr'][$i],
            'quantity'=>$request['quantity'][$i],
            'marketing_promotion_scheme'=>$request['marketing_promotion_scheme'][$i],
            'total_2'=>$request['total_2'][$i],
            'total_3'=>$request['total_3'][$i],
        ]);
    }
        // return redirect()->Route('sale_entry_level_form');
    if($request['start_date'] && $request['company'])
    {
        return redirect('/sale_entry_level_form_search?start_date='.$request['start_date'].'&company='.$request['company'].'');
    }
    else
    {
        return redirect('/sale_entry_level_form_search');
    }

    }
    

//     public function getmedicinearray(){
//   // $this->data['medicine']=Add_medicine::select('medicine')->get();
//   // $itemdataarray=array();
//   // $n=0;
//   // foreach ($this->data['medicine'] as $medicine) {

//   //     //echo $item['itemname'];
//   //   $itemdataarray[$n]=
//   //   (['medicine'=>$medicine['medicine'],
//   //     'quantity'=> (Add_entry_details::select('quantity')->where('medicine',$medicine['id'])->get())
//   //   ]);

//   //   $n++;
//   // }
//   // $this->data['itemdataarray']=$itemdataarray;
//   // echo json_encode($this->data['itemdataarray']);
//         $login=session()->get('login_data');
//         $login_doctor=session()->get('login_data_doctor');
//         if($login!='') 
//     {   
//                     if($login!='')
//                     {
// $this->data['itemdataarray']=DB::table('add_entry_details')
//   ->join('add_entries','add_entries.id','=','add_entry_details.add_entries_id')
//   ->leftjoin('add_medicines','add_medicines.id','=','add_entry_details.medicine')
//             ->select('add_medicines.medicine','add_medicines.id as medid','add_medicines.default_scheme',DB::raw('sum(add_entry_details.quantity) as total'))
//             ->whereMonth('add_entries.date', Carbon::now()->subMonth()->month)//yaha ek mahine ka dikhane chart me ye code likhe
//             ->groupBy('add_medicines.medicine')//is group by se sare date ke month common hoge to unki addistion kiye 
//             ->get();
//             echo json_encode($this->data['itemdataarray']);
//                     }
//                     else
//                     {
//   $this->data['itemdataarray']=DB::table('add_entry_details')
//   ->join('add_entries','add_entries.id','=','add_entry_details.add_entries_id')
//   ->leftjoin('add_medicines','add_medicines.id','=','add_entry_details.medicine')
//             ->select('add_medicines.medicine','add_medicines.id as medid',DB::raw('sum(add_entry_details.quantity) as total'))
//             ->whereMonth('add_entries.date', Carbon::now()->subMonth()->month)//yaha ek mahine ka dikhane chart me ye code likhe
//             ->where('add_entries.company',$login['select_company'])// This is to show specific  company data 
//             ->groupBy('add_medicines.medicine')//is group by se sare date ke month common hoge to unki addistion kiye 
//             ->get();
//             echo json_encode($this->data['itemdataarray']);
//             }
//         }

//         if($login_doctor!='') 
//         {                     
//   $this->data['itemdataarray']=DB::table('add_entry_details')
//   ->join('add_entries','add_entries.id','=','add_entry_details.add_entries_id')
//   ->leftjoin('add_medicines','add_medicines.id','=','add_entry_details.medicine')
//             ->select('add_medicines.medicine','add_medicines.id as medid',DB::raw('sum(add_entry_details.quantity) as total'))
//             ->whereMonth('add_entries.date', Carbon::now()->subMonth()->month)//yaha ek mahine ka dikhane chart me ye code likhe
//             ->groupBy('add_medicines.medicine')//is group by se sare date ke month common hoge to unki addistion kiye 
//             ->get();
//             echo json_encode($this->data['itemdataarray']);
            
//         }
        
        
//     }


    public function expense_entry_approved(Request $request){
      $this->data['show'] = Expense_entry::where('id',$request['entry_id'])->get();
        echo json_encode($this->data['show']);
    }
    public function expense_entry_approved_admin(Request $request){
      $this->data['show'] = Expense_entries_admin::where('id',$request['entry_id2'])->get();
        echo json_encode($this->data['show']);
    }
    
}