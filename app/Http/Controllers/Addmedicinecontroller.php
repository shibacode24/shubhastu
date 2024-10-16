<?php

namespace App\Http\Controllers;

use App\Models\Add_medicine;
use App\Models\Medicine;
use App\Models\Addcompany;
use App\Models\Medicine_List;
use App\Models\Primary_Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Addmedicinecontroller extends Controller
{

    public function index(){
      $med=Add_medicine::all();
        $medlist=Medicine_List::
        join('primary__sales','primary__sales.id','=','medicinesecond.batch_no_id')
        
        ->orderby('medicinesecond.id','desc')
        ->select('medicinesecond.*','primary__sales.batch_no')
        ->get();
        $medi=Medicine::all();
        $addcompanies=Addcompany::all();
        $batchno=Primary_Sale::all();
     
         return view('medicine_master',['medi'=>$medi,'addcompanies'=>$addcompanies,'batchno'=>$batchno]);
      
    }
    // public function updatemedicinemas(){
    //   $medi=Medicine::all();
    //   $addcompanies=Addcompany::all();
      
    //   $batchno=Primary_Sale::all();
      
   
    //    return view('Updatemastermedicine',['medi'=>$medi,'addcompanies'=>$addcompanies,'batchno'=>$batchno]);
    
         
      
    // }


    public function medlist(Request $request){
      $med=Add_medicine::all();
      
      $query = $request->input('company');
      $result=Medicine_List::
      select('medicinesecond.*','medicinesecond.id as primary_id','medicines.medicine','addcompanies.Name','add_medicines.*','primary__sales.batch_no')
    ->join('add_medicines','add_medicines.medicinesecond_id','=','medicinesecond.id')
       ->join('primary__sales','primary__sales.id','=','medicinesecond.batch_no_id')
        
      ->join('medicines','medicines.id','=','medicinesecond.medicine_id')
      
      ->join('addcompanies','addcompanies.id','=','medicinesecond.select_company_id')
      ->orderby('medicinesecond.id','desc');

      if($query != Null){
     
       $result->where('medicinesecond.select_company_id', 'LIKE', '%'.$query.'%');
      }
   
   
      $medlist=$result
      ->get();
      // ->groupBy('medicine');
      
      // foreach ($medlist as $medicine=>$rows){
      //   echo $medicine.' -'.count($rows).'<br>';
      // }

      // echo json_encode($medlist);
      // exit();

      $medi=Medicine::all();
      $addcompanies=Addcompany::all();
      $batchno=Primary_Sale::all();
      
   
       return view('medicine_master',['medi'=>$medi,'addcompanies'=>$addcompanies,'medlist'=>$medlist,'batchno'=>$batchno]);
    
  }


  // $medlist=Medicine_List::where('medicinesecond.select_company_id', 'LIKE', '%'.$query.'%')
  //     ->join('add_medicines','add_medicines.medicinesecond_id','=','medicinesecond.id')
  //      ->join('primary__sales','primary__sales.id','=','medicinesecond.batch_no_id')
        
  //     ->join('medicines','medicines.id','=','medicinesecond.medicine_id')
  //     ->join('addcompanies','addcompanies.id','=','medicinesecond.select_company_id')
  //     ->orderby('medicinesecond.id','desc')
  //     ->select('medicinesecond.*','medicinesecond.id as primary_id','medicines.medicine','addcompanies.Name','add_medicines.*','primary__sales.batch_no')
  //     ->get();





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
      

    //   $request->validate([
            
                
    //     'company' => 'required',
    //     'medicine' => 'required',
    //     'batch_no' => 'required',
    //     'mrp' => 'required',
    //     'given_gst' => 'required',
    //     'purchase' => 'required',
        
        
    // ]);
        $medicines=new Medicine_List();
        $medicines->select_company_id=$request->get('company');
        $medicines->medicine_id=$request->get('medicine');
        $medicines->batch_no_id=$request->get('batch_no');
        $medicines->mrp=$request->get('mrp');
        $medicines->given_gst=$request->get('given_gst');
        $medicines->purchase=$request->get('purchase');
        $medicines->save(); 
        $insert_id=$medicines->id; //last record inserted id

        $medicines=Add_medicine::create([
        'gst'=>$request->get('gst'),
        'medicinesecond_id'=>$insert_id,
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

       

        $med=new Add_medicine();       
        $med->gst=$request->get('gst_ten');
        $med->medicinesecond_id=$insert_id;
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

       
        $medi=new Add_medicine();       
        $medi->gst=$request->get('gst_twenty');
        $medi->medicinesecond_id=$insert_id;
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

       

        return redirect()->route('medicine_master');
        //return response()->json(1);
     }
    //  public function edit(Addcompany $company,$id)
    //  {
    //   $medicine_edit=Medicine_List::find($id);
    //   $medicine_list=Add_medicine::
    //   where('select_company_id',$id)
    //   ->orderby('id','asc')
    //   ->get();
    //      $medicine=Medicine::all();
    //      $company=Addcompany::all();
        
    //      return view('updatemedicine_master',['medicine_edit'=>$medicine_edit,'medicine_list'=>$medicine_list,'company'=>$company,'medicine'=>$medicine]);
        
    //  }
    
    //  public function update(Request $request)
    //  {
 
     
    //   $medicines=Medicine_List::find($request->id);
     
    //   $medicines->select_company_id=$request->get('company');
    //   $medicines->medicine_id=$request->get('medicine');
    //   $medicines->batch_no_id=$request->get('batch_no');
    //   $medicines->mrp=$request->get('mrp');
    //   $medicines->given_gst=$request->get('given_gst');
    //   $medicines->purchase=$request->get('purchase');
    //   $medicines->save(); 


    //   $medicines=Add_medicine::where('id',$request->zero_scheme)->update([
    //  'gst'=>$request->get('gst'),
    //   'amount_after_gst'=>$request->get('amount_after_gst'),
    //   'retail_margin'=>$request->get('retail_margin'),
    //   'ptr'=>$request->get('ptr'),
    //   'stockist_margin'=>$request->get('stockist_margin'),
    //   'pts'=>$request->get('pts'),
    //   'management'=>$request->get('management'),
    //   'promotion_cost'=>$request->get('promotion_cost'),
    //   'scheme'=>$request->get('scheme'),
    //   'default_scheme'=>$request->get('default_scheme'),
    //   'scheme_amount_deduct'=>$request->get('scheme_amount_deduct'),
    //   'transport_expiry_breakage'=>$request->get('transport_expiry_breakage'),
    //   'tot'=>$request->get('tot'),
    //   'marketing_working_cost'=>$request->get('marketing_working_cost'),
    //   'company_profit'=>$request->get('company_profit'),
    //   'percent_profit_to_investment'=>$request->get('percent_profit_to_investment'),
    //   'marketing_promotion_scheme'=>$request->get('marketing_promotion_scheme'),
    //   'percent_profit_to_ptr'=>$request->get('percent_profit_to_ptr'),
    //   ]);

     

    //   $med=Add_medicine::find($request->ten_scheme);       
    //   $med->gst=$request->get('gst_ten');
    //   $med->amount_after_gst=$request->get('amount_after_gst_ten');
    //   $med->retail_margin=$request->get('retail_margin_ten');
    //   $med->ptr=$request->get('ptr_ten');
    //   $med->stockist_margin=$request->get('stockist_margin_ten');
    //   $med->pts=$request->get('pts_ten');
    //   $med->management=$request->get('management_ten');
    //   $med->promotion_cost=$request->get('promotion_cost_ten');
    //   $med->scheme=$request->get('scheme_ten');
    //   $med->default_scheme=$request->get('default_scheme_ten');
    //   $med->scheme_amount_deduct=$request->get('scheme_amount_deduct_ten');
    //   $med->transport_expiry_breakage=$request->get('transport_expiry_breakage_ten');
    //   $med->tot=$request->get('tot_ten');
    //   $med->marketing_working_cost=$request->get('marketing_working_cost_ten');
    //   $med->company_profit=$request->get('company_profit_ten');
    //   $med->percent_profit_to_investment=$request->get('percent_profit_to_investment_ten');
    //   $med->marketing_promotion_scheme=$request->get('marketing_promotion_scheme_ten');
    //   $med->percent_profit_to_ptr=$request->get('percent_profit_to_ptr_ten');
    //   $med->save();

     
    //   $medi=Add_medicine::find($request->twenty_scheme);       
    //   $medi->gst=$request->get('gst_twenty');
    //   $medi->amount_after_gst=$request->get('amount_after_gst_twenty');
    //   $medi->retail_margin=$request->get('retail_margin_twenty');
    //   $medi->ptr=$request->get('ptr_twenty');
    //   $medi->stockist_margin=$request->get('stockist_margin_twenty');
    //   $medi->pts=$request->get('pts_twenty');
    //   $medi->management=$request->get('management_twenty');
    //   $medi->promotion_cost=$request->get('promotion_cost_twenty');
    //   $medi->scheme=$request->get('scheme_twenty');
    //   $medi->default_scheme=$request->get('default_scheme_twenty');
    //   $medi->scheme_amount_deduct=$request->get('scheme_amount_deduct_twenty');
    //   $medi->transport_expiry_breakage=$request->get('transport_expiry_breakage_twenty');
    //   $medi->tot=$request->get('tot_twenty');
    //   $medi->marketing_working_cost=$request->get('marketing_working_cost_twenty');
    //   $medi->company_profit=$request->get('company_profit_twenty');
    //   $medi->percent_profit_to_investment=$request->get('percent_profit_to_investment_twenty');
    //   $medi->marketing_promotion_scheme=$request->get('marketing_promotion_scheme_twenty');
    //   $medi->percent_profit_to_ptr=$request->get('percent_profit_to_ptr_twenty');
    //   $medi->save(); 


    //    return redirect()->route('medicine_master1')->with(['success'=>true,'message'=>'Successfully Updated !']);
    //  }
  
  
     public function destroy($id)
     {
         $delete=Add_medicine::where('medicinesecond_id',$id)->delete();
         $delete=Medicine_List::where('id',$id)->delete();
         return redirect(route('medicine_master1'));
     }
  
  
     public function create_company(Request $request){

      $company=new Addcompany;
      $company->Name=$request->get('name');
      $company->save(); 
      return redirect(route('medicine_master'));
      }
 
      public function create_company_medicine(Request $request){

        $med=new Medicine;
        $med->select_company_id=$request->get('select_company_id');
        $med->medicine=$request->get('medicine');
        $med->save(); 
        return redirect(route('medicine_master'));
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
          return redirect(route('medicine_master'));
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
            // ->leftjoin('primary__sales','primary__sales.id','=','medicinesecond.batch_no_id')
            ->where([
                      'primary__sales.select_company_id'=>$request->company_id,
                      'primary__sales.medicine_id'=>$request->medicine,
    
                  ])
            
            ->select('primary__sales.batch_no')
         ->get();
            return response()->json($data);
        }
         
  }
  
