<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseHead;
use App\Models\Star;
use App\Models\Addcompany;
use App\Models\Category;
use App\Models\Year;
use App\Models\ExpenseHead1;
use App\Models\Promotor_Sale;
use App\Models\ExpenseEntry;
use App\Models\ExpenseEntry1;
use DB;
use App\Models\VendorRgistration;
use Illuminate\Support\Facades\Validator;

class ExpenceEntryController extends Controller
{
    public function index(){
// $exp_entry=ExpenseEntry::join('years','years.id','=','expense_entries.select_year')
// ->join('expense_entry1s','expense_entry1s.expense_entry_id','=','expense_entries.id')
// ->join('promotor__sales','promotor__sales.id','=','expense_entries.select_month')
// ->join('addcompanies','addcompanies.id','=','expense_entries.select_company')
// ->join('categories','categories.id','=','expense_entries.select_category')
// ->select('expense_entries.*','years.year','promotor__sales.sale_of_month','addcompanies.Name','categories.category','expense_entry1s.*')
// // ->groupby('expense_entries.id')
// ->groupby('expense_entry1s.expense_entry_id')


$exp_entry = ExpenseEntry::join('years', 'years.id', '=', 'expense_entries.select_year')
    ->leftJoin('expense_entry1s', 'expense_entry1s.expense_entry_id', '=', 'expense_entries.id')
    ->join('addcompanies', 'addcompanies.id', '=', 'expense_entries.select_company')
    ->select('expense_entries.select_year', 'expense_entries.select_month', 'expense_entries.select_company', 'expense_entries.id as expense_entries_id', 'years.year', 'addcompanies.Name', 'expense_entry1s.*')
    ->groupBy('select_year', 'select_month', 'select_company')
    ->orderBy('expense_entries.select_year', 'desc') // Order by year_id in ascending order
    // ->orderBy('expense_entries.select_month', 'desc') // Then by select_month in descending order
    ->orderByRaw("
        CASE 
            WHEN expense_entries.select_month = 'December' THEN 1
            WHEN expense_entries.select_month = 'November' THEN 2
            WHEN expense_entries.select_month = 'October' THEN 3
            WHEN expense_entries.select_month = 'September' THEN 4
            WHEN expense_entries.select_month = 'August' THEN 5
            WHEN expense_entries.select_month = 'July' THEN 6
            WHEN expense_entries.select_month = 'June' THEN 7
            WHEN expense_entries.select_month = 'May' THEN 8
            WHEN expense_entries.select_month = 'April' THEN 9
            WHEN expense_entries.select_month = 'March' THEN 10
            WHEN expense_entries.select_month = 'February' THEN 11
            WHEN expense_entries.select_month = 'January' THEN 12
        END
    ")
    ->get();


$year=Year::all();
$month=Promotor_Sale::all();
$company=Addcompany::all();
$category=Category::all();
$vendor=VendorRgistration::all();
        return view('expence-entry',['exp_entry'=>$exp_entry,'year'=>$year,'month'=>$month,'company'=>$company,'category'=>$category,'vendor'=>$vendor]);
    }






public function create_expence_entry(Request $request){

    $validator = Validator::make(
        $request->all(),
        [
            
            'select_year' => ['required'],
            'select_month' => ['required'],
            'select_company' => ['required'],
            // 'select_category' => ['required'],
           
],
     [
           
            
            'select_year.required' => 'Please Select Year.',
             'select_month.required' => 'Please Select Month.',
            'select_company.required' => 'Please Select Company.',
            //  'select_category.required' => 'Please Select Category.',
           
           
        ]);
        if ($validator->fails()) {
            $errors = '';
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                $errors .= $message . "<br>";
            }
            return back()->with(['error'=>$errors]);
        }
        $vendor = ExpenseEntry::firstOrCreate(
            [
                'select_year'=>$request->get('select_year'),
                'select_month'=>$request->get('select_month'),
                'select_company'=>$request->get('select_company'),
               
            ],
            [
                'select_year'=>$request->get('select_year'),
                'select_month'=>$request->get('select_month'),
                'select_company'=>$request->get('select_company'),
            ]
            );
    
            // dd($vendor->id);
    //         $vendor= new ExpenseEntry;
    // $vendor->select_year=$request->get('select_year');
    // $vendor->select_month=$request->get('select_month');
    // $vendor->select_company=$request->get('select_company');
    // // echo json_encode($vendor);
    // // exit();
    // $vendor->save();

    $insert_id=$vendor->id;
    for($i=0;$i<count($request->amount); $i++){
        if (isset($request->amount[$i])){
            $mobile_module1=new ExpenseEntry1;
            $mobile_module1->expense_entry_id=$insert_id;
           $mobile_module1->amount=$request->amount[$i];
           $mobile_module1->select_expense=$request->expense[$i];
            $mobile_module1->select_category=$request->select_category[$i];
            $mobile_module1->expence_head=$request->expence_head[$i];
            // echo json_encode($mobile_module1);
            // exit();
            $mobile_module1->save();
}
    }
return redirect(route('expence_entry'))->with(['success' => 'Data Successfully Submitted !']);
}


public function delete_added_expence_entry(Request $request)
{
    ExpenseEntry1::find($request->id)->delete();
    return back();
}

public function edit_expence_entry($id){

    $ven=ExpenseEntry::find($id);

    $expense_entry_list = ExpenseEntry1 ::where('expense_entry_id',$ven->id)->get();

    $exp_entry = ExpenseEntry::Join('years', 'years.id', '=', 'expense_entries.select_year')
    ->leftJoin('expense_entry1s', 'expense_entry1s.expense_entry_id', '=', 'expense_entries.id')
    ->Join('addcompanies', 'addcompanies.id', '=', 'expense_entries.select_company')
    ->select('expense_entries.select_year','expense_entries.select_month','expense_entries.select_company','expense_entries.id as expense_entries_id', 'years.year', 'addcompanies.Name', 'expense_entry1s.*')
    ->groupBy('select_year', 'select_month', 'select_company')
    ->get();


        $year=Year::all();
        $month=Promotor_Sale::all();
        $company=Addcompany::all();
        $category=Category::all();
        $vendor=VendorRgistration::all();

    return view('edit_expense_entry',['ven'=>$ven,'exp_entry'=>$exp_entry,'year'=>$year,'month'=>$month,'company'=>$company,'category'=>$category,'vendor'=>$vendor,'expense_entry_list'=>$expense_entry_list]);
}

public function update_expence_entry(Request $request){
    // dd($request->all());
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

       // $vendor=ExpenseEntry::find($request->id);

     $vendor = ExpenseEntry::find($request->id)->Update(
            [
                'select_year'=>$request->get('select_year'),
                'select_month'=>$request->get('select_month'),
                'select_company'=>$request->get('select_company'),
            ]
            );
    //exit();
  //  $insert_id= $vendor->id;

    ExpenseEntry1::where('expense_entry_id',$request->id)->delete();

    for($i=0;$i<count($request->amount); $i++){
        if (isset($request->amount[$i])){
            $mobile_module1=new ExpenseEntry1;
            $mobile_module1->expense_entry_id=$request->id;
           $mobile_module1->amount=$request->amount[$i];
           $mobile_module1->select_expense=$request->expense[$i];
            $mobile_module1->select_category=$request->select_category[$i];
            $mobile_module1->expence_head=$request->expence_head[$i];
            // echo json_encode($mobile_module1);
            // exit();
            $mobile_module1->save();
}
    }


return redirect(route('expence_entry'))->with(['success' => 'Data Successfully Submitted !']);

}


public function destroy_expence_entry($id){
    $delete=ExpenseEntry1::where('expense_entry_id',$id)->delete();
    $des=ExpenseEntry::where('id',$id)->delete();
    return redirect(route('expence_entry'))->with(['success' => 'Data Successfully Deleted !']);
}


public function get_expense_head(Request $request)
  
{
    // dd($request->all());expense_heads,expense_head_id
$drschem=DB::table('expense_head1s')

->where([

    'expense_head1s.select_category'=>$request->id, 
])
->leftjoin('expense_heads','expense_heads.expense_head_id','=','expense_head1s.id')

->select('expense_heads.expense','expense_heads.id')
->get();

return response()->json($drschem);
}


public function getrecord(Request $request)
{
    $ExpenseEntry = ExpenseEntry::where('id', $request->expense_entry_id )->first();

    $ids_Array = ExpenseEntry::where('select_year', $ExpenseEntry->select_year)
        ->where('select_month', $ExpenseEntry->select_month)
        ->where('select_company', $ExpenseEntry->select_company)
        ->pluck('id')->toArray();
    
    // dd($ids_Array);

    $module=DB::table('expense_entry1s')
    ->leftjoin('categories', 'categories.id', '=', 'expense_entry1s.select_category')
       ->whereIn( 'expense_entry1s.expense_entry_id',$ids_Array )
       ->select('expense_entry1s.*','categories.category')
       ->orderby('id','asc')
       ->get();
//echo json_encode($module);

    return response()->json(['module'=>$module]);
} 

//.........................Category master.................//

public function category(){
    $category=Category::all();
    return view('add_category',['category'=>$category]);
}
    public function create_category(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                
                'category' => ['required'],
               
    ],
         [
                'category.required' => 'Please enter Category.',
                 
            ]);
            if ($validator->fails()) {
                $errors = '';
                $messages = $validator->messages();
                foreach ($messages->all() as $message) {
                    $errors .= $message . "<br>";
                }
                return back()->with(['error'=>$errors]);
            }
    
        $expence= new Category;
        $expence->category=$request->get('category');
               $expence->save();
    return redirect(route('category'))->with(['success' => 'Data Successfully Submitted !']);
    }


    public function edit_category($id){
        $cat=Category::find($id);
        $category=Category::all();
        return view('edit_category',['cat'=>$cat,'category'=>$category]);
    }

    public function update_category(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                
                'category' => ['required'],
        
    ],
         [
               
                'category.required' => 'Please enter category.',
            ]);
            if ($validator->fails()) {
                $errors = '';
                $messages = $validator->messages();
                foreach ($messages->all() as $message) {
                    $errors .= $message . "<br>";
                }
                return back()->with(['error'=>$errors]);
            }
    
        $expence=Category::find($request->id);
        $expence->category=$request->get('category');
       
        $expence->save();
    return redirect(route('category'))->with(['success' => 'Data Successfully Submitted !']);

    }


    public function destroy_category($id){
        
        $des=Category::where('id',$id)->delete();
        return redirect(route('category'))->with(['success' => 'Data Successfully Deleted !']);
    }


