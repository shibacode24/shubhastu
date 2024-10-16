<?php

namespace App\Http\Controllers;
use App\Models\Secondary_Sale;
use App\Models\Addcompany;
use App\Models\Stockist;
use App\Models\Year;
use App\Models\SecondaryMedicine;
use Illuminate\Http\Request;
use DB;

class SecondarysaleReportController extends Controller
{
 

    public function index(Request $request){

    $year = 3;
    if(isset($request->year_id))
    {
        $year = $request->year_id;
    }
    
    $selected_month = \Carbon\Carbon::now()->subMonth()->format('F');

    if(isset($request->sale_of_month))
    {
        $selected_month = $request->sale_of_month;
    }
    
    if(auth()->guard('marketings')->check())
{
    $dd = auth()->guard('marketings')->user()->id;
    $secondary = Secondary_Sale::where('secondary__sales.master_id',  auth()->guard('marketings')->user()->id)
    ->leftjoin('secondary_medicines', 'secondary_medicines.secondary__sales_id', '=', 'secondary__sales.id')
    ->leftjoin('stockists', 'stockists.stockist', '=', 'secondary_medicines.select_stokist_id')
    ->leftjoin('years', 'years.id', '=', 'secondary__sales.year_id')
    ->leftjoin('addcompanies', 'addcompanies.id', '=', 'secondary__sales.select_company_id')
    ->select(
        'stockists.stockist',
        'years.year',
        'addcompanies.Name',
        // 'secondary__sales.id',
        'secondary__sales.id as secondary__sales',
        'secondary__sales.year_id',
        'secondary__sales.sale_of_month',
        'secondary__sales.select_company_id',
        'secondary__sales.master_id',
        'secondary__sales.select_stokist_id',
        'secondary__sales.grand_total1',
        'secondary__sales.sale_value_total1',
        'secondary_medicines.*',
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.master_id = $dd) as total_grand_total1"),
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.master_id = $dd) as total_grand_total2"),
        
    )
    ->groupBy([
        // 'secondary_medicines.secondary__sales_id',
        // 'secondary_medicines.select_stokist_id',
        'secondary__sales.sale_of_month',
        'secondary__sales.year_id',
        'secondary__sales.select_company_id',
    ]);
}
else{
    $secondary = Secondary_Sale::leftjoin('secondary_medicines', 'secondary_medicines.secondary__sales_id', '=', 'secondary__sales.id')
    ->leftjoin('stockists', 'stockists.stockist', '=', 'secondary_medicines.select_stokist_id')
    ->leftjoin('years', 'years.id', '=', 'secondary__sales.year_id')
    ->leftjoin('addcompanies', 'addcompanies.id', '=', 'secondary__sales.select_company_id')
    ->select(
        'stockists.stockist',
        'years.year',
        'addcompanies.Name',
        'secondary__sales.id as secondary__sales',
        'secondary__sales.year_id',
        'secondary__sales.master_id',
        'secondary__sales.sale_of_month',
        'secondary__sales.select_company_id',
        'secondary__sales.select_stokist_id',
        'secondary__sales.grand_total1',
        'secondary__sales.sale_value_total1',
        'secondary_medicines.*',
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = $year) as total_grand_total1"),
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$selected_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = $year) as total_grand_total2"),
        
    )
    ->groupBy([
        // 'secondary_medicines.secondary__sales_id',
        // 'secondary_medicines.select_stokist_id',
        'secondary__sales.sale_of_month',
        'secondary__sales.year_id',
        'secondary__sales.select_company_id',
    ]);
}
    
        // if(isset($request->year) && $request->year!=null){
            $secondary=$secondary->where('secondary__sales.year_id',$year);
        // }
        // if(isset($request->sale_of_month) && $request->sale_of_month!=null){
            $secondary=$secondary->where('secondary__sales.sale_of_month',$selected_month);
        // }
        if(isset($request->company) && $request->company!=null){
            $secondary=$secondary->where('secondary__sales.select_company_id',$request->company);
        }
      
        if(isset($request->stockist) && $request->stockist!=null){
            $secondary=$secondary->where('secondary__sales.select_stokist_id',$request->stockist);
        }
        if(isset($request->grandtotal1) && $request->grandtotal1!=null){
            $secondary=$secondary->where('secondary__sales.grand_total1',$request->grandtotal1);
        }
        if(isset($request->grandtotal2) && $request->grandtotal2!=null){
            $secondary=$secondary->where('secondary__sales.grand_total2',$request->grandtotal2);
        }
        
        $secondary=$secondary->get();
        
        $year = Year::orderBy('id', 'desc')->get();

        if (auth()->guard('marketings')->check()) {
            $company = Addcompany::whereIn('id', explode(',', auth()->guard('marketings')->user()->select_company_id))->get();
        } else {
            $company = Addcompany::all();
        }


         if (auth()->guard('marketings')->check()) {
            $stockist = Stockist::whereIn('city_id', explode(',', auth()->guard('marketings')->user()->city_id))->get();
        } 
        else {
            $stockist=Stockist::all();

        }
        $promotor=SecondaryMedicine::all();
        return view('secondarysalereport',['secondary'=>$secondary,'year'=>$year,'company'=>$company,'stockist'=>$stockist,'promotor'=>$promotor]);

    }


      public function secondarysalereport(request $request){

        $secondary_sale = Secondary_Sale :: where('id',$request->entry_id)
        ->first();

       // echo json_encode($secondary_sale);
       // exit();

       $secondary_grouped_by_data = Secondary_Sale :: 
       where('sale_of_month',$secondary_sale->sale_of_month)
       ->where('year_id',$secondary_sale->year_id)
       ->where('select_company_id',$secondary_sale->select_company_id)
       ->get();
       $sale_month=$secondary_grouped_by_data[0]->sale_of_month;
       $ids_Array=$secondary_grouped_by_data->pluck('id')
       ->toArray();
    

        if(auth()->guard('marketings')->check())
        {
         $dd = auth()->guard('marketings')->user()->id;
        $proreport=DB::table('secondary__sales')
        ->where('secondary__sales.master_id',  auth()->guard('marketings')->user()->id)
        ->leftjoin('secondary_medicines','secondary_medicines.secondary__sales_id','=','secondary__sales.id')
   
        ->leftjoin('years','years.id','=','secondary__sales.year_id')
        ->leftjoin('addcompanies','addcompanies.id','=','secondary__sales.select_company_id')
        ->whereIn(
        
            'secondary_medicines.secondary__sales_id',$ids_Array
        )
        
        ->orderby('secondary_medicines.id','asc')
        ->select(
            'years.year',
            'addcompanies.Name',
            // 'secondary__sales.id',
            'secondary__sales.id as secondary__sales',
            'secondary__sales.year_id',
            'secondary__sales.sale_of_month',
            'secondary__sales.master_id',
            'secondary__sales.select_company_id',
            'secondary__sales.grand_total1',
            'secondary__sales.sale_value_total1',
            'secondary__sales.pdf',
            'secondary_medicines.*',
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.master_id = $dd) as total_grand_total1"),
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.master_id = $dd) as total_grand_total2"),
            
        );
        }
        else{
            $proreport=DB::table('secondary__sales')
      
            ->leftjoin('secondary_medicines','secondary_medicines.secondary__sales_id','=','secondary__sales.id')
       
            ->leftjoin('years','years.id','=','secondary__sales.year_id')
            ->leftjoin('addcompanies','addcompanies.id','=','secondary__sales.select_company_id')
            ->whereIn(
            
                'secondary_medicines.secondary__sales_id',$ids_Array
            )
            
            ->orderby('secondary_medicines.id','asc')
            ->select(
                'years.year',
                'addcompanies.Name',
                // 'secondary__sales.id',
                'secondary__sales.id as secondary__sales',
                'secondary__sales.year_id',
                'secondary__sales.master_id',
                'secondary__sales.sale_of_month',
                'secondary__sales.select_company_id',
                'secondary__sales.grand_total1',
                'secondary__sales.sale_value_total1',
                'secondary__sales.pdf',
                'secondary_medicines.*',
                DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
                DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
                
            );
        }
    //  ->groupBy(['select_stokist_id','select_medical_id'])

    $proreport =  $proreport->get();      
