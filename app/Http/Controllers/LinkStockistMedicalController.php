<?php

namespace App\Http\Controllers;
use App\Models\Link_Stockist_Medical;
use App\Models\Addcompany;
use App\Models\City;
use App\Models\Medical;
use App\Models\Stockist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LinkStockistMedicalController extends Controller
{
    public function index(){
        $mark=Link_Stockist_Medical::
        join ('cities','cities.id','=','link__stockist__medicals.select_city_id')
        ->join ('stockists','stockists.id','=','link__stockist__medicals.select_stockist_id')
        ->orderby('link__stockist__medicals.id','desc')
        ->select('link__stockist__medicals.*','cities.city','stockists.stockist')
        ->get();
        $city=City::all();
        $addcompanies=Addcompany::all();
        $stock=Stockist::all();
        $medica=Medical::all();
        
         return view('link_stockist_medical',['mark'=>$mark,'city'=>$city,'addcompanies'=>$addcompanies,'stock'=>$stock,'medica'=>$medica]);

    }
//     public function create(Request $request){

//       $validator = Validator::make(
//         $request->all(),
//         [
            
//             'select_city_id' => ['required'],
//             'select_company_id' => ['required'],
//             'select_stockist_id' => ['required'],
//             'select_medical_id' => ['required'],
             
//     ],
//      [
//             'select_city_id.required' => 'Please Select City.',
            
//             'select_company_id.required' => 'Please Select Company.',
//             'select_stockist_id.required' => 'Please Select Stockist.',
//             'select_medical_id.required' => 'Please Select Medical.',
           
//         ]);
//         if ($validator->fails()) {
//             $errors = '';
//             $messages = $validator->messages();
//             foreach ($messages->all() as $message) {
//                 $errors .= $message . "<br>";
//             }
//             return back()->with(['error'=>$errors]);
//         }
    
//     //     $mark=new Link_Stockist_Medical;
//     //     $mark->select_city_id=$request->get('select_city_id');
//     //     //$mark->select_company_id=implode(',',$request->get('select_company_id'));
//     //     $mark->select_company_id=$request->get('select_company_id');
//     //     $mark->select_stockist_id=$request->get('select_stockist_id');
//     //    //$mark->select_medical_id=implode(',',$request->get('select_medical_id'));
//     //     $mark->select_medical_id=$request->get('select_medical_id');
       
//     //     $mark->save(); 

//     $mark = new Link_Stockist_Medical;
// $mark->select_city_id = $request->get('select_city_id');
// $mark->select_company_id = $request->get('select_company_id');
// $mark->select_stockist_id = $request->get('select_stockist_id');
// $mark->select_medical_id = $request->get('select_medical_id');

// // Check if a record with the same select_stockist_id exists
// $existingRecord = Link_Stockist_Medical::where('select_stockist_id', $mark->select_stockist_id)
// ->whereJsonContains('select_medical_id', $mark->select_medical_id)
//     ->first();

//     // echo json_encode($existingRecord);
//     // exit();

// if ($existingRecord) {
//     // Record already exists, you can return a message or take appropriate action.
//     return redirect(route('linkstockist'))->with(['error'=>'Medical Already Exists.']);
// } else {
//     // Record does not exist, save it.
//     $mark->save();
//     return redirect(route('linkstockist'))->with(['success'=>'Data Inserted Successfully.']);
// }

//     }


// public function create(Request $request)
// {
//     $validator = Validator::make(
//         $request->all(),
//         [
//             'select_city_id' => ['required'],
//             'select_company_id' => ['required'],
//             'select_stockist_id' => ['required'],
//             'select_medical_id' => ['required'],
//         ],
//         [
//             'select_city_id.required' => 'Please Select City.',
//             'select_company_id.required' => 'Please Select Company.',
//             'select_stockist_id.required' => 'Please Select Stockist.',
//             'select_medical_id.required' => 'Please Select Medical.',
//         ]
//     );

//     if ($validator->fails()) {
//         $errors = '';
//         $messages = $validator->messages();
//         foreach ($messages->all() as $message) {
//             $errors .= $message . "<br>";
//         }
//         return back()->with(['error' => $errors]);
//     }

//     // Get the select_stockist_id, select_medical_ids, and select_company_id from the request
//     $select_stockist_id = $request->get('select_stockist_id');
//     $select_medical_ids = $request->get('select_medical_id');
//     $select_company_ids = $request->get('select_company_id');

//     // Check if the combination of select_company_id, select_stockist_id, and select_medical_id already exists
//     $existingRecord = Link_Stockist_Medical::where('select_stockist_id', $select_stockist_id)
//         ->whereJsonContains('select_company_id', $select_company_ids)
//         ->whereJsonContains('select_medical_id', $select_medical_ids)
//         ->first();

//     if (!$existingRecord) {
//         // Create a new record for the unique combination
//         $mark = new Link_Stockist_Medical;
//         $mark->select_city_id = $request->get('select_city_id');
//         $mark->select_company_id = $select_company_ids;
//         $mark->select_stockist_id = $select_stockist_id;
//         $mark->select_medical_id = $select_medical_ids;
//         $mark->save();

//         return redirect(route('linkstockist'))->with(['success' => 'Data Inserted Successfully.']);
//     } else {
//         // Combination already exists, return an error message
//         return redirect(route('linkstockist'))->with(['error' => 'Combination already exists.']);
//     }
// }


public function create(Request $request)
{
    $validator = Validator::make(
        $request->all(),
        [
            'select_city_id' => ['required'],
            'select_company_id' => ['required'],
            'select_stockist_id' => ['required'],
            'select_medical_id' => ['required'],
        ],
        [
            'select_city_id.required' => 'Please Select City.',
            'select_company_id.required' => 'Please Select Company.',
            'select_stockist_id.required' => 'Please Select Stockist.',
            'select_medical_id.required' => 'Please Select Medical.',
        ]
    );

    if ($validator->fails()) {
        $errors = '';
        $messages = $validator->messages();
        foreach ($messages->all() as $message) {
            $errors .= $message . "<br>";
        }
        return back()->with(['error' => $errors]);
    }

    // Get the select_stockist_id and select_medical_ids from the request
    $select_stockist_id = $request->get('select_stockist_id');
    $select_medical_ids = $request->get('select_medical_id');

    // Check if each select_medical_id already exists for the select_stockist_id
    foreach ($select_medical_ids as $medical_id) {
        $existingRecord = Link_Stockist_Medical::where('select_stockist_id', $select_stockist_id)
            ->whereJsonContains('select_medical_id', $medical_id)
            ->first();

        if (!$existingRecord) {
            // Create a new record for each unique select_medical_id
            $mark = new Link_Stockist_Medical;
            $mark->select_city_id = $request->get('select_city_id');
            $mark->select_company_id = $request->get('select_company_id');
            $mark->select_stockist_id = $select_stockist_id;
            $mark->select_medical_id = [$medical_id];
            //$mark->save();
        }
    }
    
if ($existingRecord) {
    // Record already exists, you can return a message or take appropriate action.
    return redirect(route('linkstockist'))->with(['error'=>'Medical Already Exists.']);
} else {
    // Record does not exist, save it.
    $mark->save();
    return redirect(route('linkstockist'))->with(['success'=>'Data Inserted Successfully.']);
}

    }



//     return redirect(route('linkstockist'))->with(['success' => 'Data Inserted Successfully.']);
// }

        public function edit($id)
          {
       $mededit = Link_Stockist_Medical::find($id); 
      
       $mark=Link_Stockist_Medical::
       join ('cities','cities.id','=','link__stockist__medicals.select_city_id')
   
       ->join ('stockists','stockists.id','=','link__stockist__medicals.select_stockist_id')
       
       ->orderby('link__stockist__medicals.id','desc')
       ->select('link__stockist__medicals.*','cities.city','stockists.stockist')
       ->get();
       $city=City::all();
       $addcompanies=Addcompany::all();
       $stock=Stockist::all();
       $medica=Medical::all();
         return view('editlinkstockistmedical',['mededit'=>$mededit,'mark'=>$mark,'city'=>$city,'mark'=>$mark,'addcompanies'=>$addcompanies,'stock'=>$stock,'medica'=>$medica]);
             
              
          }
         
          public function update(Request $request)
          {


            $validator = Validator::make(
              $request->all(),
              [
                  
                  'select_city_id' => ['required'],
                  'select_company_id' => ['required'],
                  'select_stockist_id' => ['required'],
                  'select_medical_id' => ['required'],
                   
          ],
           [
                 
                  
                  'select_city_id.required' => 'Please Select City.',
                  
                  'select_company_id.required' => 'Please Select Company.',
                  'select_stockist_id.required' => 'Please Select Stockist.',
                  'select_medical_id.required' => 'Please Select Medical.',
                 
              ]);
              if ($validator->fails()) {
                  $errors = '';
                  $messages = $validator->messages();
                  foreach ($messages->all() as $message) {
                      $errors .= $message . "<br>";
                  }
                  return back()->with(['error'=>$errors]);
              }
            

            $mark=Link_Stockist_Medical::find($request->id);
            $mark->select_city_id=$request->get('select_city_id');
        $mark->select_company_id=$request->get('select_company_id');

            $mark->select_stockist_id=$request->get('select_stockist_id');
            $mark->select_medical_id=$request->get('select_medical_id');
                $mark->save(); 
               
           
       
            return redirect()->route('linkstockist')->with(['success'=>true,'message'=>'Successfully Updated !']);
          }
       
       
          public function destroy($id)
          {
              $med=Link_Stockist_Medical::where('id',$id)->delete();
              return redirect(route('linkstockist'));
          }
       
       
       
}



