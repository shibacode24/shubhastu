<?php

namespace App\Http\Controllers;
use App\Models\Addcompany;
use App\Models\Medicine;
use App\Models\Newmedicinemaster;
use DB;
use App\Models\New_medicinemaster_2;
use Illuminate\Http\Request;

class NewUpdateMedicineController extends Controller
{
    public function edit_new_medicine_master(){
         $medi=Medicine::all();
        $addcompanies=Addcompany::all();
        
        // $batchno=Primary_Sale::all();
        
     
         return view('new_update_medicine_master',['addcompanies'=>$addcompanies,'medi'=>$medi]);
      
           
        
      }
      public function getMedicines(Request $request)
      
        {
          
          $data = DB::table('newmedicinemaster')
       
          ->where('newmedicinemaster.select_company_id', $request->id)
          // ->join('medicines','medicines.id','=','newmedicinemaster.medicine_id')
         ->join('newmedicinemaster2','newmedicinemaster2.newmedicinemaster_id','=','newmedicinemaster.id')
 
          ->select('newmedicinemaster.*')
          // ->select('medicines.medicine')
          ->first();
          return response()->json($data);
        
      }
  
     

      public function batch1(Request $request){

     
        $data = DB::table('medicinesecond')
       
        ->where('medicinesecond.select_company_id', $request->company_id)
        ->where('medicinesecond.medicine_id', $request->medicine)
        ->join('primary__sales','primary__sales.id','=','medicinesecond.batch_no_id')
    
       
        ->select('primary__sales.id','primary__sales.batch_no')
        // ->select('medicines.medicine')
        ->get();
        return response()->json($data);
      }



      public function ptrmarket(Request $request)
  
      {
       
        $medicinesecond=DB::table('medicinesecond')
        ->join('add_medicines','add_medicines.medicinesecond_id','=','medicinesecond.id')
        ->join('primary__sales','primary__sales.id','=','medicinesecond.batch_no_id')
        ->where([
            'medicinesecond.select_company_id'=>$request->company_id,
            'medicinesecond.medicine_id'=>$request->medicine,
            'primary__sales.id'=>$request->batch_no,
        ])
        ->select('medicinesecond.id','medicinesecond.mrp','medicinesecond.given_gst','medicinesecond.purchase')->first();
       
        $medicine_list=New_medicinemaster_2::where('medicinesecond_id',$medicinesecond->id)->get();
      
            return response()->json([
              'medicinesecond'=>$medicinesecond,'medicine_list'=>$medicine_list
            ]);
          
        }



   
    
     public function update_new_medicine_master(Request $request)
     {
      
      //dd($request->all());
      $request->validate([
            
        'company' => 'required',
        'medicine' => 'required',
        'batch_no' => 'required',
        'mrp' => 'required',
        'given_gst' => 'required',
        'purchase' => 'required',

   ]);

      $medicines=Newmedicinemaster::find($request->id);
     
      $medicines->select_company_id=$request->get('company');
      $medicines->medicine_id=$request->get('medicine');
      $medicines->batch_no=$request->get('batch_no');
      $medicines->mrp=$request->get('mrp');
      $medicines->given_gst=$request->get('given_gst');
      $medicines->purchase=$request->get('purchase');
      $medicines->save(); 


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
  


}
