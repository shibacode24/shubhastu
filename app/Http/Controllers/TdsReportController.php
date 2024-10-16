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
use App\Exports\TdsExport;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use DB;
use pdf;
use Storage;

class TdsReportController extends Controller
{
    public function tdsreport(Request $request){
// dd($request->all());
if(isset($request->year ))
{
    $request->year;
}
else{
    $request->year = 3;
}
        
        $currentMonth = date('F');
    
            if(in_Array($currentMonth,['January','February','March']))
            {
                $month=['January','February','March'];
            }
            elseif(in_Array($currentMonth,['April','May','June']))
            {
                $month=['April','May','June'];
            }
            elseif(in_Array($currentMonth,['July','August','September']))
            {
                $month=['July','August','September'];
            } 
            else
            {
                $month=['October','November','December'];
            }

            // echo json_encode(in_Array($currentMonth,['October','November','December']));
            // exit();

            // dump($currentMonth);
            // exit();
            if($request->sale_of_month && $request->sale_of_month==1){
                $month=['January','February','March'];
            }if($request->sale_of_month==2){
                $month=['April','May','June'];
            }if($request->sale_of_month==3){
                $month=['July','August','September'];
            }if($request->sale_of_month==4){
                $month=['October','November','December'];
            }
            $selectedMonths = implode("','", $month);

            $stocmed = Promotor_Sale::
            leftJoin('years', 'years.id', '=', 'promotor__sales.year_id')
            ->leftJoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
            ->leftJoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
            ->leftJoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
            ->select(
            'promotor__sales.*',
            'years.year',
            'addcompanies.Name',
            'marketings.name',
            'doctors.allotted_dr_name',
            'doctors.mobile',
            'doctors.pan_no',
            'doctors.promoter_name',
            'promotor__sales.id',
            );
            if(isset($request->year) && $request->year!=null){
                $stocmed=$stocmed->where('promotor__sales.year_id',$request->year);
            }
            // if(isset($request->sale_of_month) && $request->sale_of_month!=null){
                $stocmed=$stocmed->whereIn('promotor__sales.sale_of_month',$month);
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
            $stocmed=$stocmed->get();
            // echo json_encode($stocmed);
            //  exit();
        $year=Year::orderby('id','desc')->get();
        $company=Addcompany::all();
       
        $doctor=Doctor::all();
        
        return view('tds_report',['stocmed'=>$stocmed,'year'=>$year,'company'=>$company,'doctor'=>$doctor,'month'=>$month]);
       
    }


