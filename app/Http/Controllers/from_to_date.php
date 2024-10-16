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

            $company = Addcompany::all();
        
            $stockist=Stockist::all();

        $year=Year::all();
       
        $doctor=Doctor::all();
     
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
    // dd($request->all());
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
    // $selectedMonths = implode("','", $month);
    $year = 2;
if(isset($request->year_id))
{
    $year = $request->year_id;
}

    // dump($request->year_id);
    // exit();
    $stocmed = Promotor_Sale::
    leftJoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
    ->leftJoin('newmedicinemaster', 'newmedicinemaster.medicine_id', '=', 'promotorsalemedicine.select_medicine1')
    ->select(
    'promotorsalemedicine.*',
    'promotor__sales.*',
    'newmedicinemaster.medicine_id'
    ) ;
    
    // if(isset($request->year) && $request->year!=null){
        $stocmed=$stocmed->where('promotor__sales.year_id',$year);
        $stocmed=$stocmed->where('promotor__sales.select_doctor_id',$request->doctor_id);
        $stocmed=$stocmed->where('promotor__sales.select_company_id',$request->company_id);
    // }

        // $stocmed=$stocmed->whereIn('promotor__sales.sale_of_month',$month);
        if(isset($request->from_date) && isset($request->to_date)){
                $stocmed= $stocmed->whereDate('promotor__sales.created_at','<=',$request->to_date)
                    ->whereDate('promotor__sales.created_at','>=',$request->from_date);     
            }
    
    $stocmed=$stocmed->get();

  

//  echo json_encode($stocmed);
//     exit();
$type = 'qty';
if(isset($request->type) && $request->type!=null )
{
$type= $request->type;
}
    $year = Year::all();
    $company = Addcompany::all();
    $doctor = Doctor::all();

    $fromDate = Carbon::parse($request->from_date);
    $toDate = Carbon::parse($request->to_date);
    $fmonth = $fromDate->format('F');
    $tmonth = $toDate->format('F');
    return view('all_report', [
        'stocmed' => $stocmed,
        'year' => $year,
        // 'month'=>$month,
        'type'=>$type,
        'company'=>$company,
        'doctor'=>$doctor,
        'fmonth' => $fmonth,
        'tmonth' => $tmonth,
    ]);
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
