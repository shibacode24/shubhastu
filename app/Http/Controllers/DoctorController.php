<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;
use App\Models\Medical;
use Illuminate\Support\Facades\Validator;
use App\Models\City;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(){

      $doctors = Doctor::get();

          // foreach ($doctors as $doctor) {
          //     Doctor::where('id', $doctor->id)->update([
          //         'plain_password' => $doctor->mobile,
          //         'password' => Hash::make($doctor->mobile),
          //     ]);
          // }

        $doc=Doctor::
        join ('cities','cities.id','=','doctors.city_id')
        // ->join('medicals','medicals.id','=','doctors.medical_id')
        ->orderby('doctors.id','desc')
        ->select('doctors.*','cities.city')
        ->get();
        $city=City::all();
        $medical=Medical::all();
        
     
         return view('add_doctor',['doc'=>$doc,'city'=>$city,'medical'=>$medical]);
      
    }
    public function create(Request $request){

      $validator = Validator::make(
        $request->all(),
        [
            
            'allotted_dr_name' => ['required'],
            'hospital_address' => ['required'],
            'mobile' => ['required'],
            'email' => ['required'],
            'promoter_name' => ['required'],
            'account_number' => ['required'],
            'ifsc' => ['required'],
            // 'pan_no' => ['required'],  
          'username' => ['required'], 
           'password' => ['required'], 
//           ' city_id' => ['required'],  
// ' medical_id'  => ['required'], 
 'Scheme' => ['required'], 
],
     [
           
            
            'allotted_dr_name.required' => 'Please enter Client Name.',
             'hospital_address.required' => 'Please enter Hospital/Pharmacy Address.',
            'mobile.required' => 'Please enter Mobile Number.',
             'email.required' => 'Please enter Email.',
            'promoter_name.required' => 'Please enter Promotor Name.',
           'account_number'  => 'Please enter Account Number.',
           'ifsc' => 'Please enter IFC.',
          //  'pan_no' => 'Please enter Pan Number.',
           'username' => 'Please enter Username.',
           'password'  => 'Please enter Password.',
          //  'city_id' => 'Please enter City.',
          //  'medical_id' => 'Please enter Medical.',
           'Scheme' => 'Please enter Scheme.',
    
           
        ]);
        if ($validator->fails()) {
            $errors = '';
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                $errors .= $message . "<br>";
            }
            return back()->with(['error'=>$errors]);
        }

   
        $doc=new Doctor;
        $doc->allotted_dr_name=$request->get('allotted_dr_name');
        $doc->hospital_address=$request->get('hospital_address');
        $doc->mobile=$request->get('mobile');
        $doc->email=$request->get('email');
        $doc->promoter_name=$request->get('promoter_name');
        $doc->account_number=$request->get('account_number');
        $doc->ifsc=$request->get('ifsc');
        $doc->pan_no=$request->get('pan_no');
        $doc->username=$request->get('username');
        $doc->plain_password=$request->get('password');
        $doc->password=Hash::make($request->get('password'));
        $doc->city_id=$request->get('city_id');
        $doc->medical_id=$request->get('medical_id');
        $doc->Scheme=implode(',',$request->get('Scheme'));//for checkbox
        $doc->save(); 
      
        return redirect(route('doctor'))->with(['success' => 'Data Successfully Submitted !', 'cityvariable' => $request->get('city_id'),'medical'=>$request->get('medical_id')]);
        }
       
        public function edit($id)
          {
       $mededit = Doctor::find($id); 
       $doc=Doctor::
        join ('cities','cities.id','=','doctors.city_id')
       
        ->orderby('doctors.id','desc')
        ->select('doctors.*','cities.city')
        ->get();
        $city=City::all();
        $medic=Medical::all();
         return view('editdoctor',['mededit'=>$mededit,'doc'=>$doc,'city'=>$city,'doc'=>$doc,'medic'=>$medic]);
             
              
          }
         
          public function update(Request $request)
          {

            $validator = Validator::make(
              $request->all(),
              [
                  
                  'allotted_dr_name' => ['required'],
                  'hospital_address' => ['required'],
                  'mobile' => ['required'],
                  'email' => ['required'],
                  'promoter_name' => ['required'],
                  'account_number' => ['required'],
                  'ifsc' => ['required'],
                  'pan_no' => ['required'],  
                'username' => ['required'], 
                 'password' => ['required'], 
      //           ' city_id' => ['required'],  
      // ' medical_id'  => ['required'], 
       'Scheme' => ['required'], 
      ],
           [
                 
                  
                  'allotted_dr_name.required' => 'Please enter Client Name.',
                   'hospital_address.required' => 'Please enter Hospital/Pharmacy Address.',
                  'mobile.required' => 'Please enter Mobile Number.',
                   'email.required' => 'Please enter Email.',
                  'promoter_name.required' => 'Please enter Promotor Name.',
                 'account_number'  => 'Please enter Account Number.',
                 'ifsc' => 'Please enter IFC.',
                //  'pan_no' => 'Please enter Pan Number.',
                 'username' => 'Please enter Username.',
                 'password'  => 'Please enter Password.',
                //  'city_id' => 'Please enter City.',
                //  'medical_id' => 'Please enter Medical.',
                 'Scheme' => 'Please enter Scheme.',
          
                 
              ]);
              if ($validator->fails()) {
                  $errors = '';
                  $messages = $validator->messages();
                  foreach ($messages->all() as $message) {
                      $errors .= $message . "<br>";
                  }
                  return back()->with(['error'=>$errors]);
              }
      
      
      
            $doc=Doctor::find($request->id);
                
            // $doc=new Doctor;
            $doc->allotted_dr_name=$request->get('allotted_dr_name');
            $doc->hospital_address=$request->get('hospital_address');
            $doc->mobile=$request->get('mobile');
            $doc->email=$request->get('email');
            $doc->promoter_name=$request->get('promoter_name');
            $doc->account_number=$request->get('account_number');
            $doc->ifsc=$request->get('ifsc');
            $doc->pan_no=$request->get('pan_no');
            $doc->username=$request->get('username');
            $doc->plain_password=$request->get('password');
            $doc->password=Hash::make($request->get('password'));
            $doc->city_id=$request->get('city_id');
            $doc->medical_id=$request->get('medical_id');
            $doc->Scheme=implode(',',$request->get('Scheme'));//for checkbox
            $doc->save(); 
            return redirect(route('doctor'))->with(['success'=>true,'message'=>'Successfully Updated !']);
            }
       
       
          public function destroy($id)
          {
              $med=Doctor::where('id',$id)->delete();
              return redirect(route('doctor'));
          }
       
   //for updating multiple user data 
//        public function password()
// {
//     $doctors = Doctor::get();

//     foreach ($doctors as $doctor) {
//         Doctor::where('id', $doctor->id)->update([
//             'plain_password' => $doctor->mobile,
//             'password' => Hash::make($doctor->mobile),
//         ]);
//     }
//     return redirect(route('doctor'));

// }
       
}


