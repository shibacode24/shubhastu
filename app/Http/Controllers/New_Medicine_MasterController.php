<?php

namespace App\Http\Controllers;

use App\Models\Newmedicinemaster;
use App\Models\New_medicinemaster_2;
use App\Models\Addcompany;
use App\Models\Medical;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;


class New_Medicine_MasterController extends Controller
{
    public function index(Request $request){
     //  Session::put('error', 'An error occurred.');
       //Session::forget(['error']);
        $med=New_medicinemaster_2::all();
        $query = $request->input('company');
          $medlist=Newmedicinemaster::
          select('newmedicinemaster.*','newmedicinemaster.id','addcompanies.Name','newmedicinemaster2.*')
          // join('primary__sales','primary__sales.id','=','newmedicinemaster.batch_no_id')
          ->join('addcompanies','addcompanies.id','=','newmedicinemaster.select_company_id')


          ->join('newmedicinemaster2','newmedicinemaster2.newmedicinemaster_id','=','newmedicinemaster.id')
          //  ->join('primary__sales','primary__sales.id','=','newmedicinemaster.batch_no_id')
            
          //  ->join('medicines','medicines.id','=','newmedicinemaster.medicine_id') 
          
          // ->join('addcompanies','addcompanies.id','=','newmedicinemaster.select_company_id')
          ->orderby('newmedicinemaster.id','desc');
    
          if($query != Null){
         
           $medlist->where('newmedicinemaster.select_company_id', 'LIKE', '%'.$query.'%');
          }
       
       
          $medlist=$medlist
          ->get();
         
    
          // $medi=Medicine::all();
          $addcompanies=Addcompany::all();
  




          // ->orderby('newmedicinemaster.id','desc')
          // ->select('newmedicinemaster.*','addcompanies.Name')
          // ->get();
          // echo json_encode($medlist);
          // exit();
          // $medi=Medicine::all();
          $addcompanies=Addcompany::all();
          // $batchno=Primary_Sale::all();
          $medica=Medical::all();
        
           return view('new_medicine_master',['medlist'=>$medlist,'med'=>$med,'addcompanies'=>$addcompanies,'medica'=>$medica]);
        
      }
    

  
  
