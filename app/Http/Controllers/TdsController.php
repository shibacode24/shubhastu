<?php

namespace App\Http\Controllers;

use  App\Models\Tds;
use App\Models\Promotor_Sale;
use Illuminate\Http\Request;


class TdsController extends Controller
{
    public function index(){
//         $data=Promotor_Sale::all();
       
//         return view('tds',compact('data'));
//     }

    
// public function update(Request $request)  {
    
// //    dd($request->all());

// Promotor_Sale::where([
//     'date'=>$request->date,
   
// ])->first();

// Promotor_Sale::updateOrCreate(
//     [
//         'date' => $request->get('date'),
       
//     ],
//     [
//         'date' => $request->get('date'),
//         'tds' => $request->get('td'),
       
//     ],
   
// );

   
//    return redirect(route('tds'));
  
// }
// public function destroy($id){
    
//     Promotor_Sale::where('id',$id)->delete();
//     return redirect(route('tds'));
// }

$data=Tds::first();
       
return view('tds',compact('data'));
}


public function update(Request $request)  {

//    dd($request->all());

Tds::where([
'date'=>$request->date,

])->first();

Tds::updateOrCreate(
[
'date' => $request->get('date'),

],
[
'date' => $request->get('date'),
'tds' => $request->get('td'),

],

);


return redirect(route('tds'));

}
public function destroy($id){

Tds::where('id',$id)->delete();
return redirect(route('tds'));
}

    
}


        // public function index(){
        //     $data=Fedralrebate::find(1);
        //     return view('Tax_Master.fedraltax_rebate',compact('data'));
        // }
        
        // public function create_fedraltaxrebate(Request $request){
            
        //     $fedr=Fedralrebate::find(1);
        //     $fedr->date=$request->get('date');
        //     $fedr->save();
        //     return back()->with(['success'=>'Data updated successfully.']);
        
        // }
        
      