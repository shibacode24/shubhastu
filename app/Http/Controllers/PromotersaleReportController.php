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
use App\Models\Tds;
use Mail;
use PDF;
use Illuminate\Support\Facades\DB;
use Hash;
use Illuminate\Support\Collection;

class PromotersaleReportController extends Controller
{
    public function index(Request $request){

       // Promotormedicine::where('id','>=',240)->take(5)->update(['append_no'=>3]);
        $stocmed=Promotor_Sale::
      
       leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
       ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
        ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
        ->leftjoin('years','years.id','=','promotor__sales.year_id')
        ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
        ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
        ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
        ->select('stockists.stockist','medicals.medical','promotor__sales.*','years.year','addcompanies.Name','marketings.name','doctors.allotted_dr_name','promotorsalemedicine.*','promotor__sales.id')
        ->groupby('promotorsalemedicine.promotor__sales_id');
        // ->groupBy('promotorsalemedicine.select_medical_id');
        
        if(isset($request->year) && $request->year!=null){
            $stocmed=$stocmed->where('promotor__sales.year_id',$request->year);
        }
        if(isset($request->sale_of_month) && $request->sale_of_month!=null){
            $stocmed=$stocmed->where('promotor__sales.sale_of_month',$request->sale_of_month);
        }
        if(isset($request->company) && $request->company!=null){
            $stocmed=$stocmed->where('promotor__sales.select_company_id',$request->company);
        }
        if(isset($request->market) && $request->market!=null){
            $stocmed=$stocmed->where('promotor__sales.select_marketing_id',$request->market);
        }
        if(isset($request->doctor) && $request->doctor!=null){
            $stocmed=$stocmed->where('promotor__sales.select_doctor_id',$request->doctor);
        }
        // if(isset($request->stockist) && $request->stockist!=null){
        //     $stocmed=$stocmed->where('promotor__sales.select_doctor_id',$request->stockist);
        // }
        // if(isset($request->medical) && $request->medical!=null){
        //     $stocmed=$stocmed->where('promotor__sales.select_doctor_id',$request->medical);
        // }
        if(isset($request->grandtotal1) && $request->grandtotal1!=null){
            $stocmed=$stocmed->where('promotor__sales.grand_total1',$request->grandtotal1);
        }
        if(isset($request->grandtotal2) && $request->grandtotal2!=null){
            $stocmed=$stocmed->where('promotor__sales.grand_total2',$request->grandtotal2);
        }
        
        $stocmed=$stocmed->orderby('promotor__sales.id','desc')->get();
      
        // ->groupby('select_medical_id');
        
        
    
        $year=Year::all();
        $company=Addcompany::all();
        $market=Marketing::all();
        $doctor=Doctor::all();
        $stockist=Stockist::all();
        $medical=Medical::all();
        $promotor=Promotormedicine::all();
        return view('Promotersalereport',['stocmed'=>$stocmed,'year'=>$year,'company'=>$company,'market'=>$market,'doctor'=>$doctor,'stockist'=>$stockist,'medical'=>$medical,'promotor'=>$promotor
        ]);

    }


