<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Promotor_Sale;
use App\Models\Year;
use App\Models\Addcompany;
use Carbon\carbon;
use App\Models\Otp;
use App\Models\User;
use App\Models\Message;
use App\Models\Image;
use App\Models\Medical;
use PDF;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
	
	
	 public function send_mobile_verify_otp(Request $request)
    {
		 
         $otp = rand(1000, 9999);
       // $otp = rand(1000, 9999);
       // $name = 'Sir/Mam';
        $msg = 'Dear ' . $name . ', Your OTP is ' . $otp . '. Send
           by WEBMEDIA';
        $msg = urlencode($msg);
        $to = $request->mobile;
       // $user->mobile;
        //$request->mobile;
        $data1 = "uname=habitm1&pwd=habitm1&senderid=WMEDIA&to=" .
            $to . "&msg=" . $msg .
            "&route=T&peid=1701159196421355379&tempid=1707161527969328476";
        $ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        if (is_numeric($result)) {
            $data = [
                'status' => true,
                'otp' => $otp,
            ];
        } else {
            $data = [
                'status' => false,
                'error_message' => 'connection error',
            ];
        }
       
        return response()->json($data);
    }
    //public function send_mobile_verify_otp(Request $request)
   // {
      //  $otp = 1234;//default otp
       // return response()->json(['otp'=>$otp]); //this random function will generate number in range of 1000-9999
        //sms send code start
       // $name = 'Sir/Mam';
       // $msg = 'Dear ' . $name . ', Your OTP is ' . $otp . 'Send
          // by WEBMEDIA';
        //$msg = urlencode($msg);
       // $to = $request->mobile;
        //$user->mobile;
        // $request->mobile;
       // $data1 = "uname=habitm1&pwd=habitm1&senderid=WMEDIA&to=" .
            //$to . "&msg=" . $msg .
           // "&route=T&peid=1701159196421355379&tempid=1707161527969328476";
      //  $ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
       // curl_setopt($ch, CURLOPT_POST, true);
       // curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
       // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       // $result = curl_exec($ch);
        // dd($result);
   // return response()->json(['otp'=>$otp]);
   // curl_close($ch);
   // }
    // else {
    //     $data = [
    //         'status' => false,
    //         'error_message' => 'connection error',
    //     ];

    
    // Check User
    public function user_registration(Request $request)
    {
	$default_otp = Otp :: 
	select('otp as default_otp')
	->first();

	$user = Doctor::where('username', '=', $request->username)
	->first();
	if ($user && Hash::check($request->password, $user->password))


{

    $otp = rand('1000', '9999');
    $msg = 'Dear user, Your OTP is'.$otp. 'Send by WEBMEDIA';
    $msg = urlencode($msg);
    $to =$user->mobile;
    $data1 = "uname=habitm1&pwd=habitm1&senderid=WMEDIA&to=" .
            $to . "&msg=" . $msg .
            "&route=T&peid=1701159196421355379&tempid=1707161527969328476";
        $ch = curl_init('http://bulksms.webmediaindia.com/sendsms?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
	return response()->json(['status'=> true,'user'=>$user, 'otp'=>$otp, 'default_otp' => $default_otp]);
    curl_close($ch);
	
    //return response()->json($otp);        } else {
    // dd(1);
    //create new user
}
  
    else{
    return response()->json(['status' => false, 'message' => 'User Not Found']);       

}      
}
    
	
	public function user_registration_for_data(Request $request)
{

$user = Doctor::where('id', '=', $request->doctor_id)->select(
    'allotted_dr_name',
    'hospital_address',
    'mobile',
    'email',
    'promoter_name',
    'account_number',
'password')
->first();

if($user)
{
return response()->json(['status'=> true,'user'=>$user]);

}
else{
return response()->json(['status' => false, 'message' => 'User Not Found']);       

}      
}
  
	
	
	public function admin_login(Request $request)
{
    $user = User::where('email', '=', $request->username)->first();

     if ($user && Hash::check($request->password, $user->password))
{
	
        return response()->json(['status'=>true,'message'=>'Login Successfull']);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
}

	public function get_promotersale_all_data(Request $request)
{
    $get_promotersale_all_data=Promotor_Sale::where('year_id',$request->year)
    ->where('sale_of_month',$request->month)
    ->whereIn('promotorsalemedicine.select_medical_id',explode(',',$request->medical))
    ->whereIn('promotor__sales.select_company_id',explode(',',$request->company))
    ->leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
    ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')

     ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
     ->leftjoin('years','years.id','=','promotor__sales.year_id')
     ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
     ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
     ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
     ->orderby('promotorsalemedicine.id','asc')
    // ->groupby('promotor__sales.select_company_id')
     ->select('stockists.stockist','medicals.medical','promotor__sales.id','promotor__sales.year_id','promotor__sales.sale_of_month','promotor__sales.select_company_id','promotor__sales.select_marketing_id','promotor__sales.select_doctor_id','promotor__sales.select_scheme','promotor__sales.grand_total1','promotor__sales.grand_total2','years.year','addcompanies.Name as company','marketings.name as marketing name','doctors.allotted_dr_name','promotorsalemedicine.*')

      
      ->get()->groupBy('allotted_dr_name')
      ->map(function ($items) {
        $ptrs = $items->sum('qnty_ptr_total');
        $grand_total1 = $items->sum('qnty_mps_total');
          
          return [
              'company' => $items->first()->company,
              'sale_of_month'=>$items->first()->sale_of_month,
              'year'=>$items->first()->year,
              'allotted_dr_name'=>$items->first()->allotted_dr_name,
              'qnty_ptr_total' => round($ptrs),
              'qnty_mps_total' => round($grand_total1),
              'data' => $items,
          ];
      })
      ->values();

     if(count($get_promotersale_all_data)>0){
		
        return response()->json(['status'=>true,'data'=>$get_promotersale_all_data]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
	}
	
    //only user data
public function get_promotor_sale_report11(Request $request){
    $currentMonth = date('F', strtotime('last month'));
    $promotor=Promotor_Sale::where('promotor__sales.select_doctor_id',$request->doctor_id)
   ->where('promotor__sales.sale_of_month', $currentMonth)
    // echo json_encode(DB::raw('MONTH(sale_of_month)'), $currentMonth);
    // exit();
    ->leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
    ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
     ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
     ->leftjoin('years','years.id','=','promotor__sales.year_id')
     ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
     ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
     ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
     ->orderby('promotorsalemedicine.id','asc')
     ->select('stockists.stockist','medicals.medical','promotor__sales.*','years.year','addcompanies.Name as company','marketings.name as marketing name','doctors.allotted_dr_name','promotorsalemedicine.*','promotor__sales.id')
     ->get()->groupBy('company')
      ->map(function ($items) {
          $ptrs = $items->sum('ptrs');
          $grand_total1 = $items->sum('grand_total1');
          
          return [
              'company' => $items->first()->company,
              'sale_of_month'=>$items->first()->sale_of_month,
              'year'=>$items->first()->year,
              'allotted_dr_name'=>$items->first()->allotted_dr_name,
              'ptrs' => round($ptrs),
              'grand_total1' => round($grand_total1),
              'data' => $items,
          ];
      })
      ->values();

     if(!$promotor->isEmpty()){
        return response()->json(['status'=>true,'data'=>$promotor]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
}



public function get_promotor_sale_repor1t(Request $request)
{
    $currentMonth = date('F'); // Get the current month
echo json_encode( $currentMonth);
    $promotor = Promotor_Sale::where('promotor__sales.select_doctor_id', $request->doctor_id)
        ->leftjoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
        ->leftjoin('stockists', 'stockists.id', '=', 'promotorsalemedicine.select_stokist_id')
        ->leftjoin('medicals', 'medicals.id', '=', 'promotorsalemedicine.select_medical_id')
        ->leftjoin('years', 'years.id', '=', 'promotor__sales.year_id')
        ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
        ->leftjoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
        ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
        ->where(DB::raw('MONTH(sale_of_month)'), $currentMonth) // Filter by the current month
        ->orderby('promotorsalemedicine.id', 'asc')
        ->select('stockists.stockist', 'medicals.medical', 'promotor__sales.*', 'years.year', 'addcompanies.Name as company', 'marketings.name as marketing name', 'doctors.allotted_dr_name', 'promotorsalemedicine.*', 'promotor__sales.id')
        ->get()
        ->groupBy('company')
        ->map(function ($items) {
            $ptrs = $items->sum('ptrs');
            $grand_total1 = $items->sum('grand_total1');

            return [
                'company' => $items->first()->company,
                'sale_of_month' => $items->first()->sale_of_month,
                'year' => $items->first()->year,
                'allotted_dr_name' => $items->first()->allotted_dr_name,
                'ptrs' => round($ptrs),
                'grand_total1' => round($grand_total1),
                'data' => $items,
            ];
        })
        ->values();

    if (!$promotor->isEmpty()) {
        return response()->json(['status' => true, 'data' => $promotor]);
    } else {
        return response()->json(['status' => false, 'message' => 'Data not found']);
    }
}


//promotor sale all data

public function get_promotersale_all_old(Request $request)
{
//     $get_promoter_all=Promotor_Sale::where('year_id',$request->year)
//    ->where('sale_of_month',$request->month)
//    ->where('select_doctor_id',$request->doctor_id)
//    ->whereIn('promotorsalemedicine.select_medical_id',explode(',',$request->medical))
//    ->whereIn('promotor__sales.select_company_id',explode(',',$request->company))
//     ->leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
//     ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
//      ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
//      ->leftjoin('years','years.id','=','promotor__sales.year_id')
//      ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
//      ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
//      ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
//      ->orderby('promotorsalemedicine.id','asc')
//     // ->groupby('promotor__sales.select_company_id')
//      ->select('stockists.stockist','medicals.medical','promotor__sales.id','promotor__sales.year_id','promotor__sales.sale_of_month','promotor__sales.select_company_id','promotor__sales.select_marketing_id','promotor__sales.select_doctor_id','promotor__sales.select_scheme','promotor__sales.grand_total1','promotor__sales.grand_total2','years.year','addcompanies.Name as company','marketings.name as marketing name','doctors.allotted_dr_name','promotorsalemedicine.*')

      
//       ->get()->groupBy('company')
//       ->map(function ($items) {
//             $ptrs = $items->sum('qnty_ptr_total');
//          $grand_total1 = $items->sum('qnty_mps_total');
          
//           return [
//               'company' => $items->first()->company,
//               'sale_of_month'=>$items->first()->sale_of_month,
//               'year'=>$items->first()->year,
//               'allotted_dr_name'=>$items->first()->allotted_dr_name,
//               'qnty_ptr_total' => round($ptrs),
//               'qnty_mps_total' => round($grand_total1),
//               'data' => $items,
//           ];
//       })
//       ->values();

$get_promoter_all = Promotor_Sale::where('year_id', $request->year)
    ->where('sale_of_month', $request->month)
    ->where('select_doctor_id', $request->doctor_id)
    // ->whereIn('promotorsalemedicine.select_medical_id', explode(',', $request->medical))
    ->whereIn('promotor__sales.select_company_id', explode(',', $request->company))
    ->leftjoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
    ->leftjoin('stockists', 'stockists.id', '=', 'promotorsalemedicine.select_stokist_id')
    ->leftjoin('medicals', 'medicals.id', '=', 'promotorsalemedicine.select_medical_id')
    ->leftjoin('years', 'years.id', '=', 'promotor__sales.year_id')
    ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
    ->leftjoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
    ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
    ->orderby('promotorsalemedicine.id', 'asc')
    ->select(
        'stockists.stockist',
        'medicals.medical',
        'promotor__sales.id',
        'promotor__sales.year_id',
        'promotor__sales.sale_of_month',
        'promotor__sales.select_company_id',
        'promotor__sales.select_marketing_id',
        'promotor__sales.select_doctor_id',
        'promotor__sales.select_scheme',
        'promotor__sales.grand_total1',
        'promotor__sales.grand_total2',
        'years.year',
        'addcompanies.Name as company',
        'marketings.name as marketing_name',
        'doctors.allotted_dr_name',
        'promotorsalemedicine.*'
    )
    ->get()
    ->groupBy(['sale_of_month', 'year', 'select_company_id', 'select_doctor_id'])
    ->map(function ($items) {
        $qnty_ptr_total = $items->sum('qnty_ptr_total');
        $qnty_mps_total = $items->sum('qnty_mps_total');

        return [
            'sale_of_month' => $items->first()->sale_of_month,
            'year' => $items->first()->year,
            'company' => $items->first()->company,
            'marketing_name' => $items->first()->marketing_name,
            'allotted_dr_name' => $items->first()->allotted_dr_name,
            'qnty_ptr_total' => round($qnty_ptr_total),
            'qnty_mps_total' => round($qnty_mps_total),
            'data' => $items,
        ];
    })
    ->values();


     if(!$get_promoter_all->isEmpty()){
		
        return response()->json(['status'=>true,'data'=>$get_promoter_all]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
}


    //year month company
    public function get_year_month(Request $request)
{
    $get_promoter_all=Promotor_Sale::
    leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
    // ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
    //  ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
     ->leftjoin('years','years.id','=','promotor__sales.year_id')
     ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
    //  ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
     ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
     ->orderby('promotorsalemedicine.id','asc')
     ->select('promotor__sales.sale_of_month','years.year','addcompanies.Name')
     ->get();
     if($get_promoter_all){
        return response()->json(['status'=>true,'data'=>$get_promoter_all]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
	}
	
	public function year()
{
    $year = Year::all();

    if($year)
    {
        return response()->json(['status'=>true,'data'=>$year]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
}
	
	public function company()
{
    $company = Addcompany::
    select('id','Name')
    ->get();

    if($company)
    {
        return response()->json(['status'=>true,'data'=>$company]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
}
	public function get_promotersale_month(Request $request)
{
    $get_promoter_all=Promotor_Sale::where('sale_of_month',Carbon::now()->subMonth()->format('F'))
    ->leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
    ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
     ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
     ->leftjoin('years','years.id','=','promotor__sales.year_id')
     ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
     ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
     ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
     ->orderby('promotorsalemedicine.id','asc')
     
     ->select('stockists.stockist','medicals.medical','promotor__sales.id','promotor__sales.year_id','promotor__sales.sale_of_month','promotor__sales.select_company_id','promotor__sales.select_marketing_id','promotor__sales.select_doctor_id','promotor__sales.select_scheme','promotor__sales.grand_total1','promotor__sales.grand_total2','years.year','addcompanies.Name as company','marketings.name as marketing name','doctors.allotted_dr_name','promotorsalemedicine.*')
     
        ->get()->groupBy('company')
      ->map(function ($items) {
            $ptrs = $items->sum('qnty_ptr_total');
         $grand_total1 = $items->sum('qnty_mps_total');
          
          return [
              'company' => $items->first()->company,
			  'sale_of_month'=>$items->first()->sale_of_month,
              'year'=>$items->first()->year,
              'allotted_dr_name'=>$items->first()->allotted_dr_name,
              'qnty_ptr_total' => round($ptrs),
              'qnty_mps_total' => round($grand_total1),
              'data' => $items,
          ];
      })
      ->values();


     if(!$get_promoter_all->isEmpty()){
        return response()->json(['status'=>true,'data'=>$get_promoter_all]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
}
public function get_doctor_name(Request $request)
{
    $query = Promotor_Sale::when($request->year, function ($query, $year) {
                return $query->where('year_id', $year);
            })
            ->when($request->month, function ($query, $month) {
                return $query->where('sale_of_month', $month);
            })
            ->when($request->company, function ($query, $company) {
                return $query->whereIn('promotor__sales.select_company_id', explode(',', $company));
            })
   ->leftjoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
        ->leftjoin('stockists', 'stockists.id', '=', 'promotorsalemedicine.select_stokist_id')
        ->leftjoin('medicals', 'medicals.id', '=', 'promotorsalemedicine.select_medical_id')
        ->leftjoin('years', 'years.id', '=', 'promotor__sales.year_id')
        ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
        ->leftjoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
        ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
        ->orderby('promotorsalemedicine.id', 'asc')
        ->select('stockists.stockist', 'medicals.medical', 'promotor__sales.id', 'promotor__sales.year_id', 'promotor__sales.sale_of_month', 'promotor__sales.select_company_id', 'promotor__sales.select_marketing_id', 'promotor__sales.select_doctor_id', 'promotor__sales.select_scheme', 'promotor__sales.grand_total1', 'promotor__sales.grand_total2', 'years.year', 'addcompanies.Name as company', 'marketings.name as marketing_name', 'doctors.allotted_dr_name', 'promotorsalemedicine.*');

    $all_records = $query->get()->groupBy('company')->map(function ($items) {
        $ptrs = $items->sum('qnty_ptr_total');
        $grand_total1 = $items->sum('qnty_mps_total');

        return [
            'company' => $items->first()->company,
            'sale_of_month' => $items->first()->sale_of_month,
            'year' => $items->first()->year,
            'allotted_dr_name' => $items->first()->allotted_dr_name,
            'qnty_ptr_total' => round($ptrs),
            'qnty_mps_total' => round($grand_total1),
            'data' => $items,
        ];
    })->values();

    if (!$all_records->isEmpty()) {
        $filtered_records = $query->when($request->doctor_name, function ($query, $doctorName) {
                return $query->where('doctors.allotted_dr_name', 'like', '%' . $doctorName . '%');
            })
            ->get()
            ->groupBy('company')
            ->map(function ($items) {
                $ptrs = $items->sum('qnty_ptr_total');
                $grand_total1 = $items->sum('qnty_mps_total');

                return [
                    'company' => $items->first()->company,
                    'sale_of_month' => $items->first()->sale_of_month,
                    'year' => $items->first()->year,
                    'allotted_dr_name' => $items->first()->allotted_dr_name,
                    'qnty_ptr_total' => round($ptrs),
                    'qnty_mps_total' => round($grand_total1),
                    'data' => $items,
                ];
            })
            ->values();

        if (!$filtered_records->isEmpty()) {
            return response()->json(['status' => true, 'data' => $filtered_records]);
        } else {
            return response()->json(['status' => false, 'message' => 'No data found for the given search parameters']);
        }
    } else {
        return response()->json(['status' => false, 'message' => 'No data found']);
    }
}
	
	 public function marque_msg()
    {
        $marque_msg = Message :: get();

        if ($marque_msg) {
            return response()->json(['status' => true, 'data' => $marque_msg]);
        } else {
            return response()->json(['status' => false, 'message' => 'No data found']);
        }
    }

    public function image()
    {
        $image = Image :: get();

        if ($image) {
            return response()->json(['status' => true, 'data' => $image]);
        } else {
            return response()->json(['status' => false, 'message' => 'No data found']);
        }
    }

    public function get_all_medical()
    {
        $medicals = Medical :: get();

        if ($medicals) {
            return response()->json(['status' => true, 'data' => $medicals]);
        } else {
            return response()->json(['status' => false, 'message' => 'No data found']);
        }
    }

    public function get_all_doctor()
{
    $doctors = Doctor::
    select('id','allotted_dr_name')
    ->get();

    if($doctors)
    {
        return response()->json(['status'=>true,'data'=>$doctors]);
    }else{
        return response()->json(['status'=>false,'message'=>'data not found']);
    }
}

    // public function promotersalereport(request $request){
       
    //     $get_promoter_all=Promotor_Sale::where('year_id',$request->year)
    //     ->where('sale_of_month',$request->month)
    //     ->where('select_doctor_id',$request->doctor_id)
    //     // ->whereIn('promotorsalemedicine.select_medical_id',explode(',',$request->medical))
    //     ->whereIn('promotor__sales.select_company_id',explode(',',$request->company))
    //     ->get();
    //     $sale_month=$get_promoter_all[0]->sale_of_month;
    //     $ids_Array=$get_promoter_all->pluck('id')
    //     ->toArray();

       
    //         $proreport=DB::table('promotor__sales')
      
    //         ->leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
    //         ->leftjoin('years','years.id','=','promotor__sales.year_id')
    //         ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
    //         ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
    //         ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
    
    //         ->whereIn(
            
    //             'promotorsalemedicine.promotor__sales_id',$ids_Array  
    //         )
            
    //         ->orderby('promotorsalemedicine.id','asc')
    //         ->select('promotor__sales.*','years.year','addcompanies.Name','marketings.name','doctors.allotted_dr_name','promotorsalemedicine.*','promotor__sales.id','promotorsalemedicine.id as promotorsalemedicine_id','promotor__sales.select_scheme',
    //         DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
    //         DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
    //         );
        
    //     $proreport=$proreport->get();    
        
        
        

    // // echo json_encode($proreport);
    // // exit();
    //   return view('promotor_sale_summmary',['proreport'=>$proreport, 'promotor_grouped_by_data'=>$get_promoter_all]);
       
    // }

//     public function promotersalereport(Request $request)
// {
//     $get_promoter_all = Promotor_Sale::where('year_id', $request->year)
//         ->where('sale_of_month', $request->month)
//         ->where('select_doctor_id', $request->doctor_id)
//         ->whereIn('promotor__sales.select_company_id', explode(',', $request->company))
//         ->get();
//         // echo json_encode($get_promoter_all);

//     $sale_month =$request->month;
//     $ids_Array = $get_promoter_all->pluck('id')->toArray();

//     $proreport = DB::table('promotor__sales')
//         ->leftjoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
//         ->leftjoin('years', 'years.id', '=', 'promotor__sales.year_id')
//         ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
//         ->leftjoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
//         ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
//         ->whereIn('promotorsalemedicine.promotor__sales_id', $ids_Array)
//         ->orderby('promotorsalemedicine.id', 'asc')
//         ->select(
//             'promotor__sales.*',
//             'years.year',
//             'addcompanies.Name',
//             'marketings.name',
//             'doctors.allotted_dr_name',
//             'promotorsalemedicine.*',
//             'promotor__sales.id',
//             'promotorsalemedicine.id as promotorsalemedicine_id',
//             'promotor__sales.select_scheme',
//             DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
//             DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
//         )
//         ->get();

//         // echo json_encode($proreport);

//     $data = json_decode($proreport, true);

//     $groupedData = collect($data)
//         ->groupBy(function ($item) {
//             return $item['select_stokist_id'] . '|' . $item['select_medical_id'] . '|' . $item['select_marketing_id'] . '|' . $item['sale_of_month'];
//         })
//         ->map(function ($group) {
//             $firstItem = $group->first();

//             $medicineArray = $group
//                 ->groupBy(function ($item) {
//                     return $item['ptrs'] . '|' . $item['mpss'];
//                 })
//                 ->map(function ($groupedItems) {
//                     $firstItem = $groupedItems->first();

//                     return [
//                         'medicine' => $firstItem['select_medicine1'],
//                         'ptrs' => $firstItem['ptrs'],
//                         'mpss' => $firstItem['mpss'],
//                     ];
//                 })
//                 ->values()
//                 ->all();

//             $medicine = $group
//                 ->groupBy(function ($item) {
//                     return $item['ptrs'] . '|' . $item['mpss'];
//                 })
//                 ->map(function ($groupedItems) {
//                     $firstItem = $groupedItems->first();

//                     return [
//                         'medicine' => $firstItem['select_medicine1'],
//                     ];
//                 })
//                 ->pluck('medicine')
//                 ->values()
//                 ->all();

//             return [
//                 'select_stokist_id' => $firstItem['select_stokist_id'],
//                 'select_medical_id' => $firstItem['select_medical_id'],
//                 'select_marketing_id' => $firstItem['select_marketing_id'],
//                 'promotor__sales_id' => $firstItem['promotor__sales_id'],
//                 'select_batchs' => $firstItem['select_batchs'],
//                 'append_no' => $firstItem['append_no'],
//                 'sale_of_month' => $firstItem['sale_of_month'],
//                 'medicine_array' => $medicineArray,
//                 'medicine' => $medicine,
//             ];
//         })
//         ->values()
//         ->all();

//     $collection = collect($proreport);
//     $grouped = $collection->groupBy('select_medicine1');
//     $result = collect();
//     $grouped->each(function ($group) use ($result) {
//         $qntys_sum = $group->sum('qntys');
//         $grandtot1_sum = $group->sum('qnty_mps_total');
//         $grandtot2_sum = $group->sum('qnty_ptr_total');
//         $name = $group->first()->select_medicine1;
//         $item = [
//             'select_medicine1' => $name,
//             'qntys' => $qntys_sum,
//             'qnty_mps_total' => $grandtot1_sum,
//             'qnty_ptr_total' => $grandtot2_sum,
//         ];
//         $result->push($item);
//     });
//     $result = json_decode($result, true);

//     return response()->json([
//         // 'proreport' => $proreport,
//         // 'groupedData' => $groupedData,
//         'summaryData' => $result,
//     ]);
// }


public function promotersalereport(Request $request)
{
    $get_promoter_all = Promotor_Sale::where('year_id', $request->year)
        ->where('sale_of_month', $request->month)
        ->where('select_doctor_id', $request->doctor_id)
        ->whereIn('promotor__sales.select_company_id', explode(',', $request->company))
        ->get();
        echo json_encode($get_promoter_all);

    $sale_month = $request->month;
    $ids_Array = $get_promoter_all->pluck('id')->toArray();

    $proreport = DB::table('promotor__sales')
        ->leftjoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
        ->leftjoin('years', 'years.id', '=', 'promotor__sales.year_id')
        ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
        ->leftjoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
        ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
        ->whereIn('promotorsalemedicine.promotor__sales_id', $ids_Array)
        ->orderby('promotorsalemedicine.id', 'asc')
        ->select(
            'promotor__sales.*',
            'years.year',
            'addcompanies.Name',
            'marketings.name',
            'doctors.allotted_dr_name',
            'promotorsalemedicine.*',
            'promotor__sales.id',
            'promotorsalemedicine.id as promotorsalemedicine_id',
            'promotor__sales.select_scheme',
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
        )
        ->get();

    $data = json_decode($proreport, true);

    $groupedData = collect($data)
        ->groupBy(function ($item) {
            return $item['select_stokist_id'] . '|' . $item['select_medical_id'] . '|' . $item['select_marketing_id'] . '|' . $item['sale_of_month'];
        })
        ->map(function ($group) {
            $firstItem = $group->first();

            $medicineArray = $group
                ->groupBy(function ($item) {
                    return $item['ptrs'] . '|' . $item['mpss'];
                })
                ->map(function ($groupedItems) {
                    $firstItem = $groupedItems->first();

                    return [
                        'medicine' => $firstItem['select_medicine1'],
                        'ptrs' => $firstItem['ptrs'],
                        'mpss' => $firstItem['mpss'],
                    ];
                })
                ->values()
                ->all();

            return [
                'select_stokist_id' => $firstItem['select_stokist_id'],
                'select_medical_id' => $firstItem['select_medical_id'],
                'select_marketing_id' => $firstItem['select_marketing_id'],
                'promotor__sales_id' => $firstItem['promotor__sales_id'],
                'select_batchs' => $firstItem['select_batchs'],
                'append_no' => $firstItem['append_no'],
                'sale_of_month' => $firstItem['sale_of_month'],
                'medicine_array' => $medicineArray,
            ];
        })
        ->values()
        ->all();

    $collection = collect($proreport);
    $grouped = $collection->groupBy('select_medicine1');
    $result = collect();
    $grouped->each(function ($group) use ($result) {
        $qntys_sum = $group->sum('qntys');
        $grandtot1_sum = $group->sum('qnty_mps_total');
        $grandtot2_sum = $group->sum('qnty_ptr_total');
        $name = $group->first()->select_medicine1;
        $item = [
            'select_medicine1' => $name,
            'qntys' => $qntys_sum,
            'qnty_mps_total' => $grandtot1_sum,
            'qnty_ptr_total' => $grandtot2_sum,
        ];
        $result->push($item);
    });
    $result = json_decode($result, true);

   
    $computedData = [];

// for ($i = 0; $i < count($groupedData); $i++) {
//     foreach ($groupedData[$i]['medicine_array'] as $med) {
//         $query = DB::table('promotorsalemedicine')
//             ->leftjoin('promotor__sales', 'promotor__sales.id', '=', 'promotorsalemedicine.promotor__sales_id')
//             ->where([
//                 'select_stokist_id' => $groupedData[$i]['select_stokist_id'],
//                 'select_medical_id' => $groupedData[$i]['select_medical_id'],
//                 'select_medicine1' => $med['medicine'],
//                 'ptrs' => $med['ptrs'],
//                 'mpss' => $med['mpss'],
//                 'promotor__sales.sale_of_month' => $groupedData[$i]['sale_of_month'],
//             ]);

//         $result = $query->get();
//         $qnty_mps_total = $result->sum('qnty_mps_total');
//         $qnty_ptr_total = $result->sum('qnty_ptr_total');
//         $qntys = $result->sum('qntys');
//         $ptrs = $med['ptrs'];
//         $mpss = $med['mpss'];
//         // $medicine = $med['medicine'];

//         // Add the code to use the computed values as needed
//         $computedData[] = [
//             'qnty_mps_total' => $qnty_mps_total,
//             'qnty_ptr_total' => $qnty_ptr_total,
//             'qntys' => $qntys,
//             'ptrs' => $ptrs,
//             'mpss' => $mpss,
//             // 'medicine' => $medicine,
//         ];
//     }
// }

    return response()->json([
        'status' => true,
        'summaryData' => $result,
         'data' => $computedData,
          //'groupedData' => $groupedData,
    ]);
}

    
public function all_data(Request $request)
{
    //  $selected_month = \Carbon\Carbon::now()->subMonth()->format('F');
     
     $selected_month = $request->month;
     $promotor_sale_report = Promotor_Sale::where('promotor__sales.year_id',$request->year)
     ->where('promotor__sales.sale_of_month',$selected_month)
    //  ->where('promotor__sales.select_company_id',$request->company)
     ->whereIn('promotor__sales.select_company_id',explode(',',$request->company))
    ->where('promotor__sales.select_doctor_id',$request->doctor_id)
     ->leftJoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
     ->leftJoin('stockists', 'stockists.id', '=', 'promotorsalemedicine.select_stokist_id')
     ->leftJoin('medicals', 'medicals.id', '=', 'promotorsalemedicine.select_medical_id')
     ->leftJoin('years', 'years.id', '=', 'promotor__sales.year_id')
     ->leftJoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
     ->leftJoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
     ->leftJoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
     ->select(
         'stockists.stockist',
         'medicals.medical',
         'promotor__sales.*',
         'years.year',
         'addcompanies.Name',
         'marketings.name',
         'doctors.allotted_dr_name',
         'doctors.mobile',
         'doctors.promoter_name',
         'promotorsalemedicine.*',
         'promotor__sales.id',
         DB::raw("(SELECT ROUND(SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END), 2) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
         DB::raw("(SELECT ROUND(SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total2 ELSE 0 END), 2) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),


         
     )
     ->groupBy([
         'doctors.allotted_dr_name',
         'addcompanies.Name',
         'promotor__sales.sale_of_month',
         'promotor__sales.year_id',
     ]);

   
             $promotor_sale_report=$promotor_sale_report->get();
             
            foreach ($promotor_sale_report as $item) {
                // Calculate TDS value
                $tds_percentage = (float) $item->tds / 100;
                $item->tds_value = round($tds_percentage * (float) $item->total_grand_total1, 2);
            
                // Calculate payable amount after deducting TDS
                $item->payable_amount = round((float) $item->total_grand_total1 - $item->tds_value, 2);
            }
            
  return response()->json([
     'promotor_sale_report'=>$promotor_sale_report
  ]);
            
          
}

public function pdf(Request $request) {
    $promotor_sale = Promotor_Sale::where('id', $request->id)->first();

    $promotor_grouped_by_data = Promotor_Sale::where('sale_of_month', $promotor_sale->sale_of_month)
        ->where('select_doctor_id', $promotor_sale->select_doctor_id)
        ->where('select_company_id', $promotor_sale->select_company_id)
        ->get();

    $sale_month = $promotor_grouped_by_data[0]->sale_of_month;
    $ids_Array = $promotor_grouped_by_data->pluck('id')->toArray();

    $proreport = DB::table('promotor__sales')
        ->leftjoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
        ->leftjoin('years', 'years.id', '=', 'promotor__sales.year_id')
        ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
        ->leftjoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
        ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
        ->whereIn('promotorsalemedicine.promotor__sales_id', $ids_Array)
        ->orderby('promotorsalemedicine.id', 'asc')
        ->select('promotor__sales.*', 'years.year', 'addcompanies.Name', 'marketings.name', 'doctors.allotted_dr_name', 'promotorsalemedicine.*', 'promotor__sales.id', 'promotorsalemedicine.id as promotorsalemedicine_id',
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
        )
        ->get();

    // Generate PDF using the PDF library, e.g., Dompdf or Snappy PDF
    $pdf = PDF::loadView('api_view_for_promotor_sale_report_for_admin',['proreport'=>$proreport, 'promotor_grouped_by_data'=>$promotor_grouped_by_data]);
// echo json_encode($pdf);
// exit();
    // You can customize the PDF file name here
    $filename = 'promotor_sale_report.pdf';

    // Download the PDF file
    return $pdf->download($filename);
}

public function get_promotersale_summary_data(Request $request)
{
    $promotor_sale = Promotor_Sale::where('id', $request->id)->first();

    $promotor_grouped_by_data = Promotor_Sale::where('sale_of_month', $promotor_sale->sale_of_month)
        ->where('select_doctor_id', $promotor_sale->select_doctor_id)
        ->where('select_company_id', $promotor_sale->select_company_id)
        ->get();

    $sale_month = $promotor_grouped_by_data[0]->sale_of_month;
    $ids_Array = $promotor_grouped_by_data->pluck('id')->toArray();

    // echo json_encode($ids_Array);

    $proreport = DB::table('promotor__sales')
        ->leftjoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
        ->leftjoin('years', 'years.id', '=', 'promotor__sales.year_id')
        ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
        ->leftjoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
        ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
        ->whereIn('promotorsalemedicine.promotor__sales_id', $ids_Array)
        ->orderby('promotorsalemedicine.id', 'asc')
        ->select('promotor__sales.*', 'years.year', 'addcompanies.Name', 'marketings.name', 'doctors.allotted_dr_name', 'promotorsalemedicine.*', 'promotor__sales.id', 'promotorsalemedicine.id as promotorsalemedicine_id',
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
        )
        ->get();
        // echo json_encode($proreport);
    $data = json_decode($proreport, true);
    $groupedData = collect($data)
        ->groupBy(function ($item) {
            return $item['select_stokist_id'] . '|' . $item['select_medical_id'] . '|' . $item['select_marketing_id'] . '|' . $item['sale_of_month'];
        })
        ->map(function ($group) {
            $firstItem = $group->first();
            $medicineArray = $group
                ->groupBy(function ($item) {
                    return $item['ptrs'] . '|' . $item['mpss'];
                })
                ->map(function ($groupedItems) {
                    $firstItem = $groupedItems->first();
                    return [
                        'medicine' => $firstItem['select_medicine1'],
                        'ptrs' => $firstItem['ptrs'],
                        'mpss' => $firstItem['mpss'],
                    ];
                })
                ->values()
                ->all();
            $medicine = $group
                ->groupBy(function ($item) {
                    return $item['ptrs'] . '|' . $item['mpss'];
                })
                ->map(function ($groupedItems) {
                    $firstItem = $groupedItems->first();
                    return [
                        'medicine' => $firstItem['select_medicine1'],
                    ];
                })
                ->pluck('medicine')
                ->values()
                ->all();
            return [
                'select_stokist_id' => $firstItem['select_stokist_id'],
                'select_medical_id' => $firstItem['select_medical_id'],
                'select_marketing_id' => $firstItem['select_marketing_id'],
                'promotor__sales_id' => $firstItem['promotor__sales_id'],
                'select_batchs' => $firstItem['select_batchs'],
                'append_no' => $firstItem['append_no'],
                'sale_of_month' => $firstItem['sale_of_month'],
                'medicine_array' => $medicineArray,
                'medicine' => $medicine,
            ];
        })
        ->values()
        ->all();
    $collection = collect($proreport);
    $grouped = $collection->groupBy('select_medicine1');
    $result = collect();
    $grouped->each(function ($group) use ($result) {
        $qntys_sum = $group->sum('qntys');
        $grandtot1_sum = $group->sum('qnty_mps_total');
        $grandtot2_sum = $group->sum('qnty_ptr_total');
        $name = $group->first()->select_medicine1;
        $item = [
            'select_medicine1' => $name,
            'qntys' => $qntys_sum,
            'qnty_mps_total' => $grandtot1_sum,
            'qnty_ptr_total' => $grandtot2_sum,
        ];
        $result->push($item);
    });
    $result = json_decode($result, true);

//  $pdf = PDF::loadView('api_view_for_promotor_sale_report_for_admin',['proreport'=>$proreport, 'promotor_grouped_by_data'=>$promotor_grouped_by_data]);
    
//     $filename = 'promotor_sale_report.pdf';
//     $pdf->download($filename);

    // Download the PDF file
    return response()->json([
		        'status' => true,
        'summaryData' => $result,
    ]);
}



public function get_promotersale_summary_data_for_doctor(Request $request)
{
    $promotor_sale = Promotor_Sale::where('id', $request->id)->first();

    $promotor_grouped_by_data = Promotor_Sale::where('sale_of_month', $promotor_sale->sale_of_month)
        ->where('select_doctor_id', $promotor_sale->select_doctor_id)
        ->where('select_company_id', $promotor_sale->select_company_id)
        ->get();

    $sale_month = $promotor_grouped_by_data[0]->sale_of_month;
    $ids_Array = $promotor_grouped_by_data->pluck('id')->toArray();

    // echo json_encode($ids_Array);

    $proreport = DB::table('promotor__sales')
        ->leftjoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
        ->leftjoin('years', 'years.id', '=', 'promotor__sales.year_id')
        ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
        ->leftjoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
        ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
        ->whereIn('promotorsalemedicine.promotor__sales_id', $ids_Array)
        ->orderby('promotorsalemedicine.id', 'asc')
        ->select('promotor__sales.*', 'years.year', 'addcompanies.Name', 'marketings.name', 'doctors.allotted_dr_name', 'promotorsalemedicine.*', 'promotor__sales.id', 'promotorsalemedicine.id as promotorsalemedicine_id',
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
        )
        ->get();
        // echo json_encode($proreport);
    $data = json_decode($proreport, true);
    $groupedData = collect($data)
        ->groupBy(function ($item) {
            return $item['select_stokist_id'] . '|' . $item['select_medical_id'] . '|' . $item['select_marketing_id'] . '|' . $item['sale_of_month'];
        })
        ->map(function ($group) {
            $firstItem = $group->first();
            $medicineArray = $group
                ->groupBy(function ($item) {
                    return $item['ptrs'] . '|' . $item['mpss'];
                })
                ->map(function ($groupedItems) {
                    $firstItem = $groupedItems->first();
                    return [
                        'medicine' => $firstItem['select_medicine1'],
                        'ptrs' => $firstItem['ptrs'],
                        'mpss' => $firstItem['mpss'],
                    ];
                })
                ->values()
                ->all();
            $medicine = $group
                ->groupBy(function ($item) {
                    return $item['ptrs'] . '|' . $item['mpss'];
                })
                ->map(function ($groupedItems) {
                    $firstItem = $groupedItems->first();
                    return [
                        'medicine' => $firstItem['select_medicine1'],
                    ];
                })
                ->pluck('medicine')
                ->values()
                ->all();
            return [
                'select_stokist_id' => $firstItem['select_stokist_id'],
                'select_medical_id' => $firstItem['select_medical_id'],
                'select_marketing_id' => $firstItem['select_marketing_id'],
                'promotor__sales_id' => $firstItem['promotor__sales_id'],
                'select_batchs' => $firstItem['select_batchs'],
                'append_no' => $firstItem['append_no'],
                'sale_of_month' => $firstItem['sale_of_month'],
                'medicine_array' => $medicineArray,
                'medicine' => $medicine,
            ];
        })
        ->values()
        ->all();
    $collection = collect($proreport);
    $grouped = $collection->groupBy('select_medicine1');
    $result = collect();
    $grouped->each(function ($group) use ($result) {
        $qntys_sum = $group->sum('qntys');
        $grandtot1_sum = $group->sum('qnty_mps_total');
        $grandtot2_sum = $group->sum('qnty_ptr_total');
        $name = $group->first()->select_medicine1;
        $item = [
            'select_medicine1' => $name,
            'qntys' => $qntys_sum,
            'qnty_mps_total' => $grandtot1_sum,
            'qnty_ptr_total' => $grandtot2_sum,
        ];
        $result->push($item);
    });
    $result = json_decode($result, true);

//  $pdf = PDF::loadView('api_view_for_promotor_sale_report_for_admin',['proreport'=>$proreport, 'promotor_grouped_by_data'=>$promotor_grouped_by_data]);
    
//     $filename = 'promotor_sale_report.pdf';
//     $pdf->download($filename);

    // Download the PDF file
    return response()->json([
		        'status' => true,
        'summaryData' => $result,
    ]);
}
	
	public function get_promotor_data_for_doctor(Request $request)
{
    //  $selected_month = \Carbon\Carbon::now()->subMonth()->format('F');
     
     $selected_month = $request->month;
     $promotor_sale_report = Promotor_Sale::where('promotor__sales.year_id',$request->year)
     ->where('promotor__sales.sale_of_month',$selected_month)
    //  ->where('promotor__sales.select_company_id',$request->company)
     ->whereIn('promotor__sales.select_company_id',explode(',',$request->company))
    // ->where('promotor__sales.select_doctor_id',$request->doctor)
     ->leftJoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
     ->leftJoin('stockists', 'stockists.id', '=', 'promotorsalemedicine.select_stokist_id')
     ->leftJoin('medicals', 'medicals.id', '=', 'promotorsalemedicine.select_medical_id')
     ->leftJoin('years', 'years.id', '=', 'promotor__sales.year_id')
     ->leftJoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
     ->leftJoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
     ->leftJoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
     ->select(
         'stockists.stockist',
         'medicals.medical',
         'promotor__sales.*',
         'years.year',
         'addcompanies.Name',
         'marketings.name',
         'doctors.allotted_dr_name',
         'doctors.mobile',
         'doctors.promoter_name',
         'promotorsalemedicine.*',
         'promotor__sales.id',
         DB::raw("(SELECT ROUND(SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END), 2) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
         DB::raw("(SELECT ROUND(SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total2 ELSE 0 END), 2) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
         
     )
     ->groupBy([
         'doctors.allotted_dr_name',
         'addcompanies.Name',
         'promotor__sales.sale_of_month',
         'promotor__sales.year_id',
     ]);

   
             $promotor_sale_report=$promotor_sale_report->get();
             
              foreach ($promotor_sale_report as $item) {
                // Calculate TDS value
                $tds_percentage = (float) $item->tds / 100;
                $item->tds_value = round($tds_percentage * (float) $item->total_grand_total1, 2);
            
                // Calculate payable amount after deducting TDS
                $item->payable_amount = round((float) $item->total_grand_total1 - $item->tds_value, 2);
            }

            if(!$promotor_sale_report->isEmpty()){
		
                        return response()->json(['status'=>true,'promotor_sale_report'=>$promotor_sale_report]);
                    }else{
                        return response()->json(['status'=>false,'message'=>'data not found']);
                    }        
          
}

public function doctor_search_by_name(Request $request)
{
            
     $selected_month = $request->month;
     $promotor_sale_report = Promotor_Sale::where('promotor__sales.year_id',$request->year)
     ->where('promotor__sales.sale_of_month',$selected_month)
     ->whereIn('promotor__sales.select_company_id',explode(',',$request->company))
     ->Where('allotted_dr_name', 'like', '%' . $request->doctor_name . '%')
     ->leftJoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
     ->leftJoin('stockists', 'stockists.id', '=', 'promotorsalemedicine.select_stokist_id')
     ->leftJoin('medicals', 'medicals.id', '=', 'promotorsalemedicine.select_medical_id')
     ->leftJoin('years', 'years.id', '=', 'promotor__sales.year_id')
     ->leftJoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
     ->leftJoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
     ->leftJoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
     ->select(
         'stockists.stockist',
         'medicals.medical',
         'promotor__sales.*',
         'years.year',
         'addcompanies.Name',
         'marketings.name',
         'doctors.allotted_dr_name',
         'doctors.mobile',
         'doctors.promoter_name',
         'promotorsalemedicine.*',
         'promotor__sales.id',
         DB::raw("(SELECT ROUND(SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END), 2) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
         DB::raw("(SELECT ROUND(SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total2 ELSE 0 END), 2) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
         
     )
     ->groupBy([
         'doctors.allotted_dr_name',
         'addcompanies.Name',
         'promotor__sales.sale_of_month',
         'promotor__sales.year_id',
     ]);

   
             $promotor_sale_report=$promotor_sale_report->get();
             
              foreach ($promotor_sale_report as $item) {
                // Calculate TDS value
                $tds_percentage = (float) $item->tds / 100;
                $item->tds_value = round($tds_percentage * (float) $item->total_grand_total1, 2);
            
                // Calculate payable amount after deducting TDS
                $item->payable_amount = round((float) $item->total_grand_total1 - $item->tds_value, 2);
            }

            if(!$promotor_sale_report->isEmpty()){
		
                        return response()->json(['status'=>true,'promotor_sale_report'=>$promotor_sale_report]);
                    }else{
                        return response()->json(['status'=>false,'message'=>'data not found']);
                    }        
          
}

public function processData(Request $request)
{
    $promotor_sale = Promotor_Sale::where('id', $request->id)->first();

    $promotor_grouped_by_data = Promotor_Sale::where('sale_of_month', $promotor_sale->sale_of_month)
        ->where('select_doctor_id', $promotor_sale->select_doctor_id)
        ->where('select_company_id', $promotor_sale->select_company_id)
        ->get();

    $sale_month = $promotor_grouped_by_data[0]->sale_of_month;
    $ids_Array = $promotor_grouped_by_data->pluck('id')->toArray();

    // echo json_encode($ids_Array);

    $proreport = DB::table('promotor__sales')
        ->leftjoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
        ->leftjoin('years', 'years.id', '=', 'promotor__sales.year_id')
        ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
        ->leftjoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
        ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
        ->whereIn('promotorsalemedicine.promotor__sales_id', $ids_Array)
        ->orderby('promotorsalemedicine.id', 'asc')
        ->select('promotor__sales.*', 'years.year', 'addcompanies.Name', 'marketings.name', 'doctors.allotted_dr_name', 'promotorsalemedicine.*', 'promotor__sales.id', 'promotorsalemedicine.id as promotorsalemedicine_id',
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
        )
        ->get();
        // echo json_encode($proreport);
    $data = json_decode($proreport, true);
    $groupedData = collect($data)
        ->groupBy(function ($item) {
            return $item['select_stokist_id'] . '|' . $item['select_medical_id'] . '|' . $item['select_marketing_id'] . '|' . $item['sale_of_month'];
        })
        ->map(function ($group) {
            $firstItem = $group->first();
            $medicineArray = $group
                ->groupBy(function ($item) {
                    return $item['ptrs'] . '|' . $item['mpss'];
                })
                ->map(function ($groupedItems) {
                    $firstItem = $groupedItems->first();
                    return [
                        'medicine' => $firstItem['select_medicine1'],
                        'ptrs' => $firstItem['ptrs'],
                        'mpss' => $firstItem['mpss'],
                    ];
                })
                ->values()
                ->all();
            $medicine = $group
                ->groupBy(function ($item) {
                    return $item['ptrs'] . '|' . $item['mpss'];
                })
                ->map(function ($groupedItems) {
                    $firstItem = $groupedItems->first();
                    return [
                        'medicine' => $firstItem['select_medicine1'],
                    ];
                })
                ->pluck('medicine')
                ->values()
                ->all();
            return [
                'select_stokist_id' => $firstItem['select_stokist_id'],
                'select_medical_id' => $firstItem['select_medical_id'],
                'select_marketing_id' => $firstItem['select_marketing_id'],
                'promotor__sales_id' => $firstItem['promotor__sales_id'],
                'select_batchs' => $firstItem['select_batchs'],
                'append_no' => $firstItem['append_no'],
                'sale_of_month' => $firstItem['sale_of_month'],
                'medicine_array' => $medicineArray,
                'medicine' => $medicine,
            ];
        })
        ->values()
        ->all();
    $collection = collect($proreport);
    $grouped = $collection->groupBy('select_medicine1');
    $result = collect();
    $grouped->each(function ($group) use ($result) {
        $qntys_sum = $group->sum('qntys');
        $grandtot1_sum = $group->sum('qnty_mps_total');
        $grandtot2_sum = $group->sum('qnty_ptr_total');
        $name = $group->first()->select_medicine1;
        $item = [
            'select_medicine1' => $name,
            'qntys' => $qntys_sum,
            'qnty_mps_total' => $grandtot1_sum,
            'qnty_ptr_total' => $grandtot2_sum,
        ];
        $result->push($item);
    });
    $result = json_decode($result, true);

    return response()->json([
		        'status' => true,
                'summaryData' => $result,
                'groupedData' => $groupedData
    ]);
}

public function generateReport(Request $request)
{
     $promotor_sale = Promotor_Sale::where('id', $request->id)->first();

    $promotor_grouped_by_data = Promotor_Sale::where('sale_of_month', $promotor_sale->sale_of_month)
        ->where('select_doctor_id', $promotor_sale->select_doctor_id)
        ->where('select_company_id', $promotor_sale->select_company_id)
        ->get();

    $sale_month = $promotor_grouped_by_data[0]->sale_of_month;
    $ids_Array = $promotor_grouped_by_data->pluck('id')->toArray();

    // echo json_encode($ids_Array);

    $proreport = DB::table('promotor__sales')
        ->leftjoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
        ->leftjoin('years', 'years.id', '=', 'promotor__sales.year_id')
        ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
        ->leftjoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
        ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
        ->whereIn('promotorsalemedicine.promotor__sales_id', $ids_Array)
        ->orderby('promotorsalemedicine.id', 'asc')
        ->select('promotor__sales.*', 'years.year', 'addcompanies.Name', 'marketings.name', 'doctors.allotted_dr_name', 'promotorsalemedicine.*', 'promotor__sales.id', 'promotorsalemedicine.id as promotorsalemedicine_id',
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
        )
        ->get();
        // echo json_encode($proreport);
    $data = json_decode($proreport, true);
    $groupedData = collect($data)
        ->groupBy(function ($item) {
            return $item['select_stokist_id'] . '|' . $item['select_medical_id'] . '|' . $item['select_marketing_id'] . '|' . $item['sale_of_month'];
        })
        ->map(function ($group) {
            $firstItem = $group->first();
            $medicineArray = $group
                ->groupBy(function ($item) {
                    return $item['ptrs'] . '|' . $item['mpss'];
                })
                ->map(function ($groupedItems) {
                    $firstItem = $groupedItems->first();
                    return [
                        'medicine' => $firstItem['select_medicine1'],
                        'ptrs' => $firstItem['ptrs'],
                        'mpss' => $firstItem['mpss'],
                    ];
                })
                ->values()
                ->all();
            $medicine = $group
                ->groupBy(function ($item) {
                    return $item['ptrs'] . '|' . $item['mpss'];
                })
                ->map(function ($groupedItems) {
                    $firstItem = $groupedItems->first();
                    return [
                        'medicine' => $firstItem['select_medicine1'],
                    ];
                })
                ->pluck('medicine')
                ->values()
                ->all();

                $grandtot1 = 0;
                $grandtot2 = 0;
                $query = DB::table('promotorsalemedicine')->where([
                    'promotor__sales_id' => $firstItem['promotor__sales_id'],
                    'select_stokist_id' => $firstItem['select_stokist_id'],
                    'select_medical_id' => $firstItem['select_medical_id'],
                ]);
                // $grandtot1 = $query->sum('qnty_mps_total');
                $grandtot1 = round($query->sum('qnty_mps_total'), 2);
                $grandtot2 = round($query->sum('qnty_ptr_total'), 2);
                // $grandtot2 = $query->sum('qnty_ptr_total');
        
                // $grandtot1 = $query->pluck('qnty_mps_total')->toArray();
                // $grandtot1 = array_sum($grandtot1);
        
                // $grandtot2 = $query->pluck('qnty_ptr_total')->toArray();
                // $grandtot2 = array_sum($grandtot2);
                // $medicine_data = $query->get();

            return [
                'select_stokist_id' => $firstItem['select_stokist_id'],
                'select_medical_id' => $firstItem['select_medical_id'],
                'select_marketing_id' => $firstItem['select_marketing_id'],
                'marketing_name' => $firstItem['name'],
                'promotor__sales_id' => $firstItem['promotor__sales_id'],
                'select_batchs' => $firstItem['select_batchs'],
                'append_no' => $firstItem['append_no'],
                'sale_of_month' => $firstItem['sale_of_month'],
                'medicine_array' => $medicineArray,
                'grandtot1' => $grandtot1, // Include grand total 1
                'grandtot2' => $grandtot2, // Include grand total 2
                // 'medicine' => $medicine,
            ];
        })
        ->values()
        ->all();

    $collection = collect($proreport);
    $grouped = $collection->groupBy('select_medicine1');
    $result = collect();
    $grouped->each(function ($group) use ($result) {
        $qntys_sum = $group->sum('qntys');
        $grandtot1_sum = $group->sum('qnty_mps_total');
        $grandtot2_sum = $group->sum('qnty_ptr_total');
        $name = $group->first()->select_medicine1;
        $item = [
            'select_medicine1' => $name,
            'qntys' => $qntys_sum,
            'qnty_mps_total' => $grandtot1_sum,
            'qnty_ptr_total' => $grandtot2_sum,
        ];
        $result->push($item);
    });
    $result = json_decode($result, true);

    $processedData = [];

    foreach ($groupedData as $i => $data) {
        $processedData[$i] = $this->processMedicineData($data);
    }

    return response()->json([
        'status' => true,
        'summaryData' => $result,
        'groupedData' => $groupedData,
        'processedData' => $processedData
]);
}

private function processMedicineData($data)
    {
        $medicineRows = [];

        foreach ($data['medicine_array'] as $med) {
            $query = DB::table('promotorsalemedicine')
                ->leftJoin('promotor__sales', 'promotor__sales.id', '=', 'promotorsalemedicine.promotor__sales_id')
                ->where([
                    'select_stokist_id' => $data['select_stokist_id'],
                    'select_medical_id' => $data['select_medical_id'],
                    'select_medicine1' => $med['medicine'],
                    'ptrs' => $med['ptrs'],
                    'mpss' => $med['mpss'],
                    'promotor__sales.sale_of_month' => $data['sale_of_month'],
                ]);

            $result = $query->get();
            $qnty_mps_total = $result->sum('qnty_mps_total');
            $qnty_ptr_total = $result->sum('qnty_ptr_total');
            $qntys = $result->sum('qntys');
            $ptrs = $med['ptrs'];
            $mpss = $med['mpss'];

            $medicineRows[] = [
                'medicine' => $med['medicine'],
                'ptrs' => $ptrs,
                'mpss' => $mpss,
                'qntys' => $qntys,
                'qnty_mps_total' => $qnty_mps_total,
                'qnty_ptr_total' => $qnty_ptr_total,
            ];
        }

        return $medicineRows;
//         return response()->json([
//             'status' => true,
//             // 'summaryData' => $result,
//             'medicineRows' => $medicineRows
// ]);
    }

}



// public function get_promotersale_all(Request $request)
// {
//     $get_promoter_all=Promotor_Sale::where('year_id',$request->year)
//    ->where('sale_of_month',$request->month)
//    ->where('select_doctor_id',$request->doctor_id)
// 	->whereIn('promotorsalemedicine.select_medical_id',explode(',',$request->medical))
//      ->whereIn('promotor__sales.select_company_id',explode(',',$request->company))
//     ->leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
//     ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
//      ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
//      ->leftjoin('years','years.id','=','promotor__sales.year_id')
//      ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
//      ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
//      ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
//      ->orderby('promotorsalemedicine.id','asc')
//     // ->groupby('promotor__sales.select_company_id')
//      ->select('stockists.stockist','medicals.medical','promotor__sales.id','promotor__sales.year_id','promotor__sales.sale_of_month','promotor__sales.select_company_id','promotor__sales.select_marketing_id','promotor__sales.select_doctor_id','promotor__sales.select_scheme','promotor__sales.grand_total1','promotor__sales.grand_total2','years.year','addcompanies.Name as company','marketings.name as marketing name','doctors.allotted_dr_name','promotorsalemedicine.*')

      
//       ->get()->groupBy('company')
//       ->map(function ($items) {
//             $ptrs = $items->sum('qnty_ptr_total');
//          $grand_total1 = $items->sum('qnty_mps_total');
          
//           return [
//               'company' => $items->first()->company,
//               'sale_of_month'=>$items->first()->sale_of_month,
//               'year'=>$items->first()->year,
//               'allotted_dr_name'=>$items->first()->allotted_dr_name,
//               'qnty_ptr_total' => round($ptrs),
//               'qnty_mps_total' => round($grand_total1),
//               'data' => $items,
//           ];
//       })
//       ->values();

//      if(!$get_promoter_all->isEmpty()){
		
//         return response()->json(['status'=>true,'data'=>$get_promoter_all]);
//     }else{
//         return response()->json(['status'=>false,'message'=>'data not found']);
//     }
// }