      public function medlist(Request $request){
        $med=New_medicinemaster_2::all();
        
        $query = $request->input('company');
        $result=Newmedicinemaster::
        select('newmedicinemaster.*','newmedicinemaster.id','addcompanies.Name','newmedicinemaster2.*')
       ->join('newmedicinemaster2','newmedicinemaster2.newmedicinemaster_id','=','newmedicinemaster.id')
        //  ->join('primary__sales','primary__sales.id','=','newmedicinemaster.batch_no_id')
          
        //  ->join('medicines','medicines.id','=','newmedicinemaster.medicine_id') 
        
        ->join('addcompanies','addcompanies.id','=','newmedicinemaster.select_company_id')
        ->orderby('newmedicinemaster.id','desc');
  
        if($query != Null){
       
         $result->where('newmedicinemaster.select_company_id', 'LIKE', '%'.$query.'%');
        }
     
     
        $medlist=$result
        ->get();
       
  
        // $medi=Medicine::all();
        $addcompanies=Addcompany::all();
        // $batchno=Primary_Sale::all();
        
     
         return redirect(route('new_medicine_master',['addcompanies'=>$addcompanies,'medlist'=>$medlist]));
      
    }
  
  
      public function create(Request $request){
  
        $validator = Validator::make(
          $request->all(),
          [
              
              'company' => ['required'],
              'medicine' => ['required'],
              'batch_no' => ['required'],
              'mrp' => ['required'],
              'given_gst' => ['required'],
              'purchase' => ['required'],
               
      ],
       [
             
              'company.required'=>'Please Enter Company.',
              'medicine.required' => 'Please Enter Medicine.',
               'batch_no.required'=>'Please Enter Batch Number.',
              'mrp.required' => 'Please Enter MRP.',
              'given_gst.required' => 'Please Enter Given GST.',
              'purchase.required' => 'Please Enter Purchase.',
             
          ]);
          if ($validator->fails()) {
              $errors = '';
              $messages = $validator->messages();
              foreach ($messages->all() as $message) {
                  $errors .= $message . "<br>";
              }
              return back()->with(['error'=>$errors]);
          }
          $select_company_id = $request->get('company');
          $select_medical_id = $request->get('select_medical_id');
          $batch_no = $request->get('batch_no');
      
          // Check if each select_medical_id already exists for the select_stockist_id
          // foreach ($select_medical_ids as $medical_id) {
              $existingRecord = Newmedicinemaster::where('select_company_id', $select_company_id)
                  ->where('select_medical_id', $select_medical_id)
                  ->where('batch_no', $batch_no)
                  ->first();
                  // echo json_encode($existingRecord);
                  // exit();
  if($existingRecord)
  {
    return redirect()->back()->with(['error'=>'Medicine Already Exists.']);

  }
  else{
          $medicines=new Newmedicinemaster();
          $medicines->select_company_id=$request->get('company');
          $medicines->select_medical_id=$request->get('select_medical_id');
          $medicines->medicine_id=$request->get('medicine');
          $medicines->batch_no=$request->get('batch_no');
          $medicines->expiry_date=$request->get('expiry_date');
          $medicines->quantity=$request->get('quantity');
          $medicines->mrp=$request->get('mrp');
          $medicines->given_gst=$request->get('given_gst');
          $medicines->purchase=$request->get('purchase');
          $medicines->save(); 
          $insert_id=$medicines->id; //last record inserted id
  
          $medicines=New_medicinemaster_2::create([
          'gst'=>$request->get('gst'),
          'newmedicinemaster_id'=>$insert_id,
          'amount_after_gst'=>$request->get('amount_after_gst'),
          'retail_margin'=>$request->get('retail_margin'),
          'ptr'=>$request->get('ptr'),
          'stockist_margin'=>$request->get('stockist_margin'),
          'pts'=>$request->get('pts'),
          'management'=>$request->get('management'),
          'promotion_cost'=>$request->get('promotion_cost'),
          'scheme'=>$request->get('scheme'),
          'default_scheme'=>$request->get('default_scheme'),
          'scheme_amount_deduct'=>$request->get('scheme_amount_deduct'),
          'transport_expiry_breakage'=>$request->get('transport_expiry_breakage'),
          'tot'=>$request->get('tot'),
          'marketing_working_cost'=>$request->get('marketing_working_cost'),
          'company_profit'=>$request->get('company_profit'),
          'percent_profit_to_investment'=>$request->get('percent_profit_to_investment'),
          'marketing_promotion_scheme'=>$request->get('marketing_promotion_scheme'),
          'percent_profit_to_ptr'=>$request->get('percent_profit_to_ptr'),
          ]);
  
         
  
          $med=new New_medicinemaster_2();       
          $med->gst=$request->get('gst_ten');
          $med->newmedicinemaster_id=$insert_id;
          $med->amount_after_gst=$request->get('amount_after_gst_ten');
          $med->retail_margin=$request->get('retail_margin_ten');
          $med->ptr=$request->get('ptr_ten');
          $med->stockist_margin=$request->get('stockist_margin_ten');
          $med->pts=$request->get('pts_ten');
          $med->management=$request->get('management_ten');
          $med->promotion_cost=$request->get('promotion_cost_ten');
          $med->scheme=$request->get('scheme_ten');
          $med->default_scheme=$request->get('default_scheme_ten');
          $med->scheme_amount_deduct=$request->get('scheme_amount_deduct_ten');
          $med->transport_expiry_breakage=$request->get('transport_expiry_breakage_ten');
          $med->tot=$request->get('tot_ten');
          $med->marketing_working_cost=$request->get('marketing_working_cost_ten');
          $med->company_profit=$request->get('company_profit_ten');
          $med->percent_profit_to_investment=$request->get('percent_profit_to_investment_ten');
          $med->marketing_promotion_scheme=$request->get('marketing_promotion_scheme_ten');
          $med->percent_profit_to_ptr=$request->get('percent_profit_to_ptr_ten');
          // echo json_encode($med);
          // exit();
          $med->save();
  
         
          $medi=new New_medicinemaster_2();       
          $medi->gst=$request->get('gst_twenty');
          $medi->newmedicinemaster_id=$insert_id;
          $medi->amount_after_gst=$request->get('amount_after_gst_twenty');
          $medi->retail_margin=$request->get('retail_margin_twenty');
          $medi->ptr=$request->get('ptr_twenty');
          $medi->stockist_margin=$request->get('stockist_margin_twenty');
          $medi->pts=$request->get('pts_twenty');
          $medi->management=$request->get('management_twenty');
          $medi->promotion_cost=$request->get('promotion_cost_twenty');
          $medi->scheme=$request->get('scheme_twenty');
          $medi->default_scheme=$request->get('default_scheme_twenty');
          $medi->scheme_amount_deduct=$request->get('scheme_amount_deduct_twenty');
          $medi->transport_expiry_breakage=$request->get('transport_expiry_breakage_twenty');
          $medi->tot=$request->get('tot_twenty');
          $medi->marketing_working_cost=$request->get('marketing_working_cost_twenty');
          $medi->company_profit=$request->get('company_profit_twenty');
          $medi->percent_profit_to_investment=$request->get('percent_profit_to_investment_twenty');
          $medi->marketing_promotion_scheme=$request->get('marketing_promotion_scheme_twenty');
          $medi->percent_profit_to_ptr=$request->get('percent_profit_to_ptr_twenty');
          $medi->save(); 
  
        
  
          return redirect()->route('medicine_master1')->with(['success' => 'Data Successfully Submitted !', 'company' =>$request->get('company')]);
          //return response()->json(1);
       }
      }
    
    
       public function destroy($id)
       {
           $delete=New_medicinemaster_2::where('newmedicinemaster_id',$id)->delete();
           $delete=Newmedicinemaster::where('id',$id)->delete();
           return redirect(route('new_medicine_master'));
       }

