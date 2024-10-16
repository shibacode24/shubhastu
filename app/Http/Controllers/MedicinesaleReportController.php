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


class MedicinesalereportController extends Controller
{

    public function medicinesalereport(Request $request){
        //Promotormedicine::where('id','>=',240)->take(5)->update(['append_no'=>3]);
    //     $stocmed=Promotor_Sale::
      
    //    leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
    //    ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
    //     ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
    //     ->leftjoin('years','years.id','=','promotor__sales.year_id')
    //     ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
    //     ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
    //     ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
    //     ->select('stockists.stockist','medicals.medical','promotor__sales.*','years.year','addcompanies.Name','marketings.name','doctors.allotted_dr_name','doctors.promoter_name','promotorsalemedicine.*','promotor__sales.id')
    //     ->groupby('promotorsalemedicine.promotor__sales_id');
    // $selected_month = \Carbon\Carbon::now()->format('F');
     $selected_month = \Carbon\Carbon::now()->subMonth()->format('F');
     $year = 3;

if(isset($request->sale_of_month))
{
    $selected_month = $request->sale_of_month;
}

if(isset($request->year_id))
{
    $year = $request->year_id;
}


if(auth()->guard('marketings')->check())
{
    $dd = auth()->guard('marketings')->user()->id;
    $stocmed = Promotor_Sale::where('promotor__sales.select_marketing_id',  auth()->guard('marketings')->user()->id)
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
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.select_marketing_id = $dd) as total_grand_total1"),
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.select_marketing_id = $dd) as total_grand_total2"),
        
   )
    ->groupBy([
        'doctors.allotted_dr_name',
        'addcompanies.Name',
        'promotor__sales.sale_of_month',
        'promotor__sales.year_id',
    ]);
}
else{
$stocmed = Promotor_Sale::leftJoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
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
    DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = $year) as total_grand_total1"),
    DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = $year) as total_grand_total2"),
    
 
)
->groupBy([
    'doctors.allotted_dr_name',
    'addcompanies.Name',
    'promotor__sales.sale_of_month',
    'promotor__sales.year_id',
]);
}
        // ->groupby('promotor__sales.year_id');
        // ->groupBy('promotorsalemedicine.select_medical_id');
        
        
        
        // if(isset($request->year) && $request->year!=null){
            $stocmed=$stocmed->where('promotor__sales.year_id',$year);
        // }
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

        // if (auth()->guard('marketings')->check()) {
        //     $stocmed = $stocmed->where('promotor__sales.select_marketing_id', auth()->guard('marketings')->user()->id);
        // }
        
        $stocmed=$stocmed->get();

        // $users = $stocmed->paginate(50);

        // dump($stocmed);
        // exit();

        if (auth()->guard('marketings')->check()) {
            $company = Addcompany::whereIn('id', explode(',', auth()->guard('marketings')->user()->select_company_id))->get();
        } else {
            $company = Addcompany::all();
        }

        // echo json_encode($company);
        // exit();
        if (auth()->guard('marketings')->check()) {
            $market = Marketing::whereIn('id', explode(',', auth()->guard('marketings')->user()->id))->get();
        } 
        else {
            $market = [];
        }
       
        if (auth()->guard('marketings')->check()) {
            $stockist = Stockist::whereIn('city_id', explode(',', auth()->guard('marketings')->user()->city_id))->get();
        } 
        else {
            $stockist=Stockist::all();

        }

        $year = Year::orderBy('id', 'desc')->get();
       
        //$doctor=Doctor::all();

        if (auth()->guard('marketings')->check()) {
            $doctor = Doctor::whereIn('city_id', explode(',', auth()->guard('marketings')->user()->city_id))->get();
        } 
        else {
        $doctor=Doctor::all();
        }
     
        $medical=Medical::all();
       
        return view('medicinesale_report',['stocmed'=>$stocmed,'year'=>$year,'company'=>$company,'market'=>$market,'doctor'=>$doctor,'stockist'=>$stockist,'medical'=>$medical]);
       
    }


    public function mail_medicinesalereport(Request $request){
        if($request->action=='mail'){
        
        $length=count($request->record_id);
        // echo json_encode($request->record_id);
        // exit();
                for ($i = 0; $i < $length ; $i++) {
                  
            $stocmed=DB::table('promotor__sales')
              
                ->leftjoin('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
               ->leftjoin('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
                ->leftjoin('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
                ->leftjoin('years','years.id','=','promotor__sales.year_id')
                ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
                ->leftjoin('marketings','marketings.id','=','promotor__sales.select_marketing_id')
                ->leftjoin('doctors','doctors.id','=','promotor__sales.select_doctor_id')
        
                ->where([
                
                    'promotorsalemedicine.promotor__sales_id'=>$request->record_id[$i] 
                ])
                
                ->orderby('promotorsalemedicine.id','asc')
                ->select('stockists.stockist','medicals.medical','promotor__sales.*','years.year','addcompanies.Name','marketings.name','doctors.allotted_dr_name','promotorsalemedicine.*','promotor__sales.id','doctors.email')
        
                
              ->get();
            //   echo json_encode($stocmed);
            //   exit();
             
          
              $email_data=[
                'email'=>$stocmed[0]->email,
                'name'=>$stocmed[0]->allotted_dr_name,
              ];
          
                if(isset($stocmed) && !empty($stocmed)){
                $stocmed2=['stocmed'=>$stocmed];
                
                Mail::send('mail', $stocmed2, function($message) use($email_data) {
                   $message->to($email_data['email'], $email_data['name'])->subject
                      ('Shubhastu Mail');
                   $message->from('shubhastu.pharma@gmail.com','Mail From Shubhastu Pharma');
                });
            }
        }
                return redirect()->back()->with(['success'=>true,'message'=>'Successfully Updated !']);
         
         
             
        
        }
            }


            public function editpromotorsalereport($id)
            {
                
                // $prosalereportedit = Promotor_Sale::find($id); 

                $promotor_sale = Promotor_Sale::where('id', $id)->first();

                $promotor_grouped_by_data = Promotor_Sale::where('sale_of_month', $promotor_sale->sale_of_month)
                    ->where('select_doctor_id', $promotor_sale->select_doctor_id)
                    ->where('year_id',$promotor_sale->year_id)
                    ->where('select_company_id', $promotor_sale->select_company_id)
                    ->get();
            
                $sale_month = $promotor_grouped_by_data[0]->sale_of_month;
                $ids_Array = $promotor_grouped_by_data->pluck('id')->toArray();

                // $stocmed=Promotormedicine::whereIn('promotor__sales_id',$ids_Array)
              
                // ->get();

                if(auth()->guard('marketings')->check())
                {
                    $dd = auth()->guard('marketings')->user()->id;
                    $stocmed = Promotor_Sale::where('promotor__sales.select_marketing_id',  auth()->guard('marketings')->user()->id)
      
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
                
                ->orderby('promotorsalemedicine.id','asc')
                ->select('promotor__sales.*','years.year','addcompanies.Name','marketings.name','doctors.allotted_dr_name','promotorsalemedicine.*','promotor__sales.id','promotorsalemedicine.id as promotorsalemedicine_id',
                DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
                DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
                
                );
           }
           $stocmed=  $stocmed->get(); 
         
                // echo json_encode( $stocmed);
                // exit();
                $year=Year::all();
                $company=Addcompany::all();
                $market=Marketing::all();
                $doctor=Doctor::all();
                $stockist=Stockist::all();
                $medical=Medical::all();
                $city=City::all();
                $medi=Newmedicinemaster::all();
                $batchno=Primary_Sale::all();
              
                return view('editpromotorsale_report',['prosalereportedit'=>$promotor_sale,'stocmed'=>$stocmed,'year'=>$year,'company'=>$company,'market'=>$market,'doctor'=>$doctor,'stockist'=>$stockist,'medical'=>$medical,'city'=>$city,'medi'=>$medi,'batchno'=>$batchno ]);
            }


            public function updatepromotorsalereport(Request $request){
                \DB::beginTransaction();
                            try {
                               
                                // dd($request->all());
                            $promotor_sale = Promotor_Sale::where('id', $request->p_id)->first();
                        
                            $promotor_grouped_by_data = Promotor_Sale::where('sale_of_month', $promotor_sale->sale_of_month)
                                ->where('select_doctor_id', $promotor_sale->select_doctor_id)
                                ->where('year_id',$promotor_sale->year_id)
                                ->where('select_company_id', $promotor_sale->select_company_id)
                                ->get();
                        
                            $ids_Array = $promotor_grouped_by_data->pluck('id')->toArray();
                            \Log::info("record_id  $request->p_id promotor sale ids",$ids_Array);
                        
                        //    dump($ids_Array);
                            
                            $promotorRecords = Promotor_Sale::whereIn('id',$ids_Array)->get();
                        
                           $mergedRecord = new Promotor_Sale();
                       
                           $mergedRecord->grand_total1 = $request->grand_total1;
                           $mergedRecord->grand_total2 = $request->grand_total2;
                           $mergedRecord->sale_of_month = $promotorRecords[0]->sale_of_month;
                           $mergedRecord->select_doctor_id = $promotorRecords[0]->select_doctor_id;
                           $mergedRecord->select_company_id = $promotorRecords[0]->select_company_id;
                           $mergedRecord->year_id = $promotorRecords[0]->year_id;
                           $mergedRecord->select_marketing_id = $promotorRecords[0]->select_marketing_id;
                           $mergedRecord->select_scheme = $promotorRecords[0]->select_scheme;
                           $mergedRecord->tds = $promotorRecords[0]->tds;
                        //echo json_encode($mergedRecord);
                        // exit();
                           // 5. Delete the old records
                           Promotor_Sale::whereIn('id', $ids_Array)->delete();
                           
                        
                           // 6. Save the new merged record
                           $mergedRecord->save();
                           
                        
                            $insert_id = $mergedRecord->id;
                           
                            //dump($insert_id);
            
                            for ($i = 0; $i < count($request->batch); $i++) {
                                if (isset($request->batch[$i])) {
                                    $existingPromotormedicine = Promotormedicine::where([
                                        'promotor__sales_id' => $ids_Array,
                                        
                                    ])->get();
                            
                                
                                    $promotormedicine = new Promotormedicine;
                                    
                                        $promotormedicine->promotor__sales_id=$insert_id;                   
                                        $promotormedicine->select_stokist_id=$request->stockist[$i];
                                        $promotormedicine->append_no=$request->append_no[$i];
                                        $promotormedicine->select_medical_id=$request->medical[$i];
                                        $promotormedicine->select_medicine1=$request->medicine[$i];
                                        $promotormedicine->select_batchs=$request->batch[$i];
                                        $promotormedicine->ptrs=$request->ptr1[$i];
                                        $promotormedicine->mpss=$request->mps1[$i];
                                        $promotormedicine->qntys=$request->qnty[$i];
                                    
                                        
                                        $promotormedicine->qnty_mps_total=$request->mpsqnty[$i];
                                        $promotormedicine->qnty_ptr_total=$request->ptrqnty[$i];
                                    
                                        $promotormedicine->grandtot1=$request->grandtot1[$i];
                                        $promotormedicine->grandtot2=$request->grandtot2[$i];
                                       
                                // dump($promotormedicine);
                                    //exit();
                                        if ($existingPromotormedicine) {
                                            // Delete the existing record
                                            $existingPromotormedicine = Promotormedicine::where([
                                                'promotor__sales_id' => $ids_Array,
                                                
                                            ])->delete();
                                    
                                        }
                                //echo json_encode($promotormedicine);
                               // exit();
                                    $promotormedicine->save();
                                }
                               // dd(1);
                            }
                            \DB::commit();
                                //dd(1);
                                return redirect()->route('medicinesalereport')->with(['success' => true, 'message' => 'Successfully Updated!']);
                                
                            }
                            catch (\Exception $e) {
                                \DB::rollBack();
                                // Handle the exception gracefully
                                dump($e->getMessage());
                              //dd(1);
                                return redirect()->route('medicinesalereport')->with(['error' => true, 'message' => 'Error occurred: ' . $e->getMessage()]);
                            }
                        }
            


// public function updatepromotorsalereport(Request $request)
// {
//     try {
//         $promotor_sale = Promotor_Sale::where('id', $request->p_id)->first();
//         $promotor_grouped_by_data = Promotor_Sale::where('sale_of_month', $promotor_sale->sale_of_month)
//             ->where('select_doctor_id', $promotor_sale->select_doctor_id)
//             ->where('select_company_id', $promotor_sale->select_company_id)
//             ->get();

//         $ids_Array = $promotor_grouped_by_data->pluck('id')->toArray();
//         \Log::info("record_id  $request->p_id promotor sale ids", $ids_Array);

//         $promotorRecords = Promotor_Sale::whereIn('id', $ids_Array)->get();
//         $total1Sum = 0;
//         $total2Sum = 0;

//         foreach ($promotorRecords as $record) {
//             $total1Sum += $record->grand_total1 = $request->get('grand_total1');
//             $total2Sum += $record->grand_total2 = $request->get('grand_total2');
//             $record->save();
//         }

//         $mergedRecord = new Promotor_Sale();
//         $mergedRecord->grand_total1 = $total1Sum;
//         $mergedRecord->grand_total2 = $total2Sum;
//         $mergedRecord->sale_of_month = $promotorRecords[0]->sale_of_month;
//         $mergedRecord->select_doctor_id = $promotorRecords[0]->select_doctor_id;
//         $mergedRecord->select_company_id = $promotorRecords[0]->select_company_id;
//         $mergedRecord->year_id = $promotorRecords[0]->year_id;
//         $mergedRecord->select_marketing_id = $promotorRecords[0]->select_marketing_id;
//         $mergedRecord->select_scheme = $promotorRecords[0]->select_scheme;
//         $mergedRecord->tds = $promotorRecords[0]->tds;

//         // Save the new merged record
//         $mergedRecord->save();

//         // Get the ID of the newly saved record
//         $insert_id = $mergedRecord->id;

//         // Check if existing Promotormedicine records exist before deletion
//         if (Promotormedicine::where('promotor__sales_id', $ids_Array)->exists()) {
//             // Start a new database transaction for the deletion of existing records
//             DB::beginTransaction();

//             try {
//                 // Delete the existing records
//                 Promotormedicine::where('promotor__sales_id', $ids_Array)->delete();

//                 // Commit the transaction if deletion is successful
//                 DB::commit();
//             } catch (\Exception $e) {
//                 // Rollback the transaction if an exception occurs during deletion
//                 DB::rollback();

//                 // Log the exception
//                 \Log::error('Error deleting existing Promotormedicine records: ' . $e->getMessage());

//                 // Throw the exception to be caught by the outer catch block
//                 throw $e;
//             }
//         }

//         // Insert new Promotormedicine records
//         for ($i = 0; $i < count($request->stockist); $i++) {
//             if (isset($request->stockist[$i])) {
//                 $promotormedicine = new Promotormedicine;
//                 // Set attributes...
//                 $promotormedicine->promotor__sales_id = $insert_id;
//                 $promotormedicine->select_stokist_id = $request->stockist[$i];
//                 $promotormedicine->append_no = $request->append_no[$i];
//                 $promotormedicine->select_medical_id = $request->medical[$i];
//                 $promotormedicine->select_medicine1 = $request->medicine[$i];
//                 $promotormedicine->select_batchs = $request->batch[$i];
//                 $promotormedicine->ptrs = $request->ptr1[$i];
//                 $promotormedicine->mpss = $request->mps1[$i];
//                 $promotormedicine->qntys = $request->qnty[$i];

//                 $promotormedicine->qnty_mps_total = $request->mpsqnty[$i];
//                 $promotormedicine->qnty_ptr_total = $request->ptrqnty[$i];

//                 $promotormedicine->grandtot1 = $request->grandtot1[$i];
//                 $promotormedicine->grandtot2 = $request->grandtot2[$i];

//                 // Save the new record
//                 $promotormedicine->save();
//             }
//         }

//         return redirect()->route('medicinesalereport')->with(['success' => true, 'message' => 'Successfully Updated!']);
//     } catch (\Exception $e) {
//         // Handle the exception gracefully
//         return redirect()->route('medicinesalereport')->with(['error' => true, 'message' => 'Error occurred: ' . $e->getMessage()]);
//     }
// }



            public function get_marketing_medicinesale_report(Request $request)
      
            {
              
              $data = DB::table('promotor__sales')
           
              ->where('promotor__sales.select_company_id', $request->id)
              // ->join('medicines','medicines.id','=','newmedicinemaster.medicine_id')
             ->join('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
     
              ->select('promotor__sales.*')
              // ->select('medicines.medicine')
              ->get();
              return response()->json($data);
            
          }
      

 
    public function destroy($id)
    {
        //dd($id);

        $promotor_sale = Promotor_Sale :: where('id',$id)
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
        // echo json_encode($ids_Array);
        // exit();

        $delete=Promotormedicine::whereIn('promotor__sales_id',$ids_Array)->delete();
        // echo json_encode($delete);
        // exit();
        $delete1=Promotor_Sale::whereIn('id',$ids_Array)->delete();
        return redirect(route('medicinesalereport'));
    }

    
   public function get_market(Request $request)
    {
        $market=DB::table('marketings')
        ->where([

            'marketings.id'=>$request->id //doctor_id=script me jo data me hai wo id
        ])
        ->select('marketings.name')
        ->first();//agar hume sirf ek hi value dikhani hai to first

        return response()->json($market);
    }

}


// public function updatepromotorsalereport(Request $request){

//     try {
//     $promotor_sale = Promotor_Sale::where('id', $request->p_id)->first();

//     $promotor_grouped_by_data = Promotor_Sale::where('sale_of_month', $promotor_sale->sale_of_month)
//         ->where('select_doctor_id', $promotor_sale->select_doctor_id)
//         ->where('select_company_id', $promotor_sale->select_company_id)
//         ->get();

//     $ids_Array = $promotor_grouped_by_data->pluck('id')->toArray();
//     \Log::info("promotor sale ids",$ids_Array);

// //     dump($ids_Array);
// //    exit();
    
//     $promotorRecords = Promotor_Sale::whereIn('id',$ids_Array)->get();
//     // echo json_encode($promotorRecords);
//     // exit();
    
//    $total1Sum = 0;
//    $total2Sum = 0;
   
//    foreach ($promotorRecords as $record) {
//        $total1Sum += $record->grand_total1 = $request->get('grand_total1');
//        $total2Sum += $record->grand_total2 = $request->get('grand_total2');
    
//        $record->save();
//    }
  
//    $mergedRecord = new Promotor_Sale();

//    $mergedRecord->grand_total1 = $total1Sum;
//    $mergedRecord->grand_total2 = $total2Sum;
//    $mergedRecord->sale_of_month = $promotorRecords[0]->sale_of_month;
//    $mergedRecord->select_doctor_id = $promotorRecords[0]->select_doctor_id;
//    $mergedRecord->select_company_id = $promotorRecords[0]->select_company_id;
//    $mergedRecord->year_id = $promotorRecords[0]->year_id;
//    $mergedRecord->select_marketing_id = $promotorRecords[0]->select_marketing_id;
//    $mergedRecord->select_scheme = $promotorRecords[0]->select_scheme;
//    $mergedRecord->tds = $promotorRecords[0]->tds;
   
//     //  echo json_encode($mergedRecord);
//     // exit();


//    // 5. Delete the old records
//    Promotor_Sale::whereIn('id', $ids_Array)->delete();
   

//    // 6. Save the new merged record
//    $mergedRecord->save();
   

//     $insert_id = $mergedRecord->id;
//     //dump($insert_id);
//    //exit();
   
//     for ($i = 0; $i < count($request->stockist); $i++) {
//         if (isset($request->stockist[$i])) {
//             $existingPromotormedicine = Promotormedicine::where([
//                 'promotor__sales_id' => $ids_Array,
                
//             ])->get();
    
        
//             // Create a new record with the updated values
//             $promotormedicine = new Promotormedicine;
            
//                 $promotormedicine->promotor__sales_id=$insert_id;                   
//                 $promotormedicine->select_stokist_id=$request->stockist[$i];
//                 $promotormedicine->append_no=$request->append_no[$i];
//                 $promotormedicine->select_medical_id=$request->medical[$i];
//                 $promotormedicine->select_medicine1=$request->medicine[$i];
//                 $promotormedicine->select_batchs=$request->batch[$i];
//                 $promotormedicine->ptrs=$request->ptr1[$i];
//                 $promotormedicine->mpss=$request->mps1[$i];
//                 $promotormedicine->qntys=$request->qnty[$i];
            
                
//                 $promotormedicine->qnty_mps_total=$request->mpsqnty[$i];
//                 $promotormedicine->qnty_ptr_total=$request->ptrqnty[$i];
            
//                 $promotormedicine->grandtot1=$request->grandtot1[$i];
//                 $promotormedicine->grandtot2=$request->grandtot2[$i];
               
//                 // echo json_encode($promotormedicine);
//                 // exit();

//                 if ($existingPromotormedicine) {
//                     // Delete the existing record
//                     $existingPromotormedicine = Promotormedicine::where([
//                         'promotor__sales_id' => $ids_Array,
                        
//                     ])->delete();
            
//                 }
        

//     // echo json_encode($promotormedicine);
//     // exit();

//             $promotormedicine->save();
//         }
//     }
//         return redirect()->route('medicinesalereport')->with(['success' => true, 'message' => 'Successfully Updated!']);
        
//     }
//     catch (\Exception $e) {
//         // Handle the exception gracefully
        
//         return redirect()->route('medicinesalereport')->with(['error' => true, 'message' => 'Error occurred: ' . $e->getMessage()]);
//     }
// }