      public function promotersalereport(request $request){
        
        $promotor_sale = Promotor_Sale :: where('id',$request->entry_id)
        ->first();

        $promotor_grouped_by_data = Promotor_Sale :: 
        where('sale_of_month',$promotor_sale->sale_of_month)
        ->where('year_id',$promotor_sale->year_id)
        ->where('select_doctor_id',$promotor_sale->select_doctor_id)
        ->where('select_company_id',$promotor_sale->select_company_id)
        ->get();
        $sale_month=$promotor_grouped_by_data[0]->sale_of_month;
        $ids_Array=$promotor_grouped_by_data->pluck('id')
        ->toArray();

        // echo json_encode($promotor_sale);
        // exit();

        if(auth()->guard('marketings')->check())
        {
            $dd = auth()->guard('marketings')->user()->id;
        $proreport=DB::table('promotor__sales')
      
        ->leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
    //    ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
    //     ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
        ->leftjoin('years','years.id','=','promotor__sales.year_id')
        ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
        ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
        ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')

        ->whereIn(
        
            'promotorsalemedicine.promotor__sales_id',$ids_Array  
        )
        
        ->orderby('promotorsalemedicine.id','asc')
        ->select('promotor__sales.*','years.year','addcompanies.Name','marketings.name','doctors.allotted_dr_name','promotorsalemedicine.*','promotor__sales.id','promotorsalemedicine.id as promotorsalemedicine_id',
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.select_marketing_id = $dd) as total_grand_total1"),
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.select_marketing_id = $dd) as total_grand_total2"),
        
        );
        }
        else{
            $proreport=DB::table('promotor__sales')
      
            ->leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
        //    ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
        //     ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
            ->leftjoin('years','years.id','=','promotor__sales.year_id')
            ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
            ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
            ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
    
            ->whereIn(
            
                'promotorsalemedicine.promotor__sales_id',$ids_Array  
            )
            
            ->orderby('promotorsalemedicine.id','asc')
            ->select('promotor__sales.*','years.year','addcompanies.Name','marketings.name','doctors.allotted_dr_name','promotorsalemedicine.*','promotor__sales.id','promotorsalemedicine.id as promotorsalemedicine_id','promotor__sales.select_scheme',
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
            );
        }
        $proreport=$proreport->get();      

    //   $render_view= view('promotor_sale_summary',compact('proreport'))->render();
    // echo json_encode($proreport);
    // exit();
      $render_view= view('promotor_sale_summary',['proreport'=>$proreport, 'promotor_grouped_by_data'=>$promotor_grouped_by_data])->render();
       
        // return response()->json(['proreport'=>$proreport]);

        return response()->json($render_view);
        
    }


public function pdf(Request $request) {
    $promotor_sale = Promotor_Sale::where('id', $request->id)->first();

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
    $pdf = PDF::loadView('promotor_report_pdf',['proreport'=>$proreport, 'promotor_grouped_by_data'=>$promotor_grouped_by_data]);
// echo json_encode($pdf);
// exit();
    // You can customize the PDF file name here
    $filename = 'promotor_sale_report.pdf';

    // Download the PDF file
    return $pdf->download($filename);
}


    public function addsummary(request $request){
        
        $sumary=DB::table('promotor__sales')
      
        ->leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
       ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
        ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
        ->leftjoin('years','years.id','=','promotor__sales.year_id')
        ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
        ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
        ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')

        ->where([
        
            'promotorsalemedicine.promotor__sales_id'=>$request->summary_id 
        ])
        
        ->orderby('promotorsalemedicine.id','asc')
        ->select('stockists.stockist','medicals.medical','promotor__sales.*','years.year','addcompanies.Name','marketings.name','doctors.allotted_dr_name','promotorsalemedicine.*','promotor__sales.id')
    
       
      ->get()->groupBy('select_medicine1');
        // echo json_encode($proreport);
        // exit();
        return response()->json(['sumary'=>$sumary]);
    }



    // public function promotersalereport(request $request){
    //     $proreport=DB::table('promotorsalemedicine')
    //     ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
    //     ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
    //     ->leftjoin('promotor__sales','promotor__sales.id','=','promotorsalemedicine.promotor__sales_id')
    //     ->leftjoin('years','years.id','=','promotor__sales.year_id')
    //     ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
    //     ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
    //     ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
       
        
    //     ->where([
        
    //         'promotorsalemedicine.id'=>$request->entry_id 
    //     ])
        
    //     ->orderby('promotorsalemedicine.id','asc')
    //     ->select('stockists.stockist','medicals.medical','promotor__sales.*','years.year','addcompanies.Name','marketings.name','doctors.allotted_dr_name','promotorsalemedicine.*')
        
    //     ->first();
    //     // echo json_encode($proreport);
    //     // exit();
    //     return response()->json(['proreport'=>$proreport]);
    // }

    public function marketing(Request $request)
  
    {
        $data = Marketing::
        Where('select_company_id', 'like', '%' .  $request->id . '%')
        ->orderby('name', 'asc')->get();
        return response()->json($data);
    }


    // public function destroy($id)
    // {
    //     $delete=Promotormedicine::where('promotor__sales_id',$id)->delete();
        
    //     $city=Promotor_Sale::where('id',$id)->delete();
    //     return redirect()->back();
    // }







//     public function mail_and_downloadpdf(Request $request){
// if($request->action=='mail'){

// $length=count($request->record_id);
// // echo json_encode($request->record_id);
// // exit();
// $promotor_sale = Promotor_Sale :: where('id',$request->record_id)
// ->first();