       public function disable_medicine($id)
       {
          $disable = Newmedicinemaster:: where('id',$id)->first();
          $disable->status=$disable->status == '1' ? '0' : '1';
          $disable->save();
          return back();
       }
       
    
    
       public function create_company(Request $request){
  
        $company=new Addcompany;
        $company->Name=$request->get('name');
        $company->save(); 
        return redirect(route('new_medicine_master'));
        }
   
        public function create_company_medicine(Request $request){
  
          $med=new Medicine;
          $med->select_company_id=$request->get('select_company_id');
          $med->medicine=$request->get('medicine');
          $med->save(); 
          return redirect(route('new_medicine_master'));
          }
  
          public function create_batch_company(Request $request){
  
            $med=new Primary_Sale;
            $med->select_company_id=$request->get('select_company_id');
            $med->medicine_id=$request->get('medicine');
            $med->batch_no=$request->get('batch_no');
            $med->mrp=$request->get('mrp');
            $med->expiry_date=$request->get('expiry_date');
            $med->quantity=$request->get('quantity');
            $med->save(); 
            return redirect(route('new_medicine_master'));
            }
  
            public function get_medicine_from_company(Request $request){
              $data = Medicine::
              where('medicines.select_company_id', $request->id)
              ->orderby('select_company_id', 'asc')->get();
              return response()->json($data);
            }
  
            
  
            public function get_batch_from_medicine_company(Request $request)
    
          {
              $data = DB::table('primary__sales')
              // ->join('add_medicines','add_medicines.id','=','primary__sales.select_company_id')
              // ->join('medicines','medicines.id','=','primary__sales.medicine_id')
              // ->leftjoin('primary__sales','primary__sales.id','=','newmedicinemaster.batch_no_id')
              ->where([
                        'primary__sales.select_company_id'=>$request->company_id,
                        'primary__sales.medicine_id'=>$request->medicine,
      
                    ])
              
              ->select('primary__sales.batch_no')
           ->get();
              return response()->json($data);
          }


