<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marketing;
use App\Models\Promotormedicine;
use App\Models\Promotor_Sale;
use App\Models\Year;
use App\Models\Addcompany;
use App\Models\Doctor;
use App\Models\Stockist;
use App\Models\Medical;
use App\Models\City;
use App\Models\Newmedicinemaster;
use App\Models\Primary_Sale;
use App\Models\Secondary_Sale;
use Carbon\Carbon;
use Mail;
use DB;

class ReportController extends Controller
{
    
    public function report1(Request $request){
    
     $selected_month = \Carbon\Carbon::now()->subMonth()->format('F');
     

if(isset($request->sale_of_month))
{
    $selected_month = $request->sale_of_month;
}

$stocmed = Promotor_Sale::
leftJoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
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
    DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
    DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
    
)
->groupBy([
    'doctors.allotted_dr_name',
    'addcompanies.Name',
    'promotor__sales.sale_of_month',
    'promotor__sales.year_id',
]);

        if(isset($request->year) && $request->year!=null){
            $stocmed=$stocmed->where('promotor__sales.year_id',$request->year);
        }
        // if($selected_month !== 'All')
        // {
            $stocmed=$stocmed->where('promotor__sales.sale_of_month',$selected_month);
        // }
        if(isset($request->company) && $request->company!=null){
            $stocmed=$stocmed->where('promotor__sales.select_company_id',$request->company);
        }
        if(isset($request->market) && $request->market!=null){
            $stocmed=$stocmed->where('promotor__sales.select_marketing_id',$request->market);
        }
        if(isset($request->doctor) && $request->doctor!=null){
            $stocmed=$stocmed->where('promotor__sales.select_doctor_id',$request->doctor);
        }
       
        if(isset($request->grandtotal1) && $request->grandtotal1!=null){
            $stocmed=$stocmed->where('promotor__sales.grand_total1',$request->grandtotal1);
        }
        if(isset($request->grandtotal2) && $request->grandtotal2!=null){
            $stocmed=$stocmed->where('promotor__sales.grand_total2',$request->grandtotal2);
        }
 
        $stocmed=$stocmed->get();

            // $company = Addcompany::all();
            if (auth()->guard('marketings')->check()) {
                $company = Addcompany::whereIn('id', explode(',', auth()->guard('marketings')->user()->select_company_id))->get();
            } else {
                $company = Addcompany::all();
            }
     if (auth()->guard('marketings')->check()) {
                $doctor = Doctor::whereIn('city_id', explode(',', auth()->guard('marketings')->user()->city_id))->get();
            } 
            else {
            $doctor=Doctor::all();
            }
        
            $stockist=Stockist::all();

        $year=Year::all();
       
        // $doctor=Doctor::all();
     
        $medical=Medical::all();
        $promotor=Promotormedicine::all();