//........................EXPENCE HEAD......................//


    public function expence_head(){
        $exp_head=ExpenseHead1::
        leftjoin('expense_heads','expense_heads.expense_head_id','=','expense_head1s.id')
        ->join('categories','categories.id','=','expense_head1s.select_category')
        ->select('expense_heads.*','categories.category','expense_head1s.*')
        ->groupby('expense_head1s.select_category')
        ->get();
       
        // echo json_encode($exp_head);
        // exit();
        $category=Category::all();
       
        return view('expence-head',['exp_head'=>$exp_head,'category'=>$category]);
    }


    public function create_expence_head(Request $request){
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                
                'expense' => ['required'],
               
    ],
         [
                'expense.required' => 'Please enter Employee Name.',
                 
            ]);
            if ($validator->fails()) {
                $errors = '';
                $messages = $validator->messages();
                foreach ($messages->all() as $message) {
                    $errors .= $message . "<br>";
                }
                return back()->with(['error'=>$errors]);
            }

            $expence = ExpenseHead1::firstOrCreate(
                [
                    'select_Category'=>$request->get('select_category'),   
                ],
                [

                    'select_Category'=>$request->get('select_category'),
                ]
                );
        // $expence= new ExpenseHead1;

        // $expence->select_category=$request->get('select_category');
        //        $expence->save();

               $insert_id=$expence->id;
               for($i=0;$i<count($request->expense); $i++){
                   if (isset($request->expense[$i])){
                       $mobile_module1=new ExpenseHead;
                       $mobile_module1->expense_head_id=$insert_id;
                      $mobile_module1->expense=$request->expense[$i];
               $mobile_module1->save();
           }
       }
       
    return redirect(route('expence_head'))->with(['success' => 'Data Successfully Submitted !']);
    }


    public function edit_expence_head($id){
        $exp=ExpenseHead::find($id);
        $expense=ExpenseHead::join('categories','categories.id','=','expense_heads.select_category')
        ->select('expense_heads.*','categories.category')
        ->get();
       
        $category=Category::all();

        return view('edit_expense_head',['exp'=>$exp,'expense'=>$expense,'category'=>$category]);
    }

    public function update_expence_head(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                
                'expense' => ['required'],
        
    ],
         [
               
                'expense.required' => 'Please enter Expense.',
            ]);
            if ($validator->fails()) {
                $errors = '';
                $messages = $validator->messages();
                foreach ($messages->all() as $message) {
                    $errors .= $message . "<br>";
                }
                return back()->with(['error'=>$errors]);
            }
    
        $expence=ExpenseHead::find($request->id);
        $expence->expense=$request->get('expense');
        $expence->select_category=$request->get('select_category');

        $expence->save();
    return redirect(route('expence_head'))->with(['success' => 'Data Successfully Submitted !']);

    }


    public function destroy_expence_head($id){
        $delete=ExpenseHead::where('expense_head_id',$id)->delete();
        $des=ExpenseHead1::where('id',$id)->delete();
        return redirect(route('expence_head'))->with(['success' => 'Data Successfully Deleted !']);
    }


    public function get_records(Request $request)
    {
    
         $module=DB::table('expense_heads')
     
            ->where([
        
                'expense_heads.expense_head_id'=>$request->expense_head_id 
            ])
            ->select('expense_heads.*')
            ->get();
        return response()->json(['module'=>$module]);
    } 

    public function get_star(Request $request)
    {
    
         $result=DB::table('stars')
            ->where( 'select_company',$request->id)
            ->select('id','name_of_star')
            ->get();

        return response()->json(['status'=>true,'result'=>$result]);
    } 