    public function tdsreport_ecxel(Request $request){
        $month=[];
        if($request->sale_of_month && $request->sale_of_month==1){
            $month=['January','February','March'];
        }if($request->sale_of_month==2){
            $month=['April','May','June'];
        }if($request->sale_of_month==3){
            $month=['July','August','September'];
        }if($request->sale_of_month==4){
            $month=['October','November','December'];
        }
        $selectedMonths = implode("','", $month);
// dump($selectedMonths);

        // Promotormedicine::where('id','>=',240)->take(5)->update(['append_no'=>3]);
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
        'doctors.pan_no',
        'doctors.promoter_name',
        'promotorsalemedicine.*',
        'promotor__sales.id',
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month IN ('$selectedMonths') THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
        DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month IN ('$selectedMonths') THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2")
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
        if(isset($request->sale_of_month) && $request->sale_of_month!=null){
            $stocmed=$stocmed->whereIn('promotor__sales.sale_of_month',$month);
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
        $stocmed=$stocmed->get();
          
//   echo json_encode($stocmed);
//   exit();
            // $pdf = PDF::loadView('excel',['stocmed'=>$stocmed]);
            //     $filename = 'excel.pdf';
            //     return $pdf->download($filename);

         return view('excel',['stocmed'=>$stocmed,'month'=>$month]);
       
    }

    public function mail_medicinesalereport(Request $request){
        if($request->action=='mail'){
        
        $length=count($request->record_id);
        echo json_encode($request->record_id);
        exit();
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


            public function editmedicinesalereport($id)
            {
                $prosalereportedit = Promotor_Sale::find($id); 
                $stocmed=Promotormedicine::where('promotor__sales_id',$id)
                ->get();
                $year=Year::all();
                $company=Addcompany::all();
                $market=Marketing::all();
                $doctor=Doctor::all();
                $stockist=Stockist::all();
                $medical=Medical::all();
                $city=City::all();
                $medi=Newmedicinemaster::all();
                $batchno=Primary_Sale::all();
                return view('editpromotorsale_report',['prosalereportedit'=>$prosalereportedit,'stocmed'=>$stocmed,'year'=>$year,'company'=>$company,'market'=>$market,'doctor'=>$doctor,'stockist'=>$stockist,'medical'=>$medical,'city'=>$city,'medi'=>$medi,'batchno'=>$batchno]);
                // return view('editpromotorsale_report',['prosalereportedit'=>$prosalereportedit,'stocmed'=>$stocmed,'year'=>$year,'company'=>$company,'market'=>$market,'doctor'=>$doctor,'stockist'=>$stockist,'medical'=>$medical,'promotor'=>$promotor]);
            }
        

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
        $delete=Promotormedicine::where('promotor__sales_id',$id)->delete();
        $delete=Promotor_Sale::where('id',$id)->delete();
        return redirect(route('medicinesalereport'));
    }
   
    //for excel export
    // public function get_tds_data(Request $request)
    // { 

    //     $month=[];
    //     if($request->sale_of_month && $request->sale_of_month==1){
    //         $month=['December','January','February'];
    //     }if($request->sale_of_month==2){
    //         $month=['March','April','May'];
    //     }if($request->sale_of_month==3){
    //         $month=['June','july','August'];
    //     }if($request->sale_of_month==4){
    //         $month=['September','October','November'];
            
    //     }                       
    //     return Excel::
    //     download(new TdsExport($month), 'tds.xlsx');
    // }
    public function get_tds_data(Request $request)
    {
        $month = [];
        if($request->sale_of_month && $request->sale_of_month==1){
            $month=['January','February','March'];
        }if($request->sale_of_month==2){
            $month=['April','May','June'];
        }if($request->sale_of_month==3){
            $month=['July','August','September'];
        }if($request->sale_of_month==4){
            $month=['October','November','December'];
            
        }

        // Your search logic to filter the data
        $query = Promotor_Sale::leftjoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
            ->leftjoin('stockists', 'stockists.id', '=', 'promotorsalemedicine.select_stokist_id')
            ->leftjoin('medicals', 'medicals.id', '=', 'promotorsalemedicine.select_medical_id')
            ->leftjoin('years', 'years.id', '=', 'promotor__sales.year_id')
            ->leftjoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
            ->leftjoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
            ->leftjoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
            ->select('stockists.stockist', 'medicals.medical', 'promotor__sales.*', 'years.year', 'addcompanies.Name', 'marketings.name', 'doctors.allotted_dr_name', 'doctors.promoter_name', 'promotorsalemedicine.*', 'promotor__sales.id')
            ->groupby('promotorsalemedicine.promotor__sales_id');

        if ($request->year) {
            $query->where('promotor__sales.year_id', $request->year);
        }

        if ($request->sale_of_month) {
            $query->whereIn('promotor__sales.sale_of_month', $month);
        }

        if ($request->company) {
            $query->where('promotor__sales.select_company_id', $request->company);
        }

        if ($request->market) {
            $query->where('promotor__sales.select_marketing_id', $request->market);
        }

        if ($request->doctor) {
            $query->where('promotor__sales.select_doctor_id', $request->doctor);
        }

        if ($request->grandtotal1) {
            $query->where('promotor__sales.grand_total1', $request->grandtotal1);
        }

        if ($request->grandtotal2) {
            $query->where('promotor__sales.grand_total2', $request->grandtotal2);
        }

        $stocmed = $query->get();
        // $stocmed = $query->get();
        // Export the filtered data
        return Excel::download(new TdsExport($month, $stocmed), 'tds.xlsx');
    }

    public function database_backup(){
        try {
            $tables = DB::select('SHOW TABLES');
            $backupSQL = '';
            foreach ($tables as $table) {
                $tableName = reset($table);
                $createTable = DB::selectOne("SHOW CREATE TABLE $tableName")->{'Create Table'};
                $backupSQL .= "DROP TABLE IF EXISTS `$tableName`;\n";
                $backupSQL .= "$createTable;\n";
                $tableData = DB::table($tableName)->get();
                foreach ($tableData as $row) {
                    $values = [];
                    foreach ($row as $value) {
                        $values[] = '"' . addslashes($value) . '"';
                    }
                    $backupSQL .= "INSERT INTO `$tableName` VALUES (" . implode(', ', $values) . ");\n";
                }
                $backupSQL .= "\n";
            }
            $backupFileName = 'Shubhastu-DB-' . now()->format('Y-m-d-His') . '.sql';
           Storage::disk('local')->put($backupFileName, $backupSQL);
            return response()->download(
                storage_path('app/' . $backupFileName),
                $backupFileName,
                ['Content-Type: application/sql']
            )->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Database backup creation and download failed: ' . $e->getMessage());
        }
    }
}