// $promotor_grouped_by_data = Promotor_Sale :: 
// where('sale_of_month',$promotor_sale->sale_of_month)
// ->where('select_doctor_id',$promotor_sale->select_doctor_id)
// ->where('select_company_id',$promotor_sale->select_company_id)
// ->get();
// $sale_month=$promotor_grouped_by_data[0]->sale_of_month;
// $ids_Array=$promotor_grouped_by_data->pluck('id')
// ->toArray();

//     	for ($i = 0; $i < $length ; $i++) {
      
//             // echo json_encode($ids_Array);
//             //    exit();

//     $stocmed=DB::table('promotor__sales')
      
//     ->leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
// //    ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
// //     ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
//     ->leftjoin('years','years.id','=','promotor__sales.year_id')
//     ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
//     ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
//     ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')

//     ->whereIn(
    
//         'promotorsalemedicine.promotor__sales_id',$ids_Array
//     )
        
//     ->select('promotor__sales.*','years.year','addcompanies.Name','marketings.name','doctors.allotted_dr_name','promotorsalemedicine.*','promotor__sales.id','promotorsalemedicine.id as promotorsalemedicine_id','doctors.email',
//     DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
//     DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
    
// )
        
//       ->get();
     
//     //   dump($request->record_id);
//     //   exit();
  
//       $email_data=[
//         'email'=>$stocmed[0]->email,
//         'name'=>$stocmed[0]->allotted_dr_name,
//       ];
//     // }
//     //   echo json_encode($email_data);
//     //      exit();
//     //   return view('mail',compact('stocmed'));


//         //  echo json_encode($stocmed);
//         // exit();
//         if(isset($stocmed) && !empty($stocmed)){
//         $stocmed2=['stocmed'=>$stocmed];
//         // echo json_encode($stocmed2);
//         // exit();
//         Mail::send('mail', $stocmed2, function($message) use($email_data) {
//            $message->to($email_data['email'], $email_data['name'])->subject
//               ('Shubhastu Mail');
//            $message->from('shubhastu.pharma@gmail.com','Mail From Shubhastu Pharma');
//         });
//     }
// }

