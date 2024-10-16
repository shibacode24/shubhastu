<?php

namespace App\Http\Controllers;

use App\Models\Addcompany;
use App\Models\Medicine;
use Illuminate\Support\Facades\Validator;
use App\Models\Medical;

use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(){
        $med=Medicine::
        join('addcompanies','addcompanies.id','=','medicines.select_company_id')
        ->orderby('medicines.id','desc')
        ->select('medicines.*','addcompanies.Name')
        ->get();
      
        $add=Addcompany::all();
        
     
         return view('addmedicine',['med'=>$med,'add'=>$add]);
      
    }
    public function create(Request $request){

        $request->validate([
            
                
            'select_company_id' => 'required',
            'medicine' => 'required',
             
            
        ]);
        $med=new Medicine;
        $med->select_company_id=$request->get('select_company_id');
        $med->medicine=$request->get('medicine');
        $med->save(); 
        return redirect(route('medicine'));
        }
       
        public function edit($id)
          {
       $mededit = Medicine::find($id); 
       $med=Medicine::
        join('addcompanies','addcompanies.id','=','medicines.select_company_id')
        ->orderby('medicines.id','desc')
        ->select('medicines.*','addcompanies.Name')
        ->get();

        $addcompanies=Addcompany::all();
         return view('editaddmedicine',['mededit'=>$mededit,'med'=>$med,'addcompanies'=>$addcompanies]);
             
              
          }
         
          public function update(Request $request)
          {
            $med=Medicine::find($request->id);
                
              
                $med->select_company_id=$request->get('select_company_id');
                $med->medicine=$request->get('medicine');
                $med->save(); 
               
           
       
            return redirect()->route('medicine')->with(['success'=>true,'message'=>'Successfully Updated !']);
          }
       
       
          public function destroy($id)
          {
              $med=Medicine::where('id',$id)->delete();
              return redirect(route('medicine'));
          }
       
         
}



