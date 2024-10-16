<?php

namespace App\Http\Controllers;
use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function index(){

        $y=Year::all();
        return view('year',['y'=>$y]);
}
public function create(Request $request){

    $request->validate([
            
        'year' => 'required',
        
    ]);
        $y=new Year;
        $y->year=$request->get('year');
        $y->save(); 
        return redirect(route('year'));
}
public function edit(Year $year,$id)
    {
        $yearedit = Year::find($id); 
        $year = Year::all();
        return view('edityear',['years'=>$yearedit,'year'=>$year]);
       
        
    }
   
    public function update(Request $request)
    {
        Year::where('id',$request->id)->update([ 'year'=>$request->year]);

      return redirect()->route('year')->with(['success'=>true,'message'=>'Successfully Updated !']);
    }


    public function destroy(Year $year,$id)
    {
        $year=Year::where('id',$id)->delete();
        return redirect(route('year'));
    }



}
