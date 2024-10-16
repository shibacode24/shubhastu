<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stockist;
use App\Models\City;

class StockistController extends Controller
{
 public function index(){

   $stock=Stockist::
   join ('cities','cities.id','=','stockists.city_id')
   ->orderby('stockists.id','desc')
   ->select('stockists.*','cities.city')
   ->get();
   $city=City::all();

    return view('stockist',['stock'=>$stock,'city'=>$city]);
 }

 public function create(Request $request){

  $request->validate([
            
                
    'city' => 'required',
    'stockist' => 'required',        
   
    
]);
 $stock=new Stockist;
 $stock->city_id=$request->get('city');
 $stock->stockist=$request->get('stockist');
 $stock->save(); 
//  return redirect(route('stockist'));
 return redirect(route('stockist'))->with(['success' => 'Data Successfully Submitted !', 'city' => $request->get('city')]);
 }

 public function edit($id)
   {
       $stockedit = Stockist::find($id); 
       $stock = Stockist::  
       join ('cities','cities.id','=','stockists.city_id')
       ->orderby('stockists.id','desc')
       ->select('stockists.*','cities.city')
       ->get();
       $city=City::all();
       return view('editstockist',['stockedit'=>$stockedit,'stock'=>$stock,'city'=>$city]);
      
       
   }
  
   public function update(Request $request)
   {
      Stockist::where('id',$request->id)->update([ 
        'city_id'=>$request->city,
        'stockist'=>$request->stockist,
        
    ]);

     return redirect()->route('stockist')->with(['success'=>'Successfully Updated !']);
   }


   public function destroy($id)
   {
       $stock=Stockist::where('id',$id)->delete();
       return redirect(route('stockist'));
   }



}
