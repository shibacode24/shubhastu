<?php

namespace App\Http\Controllers;

use App\Models\Primary_Sale;
use App\Models\Medicine;
use App\Models\Addcompany;
use Illuminate\Http\Request;

class PrimarySaleController extends Controller
{
    public function index(){
        $med=Primary_Sale::
        join('addcompanies','addcompanies.id','=','primary__sales.select_company_id')
        ->join ('medicines','medicines.id','=','primary__sales.medicine_id')

        ->orderby('primary__sales.id','desc')
        ->select('primary__sales.*','addcompanies.Name','medicines.medicine')
        ->get();
        $medi=Medicine::all();
        $addcompanies=Addcompany::all();
 
        
     
         return view('primary_sale',['med'=>$med,'addcompanies'=>$addcompanies,'medi'=>$medi]);
      
    }
    public function create(Request $request){

        $request->validate([
            
                
            'select_company_id' => 'required',
            'medicine' => 'required',
                   
            'batch_no' => 'required',
            'mrp' => 'required',
             
            'expiry_date' => 'required',
            'quantity' => 'required',
            
        ]);
        $med=new Primary_Sale;
        $med->select_company_id=$request->get('select_company_id');
        $med->medicine_id=$request->get('medicine');
        $med->batch_no=$request->get('batch_no');
        $med->mrp=$request->get('mrp');
        $med->expiry_date=$request->get('expiry_date');
        $med->quantity=$request->get('quantity');
        $med->save(); 
        return redirect(route('primary'));
        }
       
        public function edit($id)
          {
       $mededit = Primary_Sale::find($id); 
       $med=Primary_Sale::
       join('addcompanies','addcompanies.id','=','primary__sales.select_company_id')
       ->join ('medicines','medicines.id','=','primary__sales.medicine_id')

       ->orderby('primary__sales.id','desc')
       ->select('primary__sales.*','addcompanies.Name','medicines.medicine')
       ->get();
       $medi=Medicine::all();
       $addcompanies=Addcompany::all();
       
             return view('editprimary_sale',['mededit'=>$mededit,'med'=>$med,'addcompanies'=>$addcompanies,'medi'=>$medi]);
             
              
          }
         
          public function update(Request $request)
          {
            $med=Primary_Sale::find($request->id);
                
              
            $med->select_company_id=$request->get('select_company_id');
            $med->medicine_id=$request->get('medicine');
            $med->batch_no=$request->get('batch_no');
            $med->mrp=$request->get('mrp');
            $med->expiry_date=$request->get('expiry_date');
            $med->quantity=$request->get('quantity');
      
                $med->save(); 
               
           
       
            return redirect()->route('primary')->with(['success'=>true,'message'=>'Successfully Updated !']);
          }
       
       
          public function destroy($id)
          {
              $med=Primary_Sale::where('id',$id)->delete();
              return redirect(route('primary'));
          }
       
       
       

}
