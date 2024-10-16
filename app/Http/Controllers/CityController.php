<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\Validator;


class CityController extends Controller
{
    public function index(){
        $city=City::all();
        return view('city',['city'=>$city]);
    }
public function create(Request $request){

   $validator = Validator::make(
        $request->all(),
        [ 
            'city' => ['required'],   
    ],
     [
           'city.required' => 'Please Enter City Name.',
 ]);
        if ($validator->fails()) {
            $errors = '';
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                $errors .= $message . "<br>";
            }
            return back()->with(['error'=>$errors]);
        }
    $city=new City;
    $city->city=$request->get('city');
    $city->save();
 
 return redirect(route('city'))->with(['success'=>'data inserted successfully.']);
}
public function edit(city $city,$id)
    {
        $cityedit = City::find($id); 
        $city = City::all();
        return view('editcity',['citys'=>$cityedit,'city'=>$city]);
       
        
    }
   
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                
                'city' => ['required'],
                 
        ],
         [
               
                
                'city.required' => 'Please Enter City Name.',
                
               
            ]);
            if ($validator->fails()) {
                $errors = '';
                $messages = $validator->messages();
                foreach ($messages->all() as $message) {
                    $errors .= $message . "<br>";
                }
                return back()->with(['error'=>$errors]);
            }
        City::where('id',$request->id)->update([ 'city'=>$request->city]);

      return redirect()->route('city')->with(['success'=>true,'message'=>'Successfully Updated !']);
    }
    // return redirect(route('customer'))->with(['success'=>'Successfully Updated !']);

    public function destroy(city $city,$id)
    {
        $city=city::where('id',$id)->delete();
        return redirect(route('city'));
    }
}