//........................VENDOR REGISTRATION......................//


public function vendor(){
    $vendor=VendorRgistration::all(); 
    return view('vendor-registration',['vendor'=>$vendor]);
}

public function create_vendor(Request $request){

    $validator = Validator::make(
        $request->all(),
        [
            
            'vendor_name' => ['required'],
            'contact_no' => ['required'],
            'email_id' => ['required'],
            'address' => ['required'],
           
],
     [
           
            
            'vendor_name.required' => 'Please enter Vendor Name.',
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

    $vendor= new VendorRgistration;
    $vendor->vendor_name=$request->get('vendor_name');
    $vendor->contact_no=$request->get('contact_no');
    $vendor->email_id=$request->get('email_id');
    $vendor->address=$request->get('address');
    $vendor->save();
return redirect(route('vendor'))->with(['success' => 'Data Successfully Submitted !']);
}


public function edit_vendor($id){
    $ven=VendorRgistration::find($id);
    $ven_reg=VendorRgistration::all();
    return view('edit_vendor_reg',['ven'=>$ven,'ven_reg'=>$ven_reg]);
}

public function update_vendor(Request $request){
    $validator = Validator::make(
        $request->all(),
        [
            
            'vendor_name' => ['required'],
            'contact_no' => ['required'],
            'email_id' => ['required'],
            'address' => ['required'],
           
],
     [
           
            
            'vendor_name.required' => 'Please enter Vendor Name.',
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

    $vendor=VendorRgistration::find($request->id);
    $vendor->vendor_name=$request->get('vendor_name');
    $vendor->contact_no=$request->get('contact_no');
    $vendor->email_id=$request->get('email_id');
    $vendor->address=$request->get('address');
    $vendor->save();
return redirect(route('vendor'))->with(['success' => 'Data Successfully Submitted !']);

}


public function destroy_vendor($id){
    $des=VendorRgistration::where('id',$id)->delete();
    return redirect(route('vendor'))->with(['success' => 'Data Successfully Deleted !']);
}





//........................STAR......................//


public function star(){
    $star=Star::leftjoin('addcompanies','addcompanies.id','=','stars.select_company')
    ->orderby('stars.id','desc')
        ->select('stars.*','addcompanies.Name')
        ->get();
        $addcompanies=Addcompany:: all();
    return view('star',['star'=>$star,'addcompanies'=>$addcompanies]);
} 


public function create_star(Request $request){

    $validator = Validator::make(
        $request->all(),
        [
            
            'select_company' => ['required'],
            'name_of_star' => ['required'],
            'bank_name' => ['required'],
            'account_no' => ['required'],
           'ifsc_code'=>['required'],
           'pan_no'=>['required'],
],
     [
           
            
            'select_company.required' => 'Please Select Company Name.',
             'name_of_star.required' => 'Please enter Star Name.',
            'bank_name.required' => 'Please enter Bank Name.',
             'account_no.required' => 'Please enter Account Number.',
             'ifsc_code.required' => 'Please enter IFSC Code.',
             'pan_no.required' => 'Please enter Pan Number.',
           
           
        ]);
        if ($validator->fails()) {
            $errors = '';
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                $errors .= $message . "<br>";
            }
            return back()->with(['error'=>$errors]);
        }

    $star= new Star;
    $star->select_company=$request->get('select_company');
    $star->name_of_star=$request->get('name_of_star');
    $star->bank_name=$request->get('bank_name');
    $star->account_no=$request->get('account_no');
    $star->ifsc_code=$request->get('ifsc_code');
    $star->pan_no=$request->get('pan_no');
    $star->save();
return redirect(route('star'))->with(['success' => 'Data Successfully Submitted !']);
}


public function edit_star($id){
    $star1=Star::find($id);
    $star=Star::leftjoin('addcompanies','addcompanies.id','=','stars.select_company')
    ->orderby('stars.id','desc')
        ->select('stars.*','addcompanies.Name')
        ->get();
        $addcompanies=Addcompany:: all();
    return view('edit_star',['star1'=>$star1,'star'=>$star,'addcompanies'=>$addcompanies]);
}

public function update_star(Request $request){
    $validator = Validator::make(
        $request->all(),
        [
            
            'select_company' => ['required'],
            'name_of_star' => ['required'],
            'bank_name' => ['required'],
            'account_no' => ['required'],
           'ifsc_code'=> ['required'],
           'pan_no'=> ['required'],
],
     [
           
            
            'select_company.required' => 'Please Select Company Name.',
             'name_of_star.required' => 'Please enter Star Number.',
            'bank_name.required' => 'Please enter Bank Name.',
             'account_no.required' => 'Please enter Account Name.',
             'ifsc_code.required' => 'Please enter IFSC Code.',
             'pan_no.required' => 'Please enter Pan Number.',
           
           
        ]);
        if ($validator->fails()) {
            $errors = '';
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                $errors .= $message . "<br>";
            }
            return back()->with(['error'=>$errors]);
        }

    $star=Star::find($request->id);
    $star->select_company=$request->get('select_company');
    $star->name_of_star=$request->get('name_of_star');
    $star->bank_name=$request->get('bank_name');
    $star->account_no=$request->get('account_no');
    $star->ifsc_code=$request->get('ifsc_code');
    $star->pan_no=$request->get('pan_no');
    $star->save();
return redirect(route('star'))->with(['success' => 'Data Successfully Submitted !']);

}


public function destroy_star($id){
    $des=Star::where('id',$id)->delete();
    return redirect(route('star'))->with(['success' => 'Data Successfully Deleted !']);
}

public function superadmin_expence_report(){

    $exp_entry = ExpenseEntry::join('years', 'years.id', '=', 'expense_entries.select_year')
        ->leftJoin('expense_entry1s', 'expense_entry1s.expense_entry_id', '=', 'expense_entries.id')
        ->join('addcompanies', 'addcompanies.id', '=', 'expense_entries.select_company')
        ->select('expense_entries.select_year', 'expense_entries.select_month', 'expense_entries.select_company', 'expense_entries.id as expense_entries_id', 'years.year', 'addcompanies.Name', 'expense_entry1s.*')
        ->groupBy('select_year', 'select_month', 'select_company')
        ->orderBy('expense_entries.select_year', 'desc') // Order by year_id in ascending order
        ->orderBy('expense_entries.select_month', 'desc') // Then by select_month in descending order
        ->get();
    


    return view('superadmin_expence_report',['exp_entry'=>$exp_entry]);
        }

}