      public function editupdate_medicine(Request $request,$id){
        //$neweditmed=New_medicinemaster_2::find($id);
        //$medlist=Newmedicinemaster::where('newmedicinemaster.id',$neweditmed->newmedicinemaster_id)
        //$neweditmed=New_medicinemaster_2::find($id);
        // dd($request->medlist);
        $neweditmed=Newmedicinemaster::find($id);
        $medlist=New_medicinemaster_2::where('newmedicinemaster_id',$id)
       // ->join('primary__sales','primary__sales.id','=','newmedicinemaster2.batch_no_id')
        //->join('newmedicinemaster2','newmedicinemaster2.newmedicinemaster_id','=','newmedicinemaster.id')
        //->orderby('newmedicinemaster.id','desc')
        ->get();
        // echo json_encode($neweditmed);
      
        //  echo json_encode($medlist);
        // $medi=Medicine::all();
        // $addcompanies=Addcompany::all();
        // $med=New_medicinemaster_2::where('newmedicinemaster.id',$request->id)

        // //->join('newmedicinemaster2','newmedicinemaster2.newmedicinemaster_id','=','newmedicinemaster.id')
        // ->leftjoin('newmedicinemaster','newmedicinemaster.id','=','newmedicinemaster2.newmedicinemaster_id')
        // // join('primary__sales','primary__sales.id','=','newmedicinemaster.batch_no_id')
        // ->leftjoin('addcompanies','addcompanies.id','=','newmedicinemaster.select_company_id')
        // ->orderby('newmedicinemaster.id','desc')
        // ->select('newmedicinemaster2.*','newmedicinemaster.medicine_id','newmedicinemaster.batch_no','newmedicinemaster.expiry_date','newmedicinemaster.quantity','newmedicinemaster.mrp','newmedicinemaster.given_gst','newmedicinemaster.purchase','addcompanies.Name')
        // ->get();

        // echo json_encode($neweditmed);
        // exit();

        // $medi=Medicine::all();
        $addcompanies=Addcompany::all();
        // $batchno=Primary_Sale::all();
        // $medica=Medical::all();
         return view('editupdate_medicine',['neweditmed'=>$neweditmed,'addcompanies'=>$addcompanies,'medlist'=>$medlist]);
      
          }