// echo json_encode($proreport);
// exit();
    // dump($proreport);

      $render_view= view('secondarysalereport_summary',['proreport'=>$proreport])->render();
       

        return response()->json($render_view);
        
    }


    public function get_previous_added_data_form_secondary_sale(Request $request)
    {
          if(auth()->guard('marketings')->check())
    {
        $dd = auth()->guard('marketings')->user()->id;
        // Assuming your database tables are named appropriately
        $get_previous_added_data_form_secondary_sale = Secondary_Sale::
        where('secondary__sales.master_id',  auth()->guard('marketings')->user()->id)
        ->leftjoin('secondary_medicines','secondary_medicines.secondary__sales_id','=','secondary__sales.id')
        ->leftjoin('years','years.id','=','secondary__sales.year_id')
        ->leftjoin('addcompanies','addcompanies.id','=','secondary__sales.select_company_id')
            // ->where('secondary_medicines.select_stokist_id', $request->stockist_id)
            ->where('secondary__sales.select_company_id', $request->company_id)
            ->where('secondary__sales.sale_of_month', $request->sale_of_month)
            ->where('secondary__sales.year_id', $request->year_id)
            
            ->select( 'years.year',
            'addcompanies.Name',
            'secondary__sales.id as secondary__sales',
            'secondary__sales.year_id',
            'secondary__sales.master_id',
            'secondary__sales.sale_of_month',
            'secondary__sales.select_company_id',
            'secondary__sales.select_stokist_id',
            'secondary__sales.grand_total1',
            'secondary__sales.sale_value_total1',
            'secondary__sales.pdf',
            'secondary_medicines.*',
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$request->sale_of_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.master_id = $dd) as total_grand_total1"),
                DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$request->sale_of_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.master_id = $dd) as total_grand_total2"),
            )
            ->get();
        }
        else
        {
            $get_previous_added_data_form_secondary_sale = Secondary_Sale::
                leftjoin('secondary_medicines','secondary_medicines.secondary__sales_id','=','secondary__sales.id')
                ->leftjoin('years','years.id','=','secondary__sales.year_id')
                ->leftjoin('addcompanies','addcompanies.id','=','secondary__sales.select_company_id')
                    // ->where('secondary_medicines.select_stokist_id', $request->stockist_id)
                    ->where('secondary__sales.select_company_id', $request->company_id)
                    ->where('secondary__sales.sale_of_month', $request->sale_of_month)
                    ->where('secondary__sales.year_id', $request->year_id)
                    
                    ->select( 'years.year',
                    'addcompanies.Name',
                    'secondary__sales.id as secondary__sales',
                    'secondary__sales.year_id',
                    'secondary__sales.master_id',
                    'secondary__sales.sale_of_month',
                    'secondary__sales.select_company_id',
                    'secondary__sales.select_stokist_id',
                    'secondary__sales.grand_total1',
                    'secondary__sales.sale_value_total1',
                    'secondary__sales.pdf',
                    'secondary_medicines.*',
                    DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$request->sale_of_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
                    DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$request->sale_of_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
                    )
                    ->get(); 
        }
            // echo json_encode($get_previous_added_data_form_secondary_sale);
            // exit();
              $render_view= view('secondary_sale_previous_added_data',['proreport'=>$get_previous_added_data_form_secondary_sale])->render();
              return response()->json($render_view);
        // return response()->json($get_previous_added_data);
    }

    public function stockists(Request $request)
  
    {
        // $data = Secondary_Sale::
        // Where('select_company_id', 'like', '%' .  $request->id . '%')
        // ->orderby('name', 'asc')
        // ->get();
        $data = Secondary_Sale::
        Where('select_company_id',$request->id )
        ->join('doctors','doctors.id','=','secondary__sales.select_company_id')
        ->select('doctors.id','doctors.allotted_dr_name')
        ->groupby('doctors.allotted_dr_name')
        ->orderby('allotted_dr_name', 'asc')
        ->get();
        return response()->json($data);
    }

    public function secondaryaddsummary(request $request){
        
        $sumary=DB::table('secondary__sales')
      
        ->leftjoin('secondary_medicines','secondary_medicines.secondary__sales_id','=','secondary__sales.id')
       ->leftjoin('stockists','stockists.id','=','secondary_medicines.select_stokist_id')

        ->leftjoin('years','years.id','=','secondary__sales.year_id')
        ->leftjoin('addcompanies','addcompanies.id','=','secondary__sales.select_company_id')
      

        ->where([
        
            'secondary_medicines.secondary__sales_id'=>$request->summary_id 
        ])
        
        ->orderby('secondary_medicines.id','asc')
        ->select('stockists.stockist','medicals.medical','secondary__sales.*','years.year','addcompanies.Name','marketings.name','doctors.allotted_dr_name','secondary_medicines.*','secondary__sales.id')
    
       
      ->get()->groupBy('select_medicine1');
        // echo json_encode($proreport);
        // exit();
        return response()->json(['sumary'=>$sumary]);
    }




    public function secondarymail(Request $request){
if($request->action=='mail'){

$length=count($request->record_id);

    	for ($i = 0; $i < $length ; $i++) {
          
    $secondary=DB::table('secondary__sales')
      
        ->leftjoin('secondary_medicines','secondary_medicines.secondary__sales_id','=','secondary__sales.id')
       ->leftjoin('stockists','stockists.id','=','secondary__sales.select_stokist_id')
     
        ->leftjoin('years','years.id','=','secondary__sales.year_id')
        ->leftjoin('addcompanies','addcompanies.id','=','secondary__sales.select_company_id')
   
        ->where([
        
            'secondary_medicines.secondary__sales_id'=>$request->record_id[$i] 
        ])
        
        ->orderby('secondary_medicines.id','asc')
        ->select('stockists.stockist','secondary__sales.*','years.year','addcompanies.Name','secondary_medicines.*','secondary__sales.id')

        
      ->get();
     
  
      $email_data=[
        'email'=>$secondary[0]->email,
        'name'=>$secondary[0]->allotted_dr_name,
      ];
   
        if(isset($secondary) && !empty($secondary)){
        $secondary2=['secondary'=>$secondary];
       
        Mail::send('mail', $secondary2, function($message) use($email_data) {
           $message->to($email_data['email'], $email_data['name'])->subject
              ('Shubhastu Mail');
           $message->from('shubhastu.pharma@gmail.com','Mail From Shubhastu Pharma');
        });
    }
}
        return redirect()->back()->with(['success'=>true,'message'=>'Successfully Updated !']);
 
 
     

}
    }

    public function destroy($id)
    {
        $secondary_sale = Secondary_Sale :: where('id',$id)
        ->first();

    //    echo json_encode($secondary_sale);
    //    exit();

        $secondary_grouped_by_data = Secondary_Sale :: 
        where('sale_of_month',$secondary_sale->sale_of_month)
        ->where('year_id',$secondary_sale->year_id)
         ->where('master_id',$secondary_sale->master_id)
        ->where('select_company_id',$secondary_sale->select_company_id)
        ->get();
        $sale_month=$secondary_grouped_by_data[0]->sale_of_month;
        $ids_Array=$secondary_grouped_by_data->pluck('id')
        ->toArray();
        // echo json_encode($ids_Array);
        // exit();
    //  echo json_encode($ids_Array);
    //     exit();
        $delete=SecondaryMedicine::whereIn('secondary__sales_id',$ids_Array)->delete();
        $delete1=Secondary_Sale::whereIn('id',$ids_Array)->delete();
        return redirect(route('secondaryreport'));
    }


    
    public function  editsecondarysalesreport($id){
    // {dd($request->prosalereportedit);
        // $prosalereportedit = Secondary_Sale::find($id); 
        // $stocmed=SecondaryMedicine::where('secondary__sales_id',$id)
     
        // ->get();


        $secondary_sale = Secondary_Sale :: where('id',$id)
        ->first();

       // echo json_encode($secondary_sale);
       // exit();

        $secondary_grouped_by_data = Secondary_Sale :: 
        where('sale_of_month',$secondary_sale->sale_of_month)
        ->where('year_id',$secondary_sale->year_id)
        // ->where('master_id',$secondary_sale->master_id)
        ->where('select_company_id',$secondary_sale->select_company_id)
        ->get();
        $sale_month=$secondary_grouped_by_data[0]->sale_of_month;
        $ids_Array=$secondary_grouped_by_data->pluck('id')
        ->toArray();
        //echo json_encode($ids_Array);
        //exit();
        if(auth()->guard('marketings')->check())
        {
         $dd = auth()->guard('marketings')->user()->id;
        $stocmed=DB::table('secondary__sales')
        ->where('secondary__sales.master_id',  auth()->guard('marketings')->user()->id)
        ->leftjoin('secondary_medicines','secondary_medicines.secondary__sales_id','=','secondary__sales.id')
   
        ->leftjoin('years','years.id','=','secondary__sales.year_id')
        ->leftjoin('addcompanies','addcompanies.id','=','secondary__sales.select_company_id')
        // ->leftjoin('marketings','marketings.id','=','secondary__sales.select_marketing_id')
        // ->leftjoin('doctors','doctors.id','=','secondary__sales.select_doctor_id')

        ->whereIn(
        
            'secondary_medicines.secondary__sales_id',$ids_Array
        )
        
        ->orderby('secondary_medicines.id','asc')
        ->select(
            'years.year',
            'addcompanies.Name',
            // 'secondary__sales.id',
            'secondary__sales.id as secondary__sales',
            'secondary__sales.year_id',
            'secondary__sales.sale_of_month',
            'secondary__sales.select_company_id',
            // 'secondary__sales.select_stokist_id',
            'secondary__sales.grand_total1',
            'secondary__sales.sale_value_total1',
            'secondary__sales.pdf',
            'secondary_medicines.*',
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.master_id = $dd) as total_grand_total1"),
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.master_id = $dd) as total_grand_total2"),
            
        );
        }
