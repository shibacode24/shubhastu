<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\EmployeRegister;
use Illuminate\Http\Request;

class EmployeregistrationController extends Controller
{
    public function index(){
        $employee=EmployeRegister::all();
        return view('employe-registration',['employee'=>$employee]);
    }

    public function create(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                
                'employee_name' => ['required'],
                'contact_no' => ['required'],
                'email_id' => ['required'],
                'address' => ['required'],
               
    ],
         [
               
                
                'employee_name.required' => 'Please enter Employee Name.',
                 'contact_no.required' => 'Please enter Mobile Number.',
                'email_id.required' => 'Please enter Email.',
                 'address.required' => 'Please enter Address.',
               
               
            ]);
            if ($validator->fails()) {
                $errors = '';
                $messages = $validator->messages();
                foreach ($messages->all() as $message) {
                    $errors .= $message . "<br>";
                }
                return back()->with(['error'=>$errors]);
            }
    
        $employee= new EmployeRegister;
        $employee->employee_name=$request->get('employee_name');
        $employee->contact_no=$request->get('contact_no');
        $employee->email_id=$request->get('email_id');
        $employee->address=$request->get('address');
        $employee->save();
    return redirect(route('employe_register'))->with(['success' => 'Data Successfully Submitted !']);
    }


    public function edit($id){
        $emp=EmployeRegister::find($id);
        $employee_reg=EmployeRegister::all();
        return view('edit_employee_registration',['emp'=>$emp,'employee_reg'=>$employee_reg]);
    }

    public function update(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                
                'employee_name' => ['required'],
                'contact_no' => ['required'],
                'email_id' => ['required'],
                'address' => ['required'],
               
    ],
         [
               
                
                'employee_name.required' => 'Please enter Employee Name.',
                 'contact_no.required' => 'Please enter Mobile Number.',
                'email_id.required' => 'Please enter Email.',
                 'address.required' => 'Please enter Address.',
               
               
            ]);
            if ($validator->fails()) {
                $errors = '';
                $messages = $validator->messages();
                foreach ($messages->all() as $message) {
                    $errors .= $message . "<br>";
                }
                return back()->with(['error'=>$errors]);
            }
    
        $employee=EmployeRegister::find($request->id);
        $employee->employee_name=$request->get('employee_name');
        $employee->contact_no=$request->get('contact_no');
        $employee->email_id=$request->get('email_id');
        $employee->address=$request->get('address');
        $employee->save();
    return redirect(route('employe_register'))->with(['success' => 'Data Successfully Submitted !']);

    }


    public function destroy($id){
        $des=EmployeRegister::where('id',$id)->delete();
        return redirect(route('employe_register'))->with(['success' => 'Data Successfully Deleted !']);
    }
}
