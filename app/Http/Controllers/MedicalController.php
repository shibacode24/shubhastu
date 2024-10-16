<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Medical;

class MedicalController extends Controller
{
    public function index(){

        $med=Medical::
        join ('cities','cities.id','=','medicals.city_id')
        ->orderby('medicals.id','desc')
        ->select('medicals.*','cities.city')
        ->get();
        $city=City::all();
     
         return view('add_medical',['med'=>$med,'city'=>$city]);
    }

    public function create(Request $request){

        $request->validate([
            
                
            'city' => 'required',
            'medical' => 'required',
            
           
            
        ]);
        $med=new Medical;
        $med->city_id=$request->get('city');
        $med->medical=$request->get('medical');
        $med->save(); 
        return redirect(route('medical'))->with(['success' => 'Data Successfully Submitted !', 'cityvariable' => $request->get('city')]);
        }
       
        public function edit($id)
          {
              $mededit = Medical::find($id); 
              $med = Medical::  
              join ('cities','cities.id','=','medicals.city_id')
              ->orderby('medicals.id','desc')
              ->select('medicals.*','cities.city')
              ->get();
              $city=City::all();
              return view('editmedical',['mededit'=>$mededit,'med'=>$med,'city'=>$city]);
             
              
          }
         
          public function update(Request $request)
          {
            Medical::where('id',$request->id)->update([ 
               'city_id'=>$request->city,
               'medical'=>$request->medical,
               
           ]);
       
            return redirect()->route('medical')->with(['success'=>true,'message'=>'Successfully Updated !']);
          }
       
       
          public function destroy($id)
          {
              $med=Medical::where('id',$id)->delete();
              return redirect(route('medical'));
          }
       
       
       
}