else{
    $stocmed = DB::table('secondary__sales')
    ->leftjoin('secondary_medicines', 'secondary_medicines.secondary__sales_id', '=', 'secondary__sales.id')
    ->leftjoin('years', 'years.id', '=', 'secondary__sales.year_id')
    ->leftjoin('addcompanies', 'addcompanies.id', '=', 'secondary__sales.select_company_id')
    ->whereIn('secondary_medicines.secondary__sales_id', $ids_Array)
    ->orderby('secondary_medicines.id', 'asc')
    ->select(
        'years.year',
        'addcompanies.Name',
        'secondary__sales.id as secondary__sales',
        'secondary__sales.year_id',
        'secondary__sales.sale_of_month',
        'secondary__sales.select_company_id',
        // 'secondary__sales.select_stokist_id',
        'secondary__sales.grand_total1',
        'secondary__sales.sale_value_total1',
        'secondary__sales.pdf',
        'secondary_medicines.*',
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.grand_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$sale_month' THEN ps.sale_value_total1 ELSE 0 END) FROM secondary__sales ps WHERE ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2")
    );
    
    
    }

    $stocmed = $stocmed->get();
        //  dump($stocmed);
        //  exit();
        $year=Year::all();
        $company=Addcompany::all();
       
        $stockist=Stockist::all();
       
        return view('editsecondarysale',['year'=>$year,'company'=>$company,'stockist'=>$stockist,'prosalereportedit'=>$secondary_sale,'stocmed'=>$stocmed]);
        // return view('editpromotorsale_report',['prosalereportedit'=>$prosalereportedit,'stocmed'=>$stocmed,'year'=>$year,'company'=>$company,'market'=>$market,'doctor'=>$doctor,'stockist'=>$stockist,'medical'=>$medical,'promotor'=>$promotor]);
    }