        return view('all_report',['stocmed'=>$stocmed,'year'=>$year,'company'=>$company,'market'=>$market,'doctor'=>$doctor,'stockist'=>$stockist,'medical'=>$medical,'promotor'=>$promotor]);
       
}
    
    // public function report(Request $request){

    //     $selectedMonths = $request->input('sale_of_month', []); // Assuming 'sale_of_month' is an array
    
    //     if (empty($selectedMonths)) {
    //         $selectedMonths = [\Carbon\Carbon::now()->subMonth()->format('F')];
    //     }
    
    //     $stocmed = Promotor_Sale::leftJoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
    //     ->leftJoin('stockists', 'stockists.id', '=', 'promotorsalemedicine.select_stokist_id')
    //     ->leftJoin('medicals', 'medicals.id', '=', 'promotorsalemedicine.select_medical_id')
    //     ->leftJoin('years', 'years.id', '=', 'promotor__sales.year_id')
    //     ->leftJoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
    //     ->leftJoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
    //     ->leftJoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id');
    
    //     $stocmed = $stocmed
    //         ->select(
    //             'years.year',
    //             'addcompanies.Name',
    //             'doctors.allotted_dr_name',
    //             'promotor__sales.id',
    //             'promotor__sales.sale_of_month',
    //             'promotorsalemedicine.select_medicine1', // Replace with your actual column name for medicine name
    //             DB::raw('SUM(promotorsalemedicine.qntys) as total_quantity') // Replace with your actual column name for quantity
    //         )
    //         ->whereIn('promotor__sales.sale_of_month', $selectedMonths)
    //         ->groupBy([
    //             'doctors.allotted_dr_name',
    //                'addcompanies.Name',
    //             // 'promotor__sales.id',
    //             'promotor__sales.sale_of_month',
    //             'promotor__sales.year_id',
    //            // 'promotorsalemedicine.select_medicine1' // Replace with your actual column name for medicine name
    //         ]);
    
    //     // Your existing filters (company, market, doctor, etc.)
    //     if(isset($request->year) && $request->year!=null){
    //         $stocmed=$stocmed->where('promotor__sales.year_id',$request->year);
    //     }
      
    //     if(isset($request->company) && $request->company!=null){
    //         $stocmed=$stocmed->where('promotor__sales.select_company_id',$request->company);
    //     }
    //     if(isset($request->market) && $request->market!=null){
    //         $stocmed=$stocmed->where('promotor__sales.select_marketing_id',$request->market);
    //     }
    //     if(isset($request->doctor) && $request->doctor!=null){
    //         $stocmed=$stocmed->where('promotor__sales.select_doctor_id',$request->doctor);
    //     }
       
    //     if(isset($request->grandtotal1) && $request->grandtotal1!=null){
    //         $stocmed=$stocmed->where('promotor__sales.grand_total1',$request->grandtotal1);
    //     }
    //     if(isset($request->grandtotal2) && $request->grandtotal2!=null){
    //         $stocmed=$stocmed->where('promotor__sales.grand_total2',$request->grandtotal2);
    //     }

    
    //     $result = $stocmed->get();
    //     // echo json_encode($result);
    //     // exit();
    
    //     $company = Addcompany::all();
    //     $stockist = Stockist::all();
    //     $year = Year::all();
    //     $doctor = Doctor::all();
    //     $medical = Medical::all();
    //     $promotor = Promotormedicine::all();
    
    //     return view('all_report', [
    //         'stocmed' => $result,
    //         'year' => $year,
    //         'company' => $company,
    //         'doctor' => $doctor,
    //         'stockist' => $stockist,
    //         'medical' => $medical,
    //         'promotor' => $promotor
    //     ]);
    // }

    public function report(Request $request)
{
    // $month=[];

    // $sum = Promotor_Sale::join('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
    // ->join('newmedicinemaster', 'newmedicinemaster.medicine_id', '=', 'promotorsalemedicine.select_medicine1')
    // ->where('promotorsalemedicine.select_medicine1', 'CARMILOSE')
    // ->where('promotor__sales.year_id', 2)
    // ->whereIn('promotor__sales.sale_of_month', ['July', 'August', 'September'])
    // ->selectRaw('SUM(promotorsalemedicine.qnty_mps_total) as total_qntys')
    // ->first()->total_qntys;


    // dump($sum);
    // exit();

    // $currentMonth = date('F');

    // if(in_Array($currentMonth,['January','February','March']))
    // {
    //     $month=['January','February','March'];
    // }
    // elseif(in_Array($currentMonth,['April','May','June']))
    // {
    //     $month=['April','May','June'];
    // }
    // elseif(in_Array($currentMonth,['July','August','September']))
    // {
    //     $month=['July','August','September'];
    // } 
    // else
    // {
    //     $month=['October','November','December'];
    // }

//     if(in_Array($currentMonth,['January','February','March','April','May','June']))
//     {
//         $month=['January','February','March','April','May','June'];
//     }
//    else
//     {
//         $month=['July','August','September','October','November','December'];
//     }

    // echo json_encode(in_Array($currentMonth,['January','February','March','April','May','June']));
    // exit();

    
    // if($request->sale_of_month && $request->sale_of_month==1){
    //     $month=['January','February','March'];
    // }if($request->sale_of_month==2){
    //     $month=['April','May','June'];
    // }if($request->sale_of_month==3){
    //     $month=['July','August','September'];
    // }if($request->sale_of_month==4){
    //     $month=['October','November','December'];
    // }

    // if($request->sale_of_month && $request->sale_of_month==1){
    //                 $month=['January','February','March','April','May','June'];
    //     }if($request->sale_of_month==2){
    //                 $month=['July','August','September','October','November','December'];
    //     }
    // $month = array(
    //     date('F'), // Current month
    //     date('F', strtotime('last month')) // Previous month
    // );
    // $month = date('F', strtotime('last month')) . "','" . date('F') ;
    $month = [date('F', strtotime('last month')), date('F')];
// $monthString = implode("','", $month);
    //  echo json_encode($month);
    // exit();
    if(isset($request->sale_of_month))
    {
        $month = $request->sale_of_month;
    }

    $selectedMonths = implode("','", $month);
    // echo json_encode($selectedMonths);
    // exit();
    $year = 2;
if(isset($request->year_id))
{
    $year = $request->year_id;
}
// if(auth()->guard('marketings')->check())
// {
//     $dd = auth()->guard('marketings')->user()->id;
// }
    // dump($request->year_id);
    // exit();
    $stocmed = Promotor_Sale::
    Join('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
    ->Join('newmedicinemaster', 'newmedicinemaster.medicine_id', '=', 'promotorsalemedicine.select_medicine1')
    ->select(
    'promotorsalemedicine.*',
    // 'promotorsalemedicine.id as pm_id',
    'promotor__sales.*',
    'newmedicinemaster.medicine_id'
    ) ;
    

    $stocmed=$stocmed->where('promotor__sales.year_id',$year);
    $stocmed=$stocmed->where('promotor__sales.select_company_id',$request->company_id);
    $stocmed=$stocmed->where('promotor__sales.select_doctor_id',$request->doctor_id);
    if(auth()->guard('marketings')->check())
{
    $stocmed=$stocmed->where('promotor__sales.select_marketing_id',auth()->guard('marketings')->user()->id);
}
    $stocmed=$stocmed->whereIn('promotor__sales.sale_of_month',$month);
        
    $stocmed=$stocmed->distinct()->get();

  
    // 'promotor__sales.year_id',
    // 'promotor__sales.sale_of_month',
    // 'promotor__sales.select_company_id',
    // 'promotor__sales.select_marketing_id',
    // 'promotor__sales.select_doctor_id',
    // 'promotor__sales.select_scheme',
    // 'promotor__sales.grand_total1',
    // 'promotor__sales.grand_total2',
    // 'promotor__sales.tds',

//  echo json_encode($stocmed);
//    exit();
$type = 'qty';
if(isset($request->type) && $request->type!=null )
{
$type= $request->type;
}
    $year = Year::orderby('id','desc')->get();
    // $company = Addcompany::all();
    // $doctor = Doctor::all();
    if (auth()->guard('marketings')->check()) {
        $company = Addcompany::whereIn('id', explode(',', auth()->guard('marketings')->user()->select_company_id))->get();
    } else {
        $company = Addcompany::all();
    }
if (auth()->guard('marketings')->check()) {
        $doctor = Doctor::whereIn('city_id', explode(',', auth()->guard('marketings')->user()->city_id))->get();
    } 
    else {
    $doctor=Doctor::all();
    }

    return view('all_report', [
        'stocmed' => $stocmed,
        'year' => $year,
        'month'=>$month,
        'type'=>$type,
        'company'=>$company,
        'doctor'=>$doctor,
    ]);
}




public function secondary_mix_report(Request $request)
{
  
    $month = [date('F', strtotime('last month')), date('F')];

    if(isset($request->sale_of_month))
    {
        $month = $request->sale_of_month;
    }

    $selectedMonths = implode("','", $month);
   
    $year = $request->year_id;
if(isset($request->year_id))
{
    $year = $request->year_id;
}

 
    $stocmed = Secondary_Sale::
    Join('secondary_medicines', 'secondary_medicines.secondary__sales_id', '=', 'secondary__sales.id')
    ->Join('newmedicinemaster', 'newmedicinemaster.medicine_id', '=', 'secondary_medicines.select_medicine')
    ->select(
    'secondary_medicines.*',
    // 'promotorsalemedicine.id as pm_id',
    'secondary__sales.*',
    'newmedicinemaster.medicine_id'
    ) ;
    

    $stocmed=$stocmed->where('secondary__sales.year_id',$year);
    $stocmed=$stocmed->where('secondary__sales.select_company_id',$request->company_id);
    if(auth()->guard('marketings')->check())
    {
    $stocmed=$stocmed->where('secondary__sales.master_id',auth()->guard('marketings')->user()->id);
    }

        $stocmed=$stocmed->whereIn('secondary__sales.sale_of_month',$month);
        
    $stocmed=$stocmed->distinct()->get();
// echo json_encode($stocmed);
// exit();

$type = 'qty';
if(isset($request->type) && $request->type!=null )
{
$type= $request->type;
}
    $year = Year::orderby('id','desc')->get();
    
    // $company = Addcompany::all();
    if (auth()->guard('marketings')->check()) {
        $company = Addcompany::whereIn('id', explode(',', auth()->guard('marketings')->user()->select_company_id))->get();
    } else {
        $company = Addcompany::all();
    }
    return view('secondary_mix_report', [
        'stocmed' => $stocmed,
        'year' => $year,
        'month'=>$month,
        'type'=>$type,
        'company'=>$company
    ]);
}



// $selected_month = $request->input('month', Carbon::now()->subMonth()->format('F'));
    
// // Define subqueries for total calculations
// $total_grand_total1 = "(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id)";
// $total_grand_total2 = "(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id)";
// $tds_sum = "(SELECT SUM(CASE WHEN pp.sale_of_month = '$selected_month' THEN pp.grand_total1 ELSE 0 END) FROM promotor__sales pp WHERE pp.select_company_id = addcompanies.id AND pp.year_id = years.id)";
// $expense_sum = "(SELECT SUM(CASE WHEN ee.select_month = '$selected_month' THEN expense_entry1s.amount ELSE 0 END) FROM expense_entries ee LEFT JOIN expense_entry1s ON ee.id = expense_entry1s.expense_entry_id WHERE ee.select_company = addcompanies.id AND ee.select_year = years.id)";

// // Base query
// $profit = DB::table('secondary__sales')
//     ->leftJoin('secondary_medicines', 'secondary_medicines.secondary__sales_id', '=', 'secondary__sales.id')
//     ->leftJoin('years', 'years.id', '=', 'secondary__sales.year_id')
//     ->leftJoin('addcompanies', 'addcompanies.id', '=', 'secondary__sales.select_company_id')
//     ->select(
//         'years.year',
//         'addcompanies.Name',
//         'secondary__sales.id as secondary__sales',
//         'secondary__sales.year_id',
//         'secondary__sales.sale_of_month',
//         'secondary__sales.select_company_id',
//         'secondary__sales.grand_total1',
//         'secondary__sales.sale_value_total1',
//         DB::raw($total_grand_total1 . " as total_grand_total1"),
//         DB::raw($total_grand_total2 . " as total_grand_total2"),
//         DB::raw($tds_sum . " as tds_sum"),
//         DB::raw($expense_sum . " as expense_sum")
//     )
//     ->groupBy([
//         'secondary__sales.sale_of_month',
//         'secondary__sales.year_id',
//         'secondary__sales.select_company_id',
//     ]);

// // Filter conditions
// if ($request->filled('year')) {
//     $profit->where('secondary__sales.year_id', $request->year);
// }

// $profit->where('secondary__sales.sale_of_month', $selected_month);

// if ($request->filled('company')) {
//     $profit->where('secondary__sales.select_company_id', $request->company);
// }

// $profit = $profit->get();

// $tds = DB::table('tds')->select('tds')->first();

public function profit_and_loss_mix_report(Request $request)
{
  
    $year = Year::orderby('id', 'desc')->get();
    $company = Addcompany::all();

    // Get selected months
    $selected_months = $request->input('sale_of_month', [Carbon::now()->subMonth()->format('F')]);

    // Ensure selected_months is an array
    if (!is_array($selected_months)) {
        $selected_months = [$selected_months];
    }

    // Initialize an array to hold the profit data for each month
    $monthwise_profits = [];

    // Loop through each selected month
    foreach ($selected_months as $selected_month) {
        // Define subqueries for total calculations
        $total_grand_total1 = "(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id)";
        $total_grand_total2 = "(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id)";
        $tds_sum = "(SELECT SUM(CASE WHEN pp.sale_of_month = '$selected_month' THEN pp.grand_total1 ELSE 0 END) FROM promotor__sales pp WHERE pp.select_company_id = addcompanies.id AND pp.year_id = years.id)";
        $expense_sum = "(SELECT SUM(CASE WHEN ee.select_month = '$selected_month' THEN expense_entry1s.amount ELSE 0 END) FROM expense_entries ee LEFT JOIN expense_entry1s ON ee.id = expense_entry1s.expense_entry_id WHERE ee.select_company = addcompanies.id AND ee.select_year = years.id)";

        // Base query
        $profit = DB::table('secondary__sales')
            ->leftJoin('secondary_medicines', 'secondary_medicines.secondary__sales_id', '=', 'secondary__sales.id')
            ->leftJoin('years', 'years.id', '=', 'secondary__sales.year_id')
            ->leftJoin('addcompanies', 'addcompanies.id', '=', 'secondary__sales.select_company_id')
            ->select(
                'years.year',
                'addcompanies.Name',
                'secondary__sales.id as secondary__sales',
                'secondary__sales.year_id',
                'secondary__sales.sale_of_month',
                'secondary__sales.select_company_id',
                'secondary__sales.grand_total1',
                'secondary__sales.sale_value_total1',
                DB::raw($total_grand_total1 . " as total_grand_total1"),
                DB::raw($total_grand_total2 . " as total_grand_total2"),
                DB::raw($tds_sum . " as tds_sum"),
                DB::raw($expense_sum . " as expense_sum")
            )
            ->where('secondary__sales.sale_of_month', $selected_month)
            ->groupBy([
                'secondary__sales.sale_of_month',
                'secondary__sales.year_id',
                'secondary__sales.select_company_id',
            ]);

        // Filter conditions
        // if ($request->filled('year_id')) {
            $profit->where('secondary__sales.year_id', $request->year_id);
        // }

        // if ($request->filled('company_id')) {
            $profit->where('secondary__sales.select_company_id', $request->company_id);
        // }

        // $months_order = [
        //     'January' => 1,
        //     'February' => 2,
        //     'March' => 3,
        //     'April' => 4,
        //     'May' => 5,
        //     'June' => 6,
        //     'July' => 7,
        //     'August' => 8,
        //     'September' => 9,
        //     'October' => 10,
        //     'November' => 11,
        //     'December' => 12,
        // ];

        
            $profit_data = $profit->get();
            // $profit_data = $profit_data->sort(function ($a, $b) use ($months_order) {
            //     return $months_order[$a->sale_of_month] <=> $months_order[$b->sale_of_month];
            // })->values();

            // $profit_data = $profit->orderBy('year_id', 'desc')
            //           ->orderByRaw("FIELD(sale_of_month, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')")
            //           ->get();


        $monthwise_profits[$selected_month] = $profit_data;
    }

    $tds = DB::table('tds')->select('tds')->first();

    return view('profit_loss_mix_report', compact('monthwise_profits', 'year', 'company', 'tds'));
 
}




    // public function report_qnt_ptr_mps(request $request){
        
    //     $promotor_sale = Promotor_Sale :: where('id',$request->entry_id)
    //     ->first();

    //     $promotor_grouped_by_data = Promotor_Sale :: 
    //     where('sale_of_month',$promotor_sale->sale_of_month)
    //     ->where('select_doctor_id',$promotor_sale->select_doctor_id)
    //     ->where('select_company_id',$promotor_sale->select_company_id)
    //     ->get();
    //     $sale_month=$promotor_grouped_by_data[0]->sale_of_month;
    //     $ids_Array=$promotor_grouped_by_data->pluck('id')
    //     ->toArray();

    //         $proreport=DB::table('promotor__sales')
      
    //         ->leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
    //     //    ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
    //     //     ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
    //         ->leftjoin('years','years.id','=','promotor__sales.year_id')
    //         ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
    //         ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
    //         ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
    
    //         ->whereIn(
            
    //             'promotorsalemedicine.promotor__sales_id',$ids_Array  
    //         )
            
    //         ->orderby('promotorsalemedicine.id','asc');

    //         $proreport = $proreport
    //         ->select(
    //             'years.year',
    //             'addcompanies.Name',
    //             'doctors.allotted_dr_name',
    //             'promotor__sales.id',
    //             'promotor__sales.sale_of_month',
    //             'promotorsalemedicine.select_medicine1', // Replace with your actual column name for medicine name
    //              DB::raw('SUM(promotorsalemedicine.qntys) as total_quantity') // Replace with your actual column name for quantity
               
    //         )
    //         // ->whereIn('promotor__sales.sale_of_month', $sale_month)
    //         ->groupBy([
    //             'doctors.allotted_dr_name',
    //                'addcompanies.Name',
    //             // 'promotor__sales.id',
    //             'promotor__sales.sale_of_month',
    //             'promotor__sales.year_id',
    //            'promotorsalemedicine.select_medicine1' // Replace with your actual column name for medicine name
    //         ]);
    
    //     $proreport=$proreport->get();      

    //   $render_view= view('report_qnt_ptr_mps',['proreport'=>$proreport, 'promotor_grouped_by_data'=>$promotor_grouped_by_data])->render();
       

    //     return response()->json($render_view);
        
    // }


    public function report_qnt_ptr_mps(Request $request)
{
    $promotor_sale = Promotor_Sale::where('id', $request->entry_id)->first();

    $promotor_grouped_by_data = Promotor_Sale::where('sale_of_month', $promotor_sale->sale_of_month)
        ->where('select_doctor_id', $promotor_sale->select_doctor_id)
        ->where('select_company_id', $promotor_sale->select_company_id)
        ->where('year_id', $promotor_sale->year_id)
        ->get();

    $saleMonths = $promotor_grouped_by_data->pluck('sale_of_month')->unique();

    $proreport = DB::table('promotor__sales')
        ->leftjoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
        ->leftjoin('years', 'years.id', '=', 'promotor__sales.year_id')
        ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
        ->leftjoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
        ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
        ->whereIn('promotorsalemedicine.promotor__sales_id', $promotor_grouped_by_data->pluck('id')->toArray())
        ->orderBy('promotorsalemedicine.id', 'asc');

    $proreport = $proreport
        ->select(
            'years.year',
            'addcompanies.Name',
            'doctors.allotted_dr_name',
            'promotor__sales.id',
            'promotor__sales.sale_of_month',
            'promotorsalemedicine.select_medicine1',
            DB::raw('SUM(promotorsalemedicine.qntys) as total_quantity')
        )
        ->groupBy([
            'doctors.allotted_dr_name',
            'addcompanies.Name',
            'promotor__sales.id',
            'promotor__sales.sale_of_month',
            'promotor__sales.year_id',
            'promotorsalemedicine.select_medicine1'
        ]);

    $proreport = $proreport->get();

    $medicinesCount = []; // Initialize an empty array to store medicines count for each month

    foreach ($saleMonths as $month) {
        $medicinesCount[$month] = $proreport->where('sale_of_month', $month)->count();
    }

    $render_view = view('report_qnt_ptr_mps', ['proreport' => $proreport, 'promotor_grouped_by_data' => $promotor_grouped_by_data, 'saleMonths' => $saleMonths, 'medicinesCount' => $medicinesCount,])->render();

    return response()->json($render_view);
}

    public function report_qnt_ptr_mps1(Request $request) {
$type = "";
if($request->type == 'ptr')
{
$type = DB::table('promotorsalemedicine')->pluck('ptrs');
}
elseif($request->type == 'mps')
{
$type = DB::table('promotorsalemedicine')->pluck('mpss');
}
elseif($request->type == 'qnt')
{
$type = DB::table('promotorsalemedicine')->pluck('qntys');
}

        $promotor_sale = Promotor_Sale::where('id', $request->entry_id)->first();
    
        $promotor_grouped_by_data = Promotor_Sale::where('sale_of_month', $promotor_sale->sale_of_month)
            ->where('select_doctor_id', $promotor_sale->select_doctor_id)
            ->where('select_company_id', $promotor_sale->select_company_id)
            ->where('year_id', $promotor_sale->year_id)
            ->get();
    
        $sale_month = $promotor_grouped_by_data[0]->sale_of_month;
        $ids_Array = $promotor_grouped_by_data->pluck('id')->toArray();
    
        $proreport = DB::table('promotor__sales')
            ->leftjoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
            ->leftjoin('years', 'years.id', '=', 'promotor__sales.year_id')
            ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
            ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
            ->whereIn('promotorsalemedicine.promotor__sales_id', $ids_Array)
            ->orderBy('promotorsalemedicine.id', 'asc');
    
    
        $proreport = $proreport->select(
            'years.year',
            'addcompanies.Name',
            'doctors.allotted_dr_name',
            'promotor__sales.id',
            'promotor__sales.sale_of_month',
            'promotorsalemedicine.select_medicine1', // Replace with your actual column name for medicine name
            // DB::raw('SUM(promotorsalemedicine.qntys ) as total_quantity') // Replace with your actual column name for quantity
            // Adjust based on your column names
            DB::raw("SUM(CASE 
            WHEN '$type' = 'ptr' THEN promotorsalemedicine.ptrs 
            WHEN '$type' = 'mps' THEN promotorsalemedicine.mpss 
            WHEN '$type' = 'qnty' THEN promotorsalemedicine.qntys 
            ELSE 0 
        END) as total_quantity")
        )
        ->groupBy([
            'doctors.allotted_dr_name',
            'addcompanies.Name',
            'promotor__sales.sale_of_month',
            'promotor__sales.year_id',
            'promotorsalemedicine.select_medicine1'
        ]);
    
        $proreport = $proreport->get();
    
        $render_view = view('report_qnt_ptr_mps', ['proreport' => $proreport, 'promotor_grouped_by_data' => $promotor_grouped_by_data])->render();
    
        return response()->json($render_view);
    }
    

}