public function mail_and_downloadpdf(Request $request)
{
    $request->validate([
        'record_id' => 'required|array|min:1', // Requires 'record_id' to be an array with at least one element
    ], [
        'record_id.required' => 'Please select at least one record.',
        'record_id.min' => 'Please select at least one record.',
    ]);

    if ($request->action == 'mail') {
        $recordIds = $request->record_id; // Assuming $request->record_id is an array of recipient IDs
        // echo json_encode($recordIds);
        // exit();
        foreach ($recordIds as $recordId) {
            // Fetch data for the current recipient based on $recordId
            $promotor_sale = Promotor_Sale::where('id', $recordId)->first();

            // Ensure you have valid data for the email
            if ($promotor_sale) {
                $promotor_grouped_by_data = Promotor_Sale::where('sale_of_month', $promotor_sale->sale_of_month)
                    ->where('select_doctor_id', $promotor_sale->select_doctor_id)
                    ->where('select_company_id', $promotor_sale->select_company_id)
                    ->where('year_id', $promotor_sale->year_id)
                    ->get();

                $sale_month = $promotor_grouped_by_data[0]->sale_of_month;
                $ids_Array = $promotor_grouped_by_data->pluck('id')->toArray();

                // Fetch other relevant data based on $ids_Array and $recordId
                $stocmed=DB::table('promotor__sales')
      
            ->leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
        //    ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
        //     ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
            ->leftjoin('years','years.id','=','promotor__sales.year_id')
            ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
            ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
            ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')

            ->whereIn(
            
                'promotorsalemedicine.promotor__sales_id',$ids_Array
            )
                
            ->select('promotor__sales.*','years.year','addcompanies.Name','marketings.name','doctors.allotted_dr_name','promotorsalemedicine.*','promotor__sales.id','promotorsalemedicine.id as promotorsalemedicine_id','doctors.email',
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
            
        )
                
            ->get();
            $email_data = [
                    'email' => $stocmed[0]->email,
                    'name' => $stocmed[0]->allotted_dr_name,
                ];

                // Check if email data is valid and send the email
                if (isset($stocmed) && !empty($stocmed)) {
                    $stocmed2 = ['stocmed' => $stocmed];
                    
                    // Send email to the current recipient
                    Mail::send('mail', $stocmed2, function ($message) use ($email_data) {
                        $message->to($email_data['email'], $email_data['name'])->subject('Shubhastu Mail');
                        $message->from('shubhastu.pharma@gmail.com', 'Mail From Shubhastu Pharma');
                    });
                }
            }
        }
    }

        return redirect()->back()->with(['success'=>true,'message'=>'Successfully Updated !']);
}
    
    public function destroy($id)
    {
        $delete=Promotormedicine::where('promotor__sales_id',$id)->delete();
        $delete=Promotor_Sale::where('id',$id)->delete();
        return redirect(route('promotorreport'));
    }
    
  
    // public function editpromotorsalereport($id)
    // {
    //     $prosalereportedit = Promotor_Sale::find($id); 
    //     $stocmed=Promotormedicine::where('promotor__sales_id',$id)
      
    //     ->get();
    //     $year=Year::all();
    //     $company=Addcompany::all();
    //     $market=Marketing::all();
    //     $doctor=Doctor::all();
    //     $stockist=Stockist::all();
    //     $medical=Medical::all();
    //     $city=City::all();
    //     $medi=Newmedicinemaster::all();
    //     $batchno=Primary_Sale::all();
    //     return view('editpromotorsale_report',['prosalereportedit'=>$prosalereportedit,'stocmed'=>$stocmed,'year'=>$year,'company'=>$company,'market'=>$market,'doctor'=>$doctor,'stockist'=>$stockist,'medical'=>$medical,'city'=>$city,'medi'=>$medi,'batchno'=>$batchno]);
    //     // return view('editpromotorsale_report',['prosalereportedit'=>$prosalereportedit,'stocmed'=>$stocmed,'year'=>$year,'company'=>$company,'market'=>$market,'doctor'=>$doctor,'stockist'=>$stockist,'medical'=>$medical,'promotor'=>$promotor]);
    // }
   
    // public function updatepromotorsalereport(Request $request){
    //     $promotor = Promotor_Sale::find($request->id);
    //     // $tds = Tds::select('tds')->first();
      
    //     // $promotor->sale_of_month = $request->get('sale_of_month');
    //     // $promotor->select_company_id = $request->get('company');
    //     // $promotor->select_marketing_id = $request->get('market');
    //     // $promotor->select_doctor_id = $request->get('doctor');
    //     // $promotor->select_scheme = $request->get('scheme'); // Corrected typo
        
    //     $promotor->grand_total1 = $request->get('grand_total1');
    //     $promotor->grand_total2 = $request->get('grand_total2');
    //     // $promotor->tds = $tds->tds;
    //     $promotor->save();
    
    //     $insert_id = $promotor->id;
    
    //     for ($i = 0; $i < count($request->stockist); $i++) {
    //         if (isset($request->stockist[$i])) {
    //             $promotormedicine =Promotormedicine::find($request->promed_id); // Corrected to create a new instance
    //             $promotormedicine->promotor__sales_id = $insert_id; // Corrected typo
    
    //             $promotormedicine->select_stokist_id = $request->stockist[$i];
    //             // $promotormedicine->append_no = $request->append_no[$i];
    //             $promotormedicine->select_medical_id = $request->medical[$i];
    //             $promotormedicine->select_medicine1 = $request->medicine[$i];
    //             $promotormedicine->select_batchs = $request->batch[$i];
    //             $promotormedicine->ptrs = $request->ptr1[$i];
    //             $promotormedicine->mpss = $request->mps1[$i];
    //             $promotormedicine->qntys = $request->qnty[$i];
    
    //             $promotormedicine->qnty_mps_total = $request->mpsqnty[$i];
    //             $promotormedicine->qnty_ptr_total = $request->ptrqnty[$i];
    
    //             $promotormedicine->grandtot1 = $request->grandtot1[$i];
    //             $promotormedicine->grandtot2 = $request->grandtot2[$i];
    
    //             $promotormedicine->save();
    //         }
    //     }
        
    //     return redirect()->route('promotorreport')->with(['success' => true, 'message' => 'Successfully Updated!']);
    // }
}    

   