// }
//====================secondary sale update==============

    public function updatesecondarysalesreport(Request $request){
    //    echo json_encode($request->all());
        $secondary_sale = Secondary_Sale :: where('id',$request->s_id)
        ->first();

    //    echo json_encode($secondary_sale);
    //    exit();
    if(auth()->check())
    {
  $master_id = auth()->user()->id;
    }
    else{
        $master_id = auth()->guard('marketings')->user()->id;
    }
// dd($master_id);
        $secondary_grouped_by_data = Secondary_Sale :: 
        where('sale_of_month',$secondary_sale->sale_of_month)
        ->where('year_id',$secondary_sale->year_id)
        ->where('master_id', $secondary_sale->master_id)
        ->where('select_company_id',$secondary_sale->select_company_id)
        ->get();
        $ids_Array=$secondary_grouped_by_data->pluck('id')
        ->toArray();

        $secondaryRecords = Secondary_Sale::whereIn('id',$ids_Array)->get();
        // echo json_encode($secondary_grouped_by_data);
        // echo json_encode($secondaryRecords);
        // exit();
       $mergedRecord = new Secondary_Sale();
    
       $mergedRecord->grand_total1 = $request->grand_total11;
       $mergedRecord->sale_value_total1 = $request->sale_value_total1;
       $mergedRecord->sale_of_month = $secondaryRecords[0]->sale_of_month;
       $mergedRecord->select_company_id = $secondaryRecords[0]->select_company_id;
       $mergedRecord->year_id = $secondaryRecords[0]->year_id;
       $mergedRecord->master_id =  $master_id;
       
    //    dump($mergedRecord);
    //    exit();
       
       // 5. Delete the old records
       Secondary_Sale::whereIn('id', $ids_Array)->delete();
       
     
    
       // 6. Save the new merged record
       $mergedRecord->save();
      
    
        $insert_id = $mergedRecord->id;
       //dump($insert_id);
       //exit();
       
        for ($i = 0; $i < count($request->stockist); $i++) {
            if (isset($request->stockist[$i])) {
                $existingSecondarymedicine = SecondaryMedicine::where([
                    'secondary__sales_id' => $ids_Array,
                    
                ])->get();
        
            
                // Create a new record with the updated values
                $secondarymedicine = new SecondaryMedicine;
                
                $secondarymedicine->secondary__sales_id=$insert_id;
                $secondarymedicine->append_no=$request->append_no[$i];
                $secondarymedicine->select_medicine=$request->medicine[$i];
                $secondarymedicine->select_stokist_id=$request->stockist[$i];

                $secondarymedicine->sale_value=$request->sale_value[$i];
                $secondarymedicine->grand_total2=$request->grand_total1[$i];
                // $promotormedicine->select_batch=$request->batch[$i];
                $secondarymedicine->qnty=$request->qnty[$i];
            
         
                $secondarymedicine->purchase_rate=$request->purchase[$i];
                $secondarymedicine->qntypurchase=$request->qntypurchase[$i];
                   
                    // echo json_encode($secondarymedicine);
                    // exit();
    
                    if ($existingSecondarymedicine) {
                        // Delete the existing record
                        $existingSecondarymedicine = SecondaryMedicine::where([
                            'secondary__sales_id' => $ids_Array,
                            
                        ])->delete();
                
                    }
            
    
        // echo json_encode($promotormedicine);
        // exit();
    
                $secondarymedicine->save();
            }
        }
                return redirect()->route('secondaryreport')->with(['success'=>true,'message'=>'Successfully Updated !']);

            }

                // public function edit_secondary_sale()
                // {

                // }

            public function  edit_secondary_sale($id){

                    $secondary_sale = Secondary_Sale :: where('id',$id)
                    ->first();
            // echo json_encode($id);
            // exit();
                    $stocmed=DB::table('secondary__sales')
                    ->where('secondary__sales_id',$id)
                    ->leftjoin('secondary_medicines','secondary_medicines.secondary__sales_id','=','secondary__sales.id') 
                    ->leftjoin('years','years.id','=','secondary__sales.year_id')
                    ->leftjoin('addcompanies','addcompanies.id','=','secondary__sales.select_company_id')    
                    ->orderby('secondary_medicines.id','asc')
                    ->select(
                        'years.year',
                        'addcompanies.Name',
                        'secondary__sales.id as secondary__sales',
                        'secondary__sales.year_id',
                        'secondary__sales.sale_of_month',
                        'secondary__sales.select_company_id',
                        'secondary__sales.grand_total1',
                        'secondary__sales.sale_value_total1',
                        'secondary__sales.pdf',
                        'secondary__sales.grand_total1 as total_grand_total1',
                        'secondary__sales.sale_value_total1 as total_grand_total2',
                        'secondary_medicines.*',
                        
                    );
        
                $stocmed = $stocmed->get();
                    //  dump($stocmed);
                    //  exit();
                    $year=Year::all();
                    $company=Addcompany::all();
                   
                    $stockist=Stockist::all();
                   
                    return view('editsecondarysale_for_marketing',['year'=>$year,'company'=>$company,'stockist'=>$stockist,'prosalereportedit'=>$secondary_sale,'stocmed'=>$stocmed]);
                }


            public function updatesecondarysalesreport_for_marketing(Request $request){
                //    echo($request->s_id);
                //    echo json_encode($request->all());
                    $secondary_sale = Secondary_Sale :: where('id',$request->s_id)
                    ->first();
                  
                   $mergedRecord = new Secondary_Sale();
                
                   $mergedRecord->grand_total1 = $request->grand_total11;
                   $mergedRecord->sale_value_total1 = $request->sale_value_total1;
                   $mergedRecord->sale_of_month = $secondary_sale->sale_of_month;
                   $mergedRecord->select_company_id = $secondary_sale->select_company_id;
                   $mergedRecord->year_id = $secondary_sale->year_id;
                   $mergedRecord->master_id = $secondary_sale->master_id;
                //    dump($mergedRecord);
                //    exit();
                   
                   // 5. Delete the old records
                   Secondary_Sale::where('id', $request->s_id)->delete();
                   
                 
                
                   // 6. Save the new merged record
                   $mergedRecord->save();
                  
                
                    $insert_id = $mergedRecord->id;
                   //dump($insert_id);
                   //exit();
                   
                    for ($i = 0; $i < count($request->stockist); $i++) {
                        if (isset($request->stockist[$i])) {
                            $existingSecondarymedicine = SecondaryMedicine::where([
                                'secondary__sales_id' => $request->s_id,  
                            ])->get();
                    
                        
                            // Create a new record with the updated values
                            $secondarymedicine = new SecondaryMedicine;
                            
                            $secondarymedicine->secondary__sales_id=$insert_id;
                            $secondarymedicine->append_no=$request->append_no[$i];
                            $secondarymedicine->select_medicine=$request->medicine[$i];
                            $secondarymedicine->select_stokist_id=$request->stockist[$i];
            
                            $secondarymedicine->sale_value=$request->sale_value[$i];
                            $secondarymedicine->grand_total2=$request->grand_total1[$i];
                            // $promotormedicine->select_batch=$request->batch[$i];
                            $secondarymedicine->qnty=$request->qnty[$i];
                        
                     
                            $secondarymedicine->purchase_rate=$request->purchase[$i];
                            $secondarymedicine->qntypurchase=$request->qntypurchase[$i];
                               
                                // echo json_encode($secondarymedicine);
                                // exit();
                
                                if ($existingSecondarymedicine) {
                                    // Delete the existing record
                                    $existingSecondarymedicine = SecondaryMedicine::where([
                                        'secondary__sales_id' => $request->s_id,
                                        
                                    ])->delete();
                            
                                }
                        
                
                    // echo json_encode($promotormedicine);
                    // exit();
                
                            $secondarymedicine->save();
                        }
                    }
                            return redirect()->route('secondaryreport')->with(['success'=>true,'message'=>'Successfully Updated !']);
            
                        }

    // public function updatesecondarysalesreport(Request $request){
    //     $promotor = Secondary_Sale::find($request->s_id);
    //     // $promotor->year_id = $request->get('year_id');
    //     // $promotor->sale_of_month = $request->get('sale_of_month');
    //     // $promotor->select_company_id = $request->get('company');
    //     // $promotor->sale_value_total1 = $request->get('grand_total2');
    //     $promotor->grand_total1 = $request->get('grand_total11');
    //     $promotor->save();
    
    //     $insert_id = $promotor->id;
    //     foreach ($request->stockist as $i => $stockist) {
    //         // Retrieve the Promotormedicine instances to update based on the conditions
    //         $promotormedicines = SecondaryMedicine::where('id', $request->id[$i])
    //             ->where('select_stokist_id', $stockist)
    //             ->first();
    //             $promotormedicines->qnty = $request->qnty[$i];
    //                     $promotormedicines->grand_total2 = $request->grand_total1[$i];
    //                     $promotormedicines->qntypurchase = $request->qntypurchase[$i];
    //                     $promotormedicines->save();

    //     // for ($i = 0; $i < count($request->stockist); $i++) {
    //     //     if (isset($request->stockist[$i])) {
    //     //         $promotormedicine = SecondaryMedicine::find($request->secmed_id);
    //     //         $promotormedicine->secondary__sales_id = $insert_id;
    //     //         $promotormedicine->select_stokist_id = $request->stockist[$i];
    //     //         $promotormedicine->sale_value = $request->medical[$i];
    //     //         $promotormedicine->grand_total2 = $request->grand_total1[$i];
    //     //         // $promotormedicine->append_no = $request->append_no[$i];
    //     //         $promotormedicine->select_medicine = $request->medicine[$i];
    //     //         // $promotormedicine->select_batch = $request->batch[$i];
    //     //         $promotormedicine->qnty = $request->qnty[$i];
    //     //         $promotormedicine->purchase_rate = $request->purchase[$i];
    //     //         $promotormedicine->qntypurchase = $request->qntypurchase[$i];
    //     //         $promotormedicine->save();
    //             // echo json_encode($promotormedicine);
    //             // exit();
    //     }
    //             return redirect()->route('secondaryreport')->with(['success'=>true,'message'=>'Successfully Updated !']);

    //         }
        }
    




