<?php

namespace App\Http\Controllers;
use App\Models\Addcompany;
use Illuminate\Support\Facades\Validator;
use App\Models\Year;
use App\Models\Promotor_Sale;
use App\Models\ProfitLoss;
use Illuminate\Http\Request;

class Profit_and_loss_Controller extends Controller
{
    public function index(){
        $exp_entry=ProfitLoss::join('years','years.id','=','profit_losses.select_year')
        ->join('promotor__sales','promotor__sales.id','=','profit_losses.select_month')
        ->join('addcompanies','addcompanies.id','=','profit_losses.select_company')
   
        ->select('profit_losses.*','years.year','promotor__sales.sale_of_month','addcompanies.Name',)
        ->get();
        $year=Year::all();
        $month=Promotor_Sale::all();
        $company=Addcompany::all();
       
                return view('profit-and-loss-statement',['exp_entry'=>$exp_entry,'year'=>$year,'month'=>$month,'company'=>$company]);
            }
        
        
        
        
        
        
        public function create_profit_loss(Request $request){
        
            $validator = Validator::make(
                $request->all(),
                [
                    
                    'select_year' => ['required'],
                    'select_month' => ['required'],
                    'select_company' => ['required'],
                    
                   
        ],
             [
                   
                    
                    'select_year.required' => 'Please Select Year.',
                     'select_month.required' => 'Please Select Month.',
                    'select_company.required' => 'Please Select Company.',
                
                   
                   
                ]);
                if ($validator->fails()) {
                    $errors = '';
                    $messages = $validator->messages();
                    foreach ($messages->all() as $message) {
                        $errors .= $message . "<br>";
                    }
                    return back()->with(['error'=>$errors]);
                }
        
            $vendor= new ProfitLoss;
            $vendor->select_year=$request->get('select_year');
            $vendor->select_month=$request->get('select_month');
            $vendor->select_company=$request->get('select_company');
           
            $vendor->save();
        return redirect(route('profit_loss'))->with(['success' => 'Data Successfully Submitted !']);
        }
        
        
        public function edit_profit_loss($id){
            $ven=ProfitLoss::find($id);
            $exp_entry=ProfitLoss::join('years','years.id','=','profit_losses.select_year')
        ->join('promotor__sales','promotor__sales.id','=','profit_losses.select_month')
        ->join('addcompanies','addcompanies.id','=','profit_losses.select_company')
    
        ->select('profit_losses.*','years.year','promotor__sales.sale_of_month','addcompanies.Name',)
        ->get();
        $year=Year::all();
        $month=Promotor_Sale::all();
        $company=Addcompany::all();

        
            return view('edit_profit_loss',['ven'=>$ven,'exp_entry'=>$exp_entry,'year'=>$year,'month'=>$month,'company'=>$company]);
        }
        
        public function update_profit_loss(Request $request){
            $validator = Validator::make(
                $request->all(),
                [
                    
                    'select_year' => ['required'],
                    'select_month' => ['required'],
                    'select_company' => ['required'],
                 
                   
        ],
             [
                   
                    
                    'select_year.required' => 'Please Select Year.',
                     'select_month.required' => 'Please Select Month.',
                    'select_company.required' => 'Please Select Company.',
                   
                   
                   
                ]);
                if ($validator->fails()) {
                    $errors = '';
                    $messages = $validator->messages();
                    foreach ($messages->all() as $message) {
                        $errors .= $message . "<br>";
                    }
                    return back()->with(['error'=>$errors]);
                }
        
            $vendor=ProfitLoss::find($request->id);
            $vendor->select_year=$request->get('select_year');
            $vendor->select_month=$request->get('select_month');
            $vendor->select_company=$request->get('select_company');
       
            $vendor->save();
        
        return redirect(route('profit_loss'))->with(['success' => 'Data Successfully Submitted !']);
        
        }
        
        
        public function destroy_profit_loss($id){
            $des=ProfitLoss::where('id',$id)->delete();
            return redirect(route('profit_loss'))->with(['success' => 'Data Successfully Deleted !']);
        }
        
        
        
        
        
}