          public function updatemedicineeditmaster(Request $request)
          {
           
           //dd($request->all());
        // dd($request->all());
     
           Newmedicinemaster::where('id',$request->id)->update([
          'select_company_id'=>$request->get('company'),
          'medicine_id'=>$request->get('medicine'),
          'batch_no'=>$request->get('batch_no'),
          'mrp'=>$request->get('mrp'),
          'given_gst'=>$request->get('given_gst'),
          'purchase'=>$request->get('purchase'),
          // //  $medicines->select_company_id=$request->get('company');
          //  $medicines->medicine_id=$request->get('medicine');
          //  $medicines->batch_no=$request->get('batch_no');
          //  $medicines->mrp=$request->get('mrp');
          //  $medicines->given_gst=$request->get('given_gst');
          //  $medicines->purchase=$request->get('purchase');
           
          ]);
     
           $medicines=New_medicinemaster_2::where('id',$request->zero_scheme_id)->update([
          'gst'=>$request->get('gst'),
           'amount_after_gst'=>$request->get('amount_after_gst'),
           'retail_margin'=>$request->get('retail_margin'),
           'ptr'=>$request->get('ptr'),
           'stockist_margin'=>$request->get('stockist_margin'),
           'pts'=>$request->get('pts'),
           'management'=>$request->get('management'),
           'promotion_cost'=>$request->get('promotion_cost'),
           'scheme'=>$request->get('scheme'),
           'default_scheme'=>$request->get('default_scheme'),
           'scheme_amount_deduct'=>$request->get('scheme_amount_deduct'),
           'transport_expiry_breakage'=>$request->get('transport_expiry_breakage'),
           'tot'=>$request->get('tot'),
           'marketing_working_cost'=>$request->get('marketing_working_cost'),
           'company_profit'=>$request->get('company_profit'),
           'percent_profit_to_investment'=>$request->get('percent_profit_to_investment'),
           'marketing_promotion_scheme'=>$request->get('marketing_promotion_scheme'),
           'percent_profit_to_ptr'=>$request->get('percent_profit_to_ptr'),
           ]);
     
          
     
           $med=New_medicinemaster_2::find($request->ten_scheme_id);       
           $med->gst=$request->get('gst_ten');
           $med->amount_after_gst=$request->get('amount_after_gst_ten');
           $med->retail_margin=$request->get('retail_margin_ten');
           $med->ptr=$request->get('ptr_ten');
           $med->stockist_margin=$request->get('stockist_margin_ten');
           $med->pts=$request->get('pts_ten');
           $med->management=$request->get('management_ten');
           $med->promotion_cost=$request->get('promotion_cost_ten');
           $med->scheme=$request->get('scheme_ten');
           $med->default_scheme=$request->get('default_scheme_ten');
           $med->scheme_amount_deduct=$request->get('scheme_amount_deduct_ten');
           $med->transport_expiry_breakage=$request->get('transport_expiry_breakage_ten');
           $med->tot=$request->get('tot_ten');
           $med->marketing_working_cost=$request->get('marketing_working_cost_ten');
           $med->company_profit=$request->get('company_profit_ten');
           $med->percent_profit_to_investment=$request->get('percent_profit_to_investment_ten');
           $med->marketing_promotion_scheme=$request->get('marketing_promotion_scheme_ten');
           $med->percent_profit_to_ptr=$request->get('percent_profit_to_ptr_ten');
           $med->save();
     
          
           $medi=New_medicinemaster_2::find($request->twenty_scheme_id);       
           $medi->gst=$request->get('gst_twenty');
           $medi->amount_after_gst=$request->get('amount_after_gst_twenty');
           $medi->retail_margin=$request->get('retail_margin_twenty');
           $medi->ptr=$request->get('ptr_twenty');
           $medi->stockist_margin=$request->get('stockist_margin_twenty');
           $medi->pts=$request->get('pts_twenty');
           $medi->management=$request->get('management_twenty');
           $medi->promotion_cost=$request->get('promotion_cost_twenty');
           $medi->scheme=$request->get('scheme_twenty');
           $medi->default_scheme=$request->get('default_scheme_twenty');
           $medi->scheme_amount_deduct=$request->get('scheme_amount_deduct_twenty');
           $medi->transport_expiry_breakage=$request->get('transport_expiry_breakage_twenty');
           $medi->tot=$request->get('tot_twenty');
           $medi->marketing_working_cost=$request->get('marketing_working_cost_twenty');
           $medi->company_profit=$request->get('company_profit_twenty');
           $medi->percent_profit_to_investment=$request->get('percent_profit_to_investment_twenty');
           $medi->marketing_promotion_scheme=$request->get('marketing_promotion_scheme_twenty');
           $medi->percent_profit_to_ptr=$request->get('percent_profit_to_ptr_twenty');
           $medi->save(); 
     
     
            return redirect()->route('medicine_master1')->with(['success'=>true,'message'=>'Successfully Updated !']);
          }
       
       
          public function superadmin_medicine_report(Request $request){
          
               $query = $request->input('company');
                 $medlist=Newmedicinemaster::
                 select('newmedicinemaster.*','newmedicinemaster.id','addcompanies.Name','newmedicinemaster2.*')
              
                 ->join('addcompanies','addcompanies.id','=','newmedicinemaster.select_company_id')
       
       
                 ->join('newmedicinemaster2','newmedicinemaster2.newmedicinemaster_id','=','newmedicinemaster.id')
             
                 ->orderby('newmedicinemaster.id','desc');
           
                 if($query != Null){
                
                  $medlist->where('newmedicinemaster.select_company_id', 'LIKE', '%'.$query.'%');
                 }
              
              
                 $medlist=$medlist
                 ->get();
                
    
               
                  return view('superadmin_medicine_report',['medlist'=>$medlist]);
               
             }
           
           
}
