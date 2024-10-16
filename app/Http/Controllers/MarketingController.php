<?php

namespace App\Http\Controllers;

use App\Models\Marketing;
use App\Models\City;
use App\Models\Addcompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MarketingController extends Controller
{
    public function index(){
        $mark=Marketing::
        leftjoin ('cities','cities.id','=','marketings.city_id')
        ->join('addcompanies','addcompanies.id','=','marketings.select_company_id')
        ->orderby('marketings.id','desc')
        ->select('marketings.*','cities.city','addcompanies.Name')
        ->get();
        $city=City::all();
        $addcompanies=Addcompany::all();
        
     
         return view('addmarketing',['mark'=>$mark,'city'=>$city,'addcompanies'=>$addcompanies]);
      
    }
    public function create(Request $request){


        $request->validate([
            
                
            'city_id' => 'required',
            'select_company_id' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'address' => 'required',
            'username' => 'required',
            'password' => 'required',
            // 'image' => 'required',
            // 'images' => 'required',
            
        ]);
        $mark=new Marketing();

        $filename='';
        if($request->hasFile('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('shubhastu_img/'), $filename);
            $mark->pan= 'shubhastu_img/'.$filename;
        }
            $filename='';
            if($request->hasFile('images')){
                $file= $request->file('images');
                $filename= date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('shubhastu_img/'), $filename);
                $mark->aadhar_card= 'shubhastu_img/'.$filename;
        }

        $mark->city_id=implode(',',$request->get('city_id'));
        $mark->select_company_id=implode(',',$request->get('select_company_id'));
        $mark->name=$request->get('name');
        $mark->mobile=$request->get('mobile');
        $mark->email=$request->get('email');
        $mark->address=$request->get('address');
        $mark->username=$request->get('username');
        $mark->plain_password=$request->get('password');
        $mark->password=Hash::make($request->get('password'));
        $mark->save(); 
        return redirect(route('marketing'))->with(['success' => 'Data Successfully Submitted !', 'company' => $request->get('select_company_id'),'city' =>$request->get('city_id')]);
        }
       
        public function edit($id)
          {
       $mededit = Marketing::find($id); 
       $mark=Marketing::
        leftjoin ('cities','cities.id','=','marketings.city_id')
        ->join('addcompanies','addcompanies.id','=','marketings.select_company_id')
        ->orderby('marketings.id','desc')
        ->select('marketings.*','cities.city','addcompanies.Name')
        ->get();
        $city=City::all();
        $addcompanies=Addcompany::all();
         return view('editmarketing',['mededit'=>$mededit,'mark'=>$mark,'city'=>$city,'mark'=>$mark,'addcompanies'=>$addcompanies]);
             
              
          }
         
          public function update(Request $request)
          {


            $request->validate([
            
                
                'city_id' => 'required',
               
            ]);
            $mark=Marketing::find($request->id);
                $filename='';
                if($request->hasFile('image')){
                    $file= $request->file('image');
                    $filename= date('YmdHi').'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('shubhastu_img/'), $filename);
                    $mark->pan= 'shubhastu_img/'.$filename;
                }
                    $filename='';
                    if($request->hasFile('images')){
                        $file= $request->file('images');
                        $filename= date('YmdHi').'.'.$file->getClientOriginalExtension();
                        $file->move(public_path('shubhastu_img/'), $filename);
                        $mark->aadhar_card= 'shubhastu_img/'.$filename;
                }
        
        
                $mark->city_id=implode(',',$request->get('city_id')); 
                $mark->select_company_id=implode(',',$request->get('select_company_id'));        
                $mark->name=$request->get('name');
                $mark->mobile=$request->get('mobile');
                $mark->email=$request->get('email');
                $mark->address=$request->get('address');
                $mark->username=$request->get('username');
                $mark->plain_password=$request->get('password');
                $mark->password= Hash::make($request->get('password'));
                // dump($mark);
                $mark->save(); 
               
           
       
            return redirect()->route('marketing')->with(['success'=>'Successfully Updated !']);
          }
       
       
          public function destroy($id)
          {
              $med=Marketing::where('id',$id)->delete();
              return redirect(route('marketing'));
          }
       
       
       
}

