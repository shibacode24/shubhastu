<?php

namespace App\Http\Controllers;
use App\Models\City;
use App\Models\Year;
use App\Models\Addcompany;
use App\Models\Doctor;
use App\Models\Marketing;
use App\Models\Medical;
use App\Models\Promotor_Sale;
use App\Models\Promotormedicine;
use App\Models\Stockist;
use App\Models\Link_Stockist_Medical;
use App\Models\Medicine;
use App\Models\Add_medicine;
use App\Models\Primary_Sale;
use App\Models\Medicine_List;
use App\Models\Tds;
use App\Models\Newmedicinemaster;

use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;
use Illuminate\Http\Request;

class NewPromotorSaleController extends Controller
{

 public function index()
    {
        $promotor=Promotor_Sale::
        join('years','years.id','=','promotor__sales.year_id')
        ->join('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
        ->join('marketings','marketings.id','=','promotor__sales.select_marketing_id')
        ->join('doctors','doctors.id','=','promotor__sales.select_doctor_id')
        // ->orderby('promotor__sales.id','desc')
        ->select('promotor__sales.*','years.year','addcompanies.Name','marketings.name','doctors.allotted_dr_name')
        // ->where('promotor__sales.select_company_id','promotor__sales.')       
        ->get();

        $stocmed=Promotormedicine::
        join('stockists','stockists.id','=','promotorsalemedicine.select_stokist_id')
        ->join('medicals','medicals.id','=','promotorsalemedicine.select_medical_id')
        ->join ('cities','cities.id','=','promotorsalemedicine.city_id')
        ->join ('newmedicinemaster','newmedicinemaster.id','=','promotorsalemedicine.medicine_id')
        ->join('primary__sales','primary__sales.id','=','promotorsalemedicine.batch_no_id')
        ->select('stockists.stockist','medicals.medical','cities.city')
       
        ->get();
        
        $year = Year::orderBy('id', 'desc')->get();

        if (auth()->guard('marketings')->check()) {
            $company = Addcompany::whereIn('id', explode(',', auth()->guard('marketings')->user()->select_company_id))->get();
        } else {
            $company = Addcompany::all();
        }

        // echo json_encode($company);
        // exit();
        if (auth()->guard('marketings')->check()) {
            $market = Marketing::whereIn('id', explode(',', auth()->guard('marketings')->user()->id))->get();
        } 
        else {
            $market = [];
        }
       
        if (auth()->guard('marketings')->check()) {
            $stockist = Stockist::whereIn('city_id', explode(',', auth()->guard('marketings')->user()->city_id))->get();
        } 
        else {
            $stockist=Stockist::all();

        }
        if (auth()->guard('marketings')->check()) {
            $doctor = Doctor::whereIn('city_id', explode(',', auth()->guard('marketings')->user()->city_id))->get();
        } 
        else {
        $doctor=Doctor::all();
        }

        $medical=Medical::all();
        $city=City::all();
        $medi=Newmedicinemaster::all();
        $batchno=Primary_Sale::all();
        return view('promotor_sale_new',['promotor'=>$promotor,'stocmed'=>$stocmed,'year'=>$year,'company'=>$company,'market'=>$market,'doctor'=>$doctor,'stockist'=>$stockist,'medical'=>$medical,'city'=>$city,'medi'=>$medi,'batchno'=>$batchno]);
    }



    public function get_previous_added_data(Request $request)
    {
       // dd($request->all());
        // Assuming your database tables are named appropriately
        
        if(auth()->guard('marketings')->check())
        {
            $dd = auth()->guard('marketings')->user()->id;
            $get_previous_added_data = Promotor_Sale::where('promotor__sales.select_marketing_id',  auth()->guard('marketings')->user()->id)
            ->leftJoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
            ->leftJoin('stockists', 'stockists.id', '=', 'promotorsalemedicine.select_stokist_id')
            ->leftJoin('medicals', 'medicals.id', '=', 'promotorsalemedicine.select_medical_id')
            ->leftJoin('years', 'years.id', '=', 'promotor__sales.year_id')
            ->leftJoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
            ->leftJoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
            ->leftJoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
            ->where('promotor__sales.select_doctor_id', $request->doctor_id)
            ->where('promotorsalemedicine.select_stokist_id', $request->stockist_id)
            ->where('promotorsalemedicine.select_medical_id', $request->medical_id)
            ->where('promotor__sales.select_company_id', $request->company_id)
            ->where('promotor__sales.sale_of_month', $request->sale_of_month)
            ->where('promotor__sales.year_id', $request->year_id)
            ->select(
                'stockists.stockist',
                'medicals.medical',
                'promotor__sales.id as ps_id',
                'promotor__sales.year_id',
                'promotor__sales.sale_of_month',
                'promotor__sales.select_company_id',
                'promotor__sales.select_marketing_id',
                'promotor__sales.select_doctor_id',
                'promotor__sales.select_scheme',
                'promotor__sales.grand_total1',
                'promotor__sales.grand_total2',
                'promotor__sales.tds',
                'years.year',
                'addcompanies.Name',
                'marketings.name',
                'doctors.allotted_dr_name',
                'doctors.mobile',
                'doctors.promoter_name',
                'promotorsalemedicine.*',
                // 'promotor__sales.id',
                DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$request->sale_of_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.select_marketing_id = $dd) as total_grand_total1"),
                DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$request->sale_of_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id AND ps.select_marketing_id = $dd) as total_grand_total2"),
                
           )
           ->get();
        }
        else{
        $get_previous_added_data = Promotor_Sale::
        leftJoin('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
        ->leftJoin('stockists', 'stockists.id', '=', 'promotorsalemedicine.select_stokist_id')
        ->leftJoin('medicals', 'medicals.id', '=', 'promotorsalemedicine.select_medical_id')
        ->leftJoin('years', 'years.id', '=', 'promotor__sales.year_id')
        ->leftJoin('addcompanies', 'addcompanies.id', '=', 'promotor__sales.select_company_id')
        ->join('newmedicinemaster', 'newmedicinemaster.select_company_id', '=', 'promotor__sales.select_company_id')
        ->leftJoin('marketings', 'marketings.id', '=', 'promotor__sales.select_marketing_id')
        ->leftJoin('doctors', 'doctors.id', '=', 'promotor__sales.select_doctor_id')
        ->where('promotor__sales.select_doctor_id', $request->doctor_id)
            ->where('promotorsalemedicine.select_stokist_id', $request->stockist_id)
            ->where('promotorsalemedicine.select_medical_id', $request->medical_id)
            ->where('promotor__sales.select_company_id', $request->company_id)
            ->where('promotor__sales.sale_of_month', $request->sale_of_month)
            ->where('promotor__sales.year_id', $request->year_id)
        ->select(
            'stockists.stockist',
            'newmedicinemaster.batch_no',
            'medicals.medical',
            'promotor__sales.id as ps_id',
            'promotor__sales.year_id',
            'promotor__sales.sale_of_month',
            'promotor__sales.select_company_id',
            'promotor__sales.select_marketing_id',
            'promotor__sales.select_doctor_id',
            'promotor__sales.select_scheme',
            'promotor__sales.grand_total1',
            'promotor__sales.grand_total2',
            'promotor__sales.tds',
            'years.year',
            'addcompanies.Name',
            'marketings.name',
            'doctors.allotted_dr_name',
            'doctors.mobile',
            'doctors.promoter_name',
            'promotorsalemedicine.*',
            // 'promotor__sales.id',
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$request->sale_of_month' THEN ps.grand_total1 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total1"),
            DB::raw("(SELECT SUM(CASE WHEN ps.sale_of_month = '$request->sale_of_month' THEN ps.grand_total2 ELSE 0 END) FROM promotor__sales ps WHERE ps.select_doctor_id = doctors.id AND ps.select_company_id = addcompanies.id AND ps.year_id = years.id) as total_grand_total2"),
            
        )
        ->get();
        }


    // if(auth()->guard('marketings')->check())
    // {
    //     $get_previous_added_data = Promotor_Sale::where('select_marketing_id',auth()->guard('marketings')->user()->id)
    //         ->join('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
    //         ->join('newmedicinemaster', 'newmedicinemaster.select_company_id', '=', 'promotor__sales.select_company_id')
    //         ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
    //         ->where('promotor__sales.select_doctor_id', $request->doctor_id)
    //         ->where('promotorsalemedicine.select_stokist_id', $request->stockist_id)
    //         ->where('promotorsalemedicine.select_medical_id', $request->medical_id)
    //         ->where('promotor__sales.select_company_id', $request->company_id)
    //         ->where('promotor__sales.sale_of_month', $request->sale_of_month)
    //         ->where('promotor__sales.year_id', $request->year_id)
            
    //         ->select('promotor__sales.*', 'promotorsalemedicine.*','newmedicinemaster.batch_no','addcompanies.Name')
    //         ->get();
    // }
    // else
    // {

    //     $get_previous_added_data = Promotor_Sale::
    //     join('promotorsalemedicine', 'promotorsalemedicine.promotor__sales_id', '=', 'promotor__sales.id')
    //     ->join('newmedicinemaster', 'newmedicinemaster.select_company_id', '=', 'promotor__sales.select_company_id')
    //     ->leftjoin('addcompanies','addcompanies.id','=','promotor__sales.select_company_id')
    //     ->where('promotor__sales.select_doctor_id', $request->doctor_id)
    //     ->where('promotorsalemedicine.select_stokist_id', $request->stockist_id)
    //     ->where('promotorsalemedicine.select_medical_id', $request->medical_id)
    //     ->where('promotor__sales.select_company_id', $request->company_id)
    //     ->where('promotor__sales.sale_of_month', $request->sale_of_month)
    //     ->where('promotor__sales.year_id', $request->year_id)
        
    //     ->select('promotor__sales.*', 'promotorsalemedicine.*','newmedicinemaster.batch_no','addcompanies.Name')
    //     ->get();
    // }
            //  echo json_encode($get_previous_added_data);
            // exit();
              $render_view= view('promotor_sale_previous_added_medicine',['proreport'=>$get_previous_added_data])->render();
              return response()->json($render_view);
        // return response()->json($get_previous_added_data);
    }

   public function market(Request $request)
  
    {
        $data = Marketing::
        Where('select_company_id', 'like', '%' .  $request->id . '%')
        ->orderby('name', 'asc')->get();
        return response()->json($data);
    }

    public function medical(Request $request)
  
    {   //do column pe on change krrne ke liye
        
        $doctor = Doctor::where('id', $request->doctor_id)
        ->value('medical_id');
      
        $stockist=Link_Stockist_Medical::select('select_medical_id')->where('select_stockist_id',$request->stockist_id)
        ->select('select_medical_id')->get();
       
        $stockist=Arr::pluck($stockist, 'select_medical_id');//here we pluck the value without column name

        $stockist=Arr::flatten($stockist); //here we merge the value in single array
       
        if(count($doctor)>0 && count($stockist)>0) { //here we check both the varaible not empty
            $common_id=array_intersect($doctor,$stockist); //here we find common value from both array
            //common value find karne ke liye intersect 
         
            $medical=Medical::whereIn('id',$common_id)
            ->get(); //we have array of id. using id's we are fetching the multiple medicals
           
            return response()->json($medical);
        }else{
            return response()->json(null);

        }
        
       
    }


    public function medicine2(Request $request)
  
        {
            $data = DB::table('newmedicinemaster')
        
            ->join('newmedicinemaster2','newmedicinemaster2.newmedicinemaster_id','=','newmedicinemaster.id')
            //  ->join('newmedicinemaster','newmedicinemaster.id','=','newmedicinemaster.medicine_id')
            // ->leftjoin('primary__sales','primary__sales.id','=','newmedicinemaster.batch_no_id')
            ->where('newmedicinemaster2.default_scheme',$request->scheme)
            ->where('newmedicinemaster.select_company_id', $request->company_id)
            //  ->where('newmedicinemaster.select_medical_id',  $request->medical)
            // ->where('newmedicinemaster.quantity','!=',0)
             ->where('newmedicinemaster.status','1')
            ->select('newmedicinemaster.medicine_id','newmedicinemaster.id','newmedicinemaster2.ptr',
            'newmedicinemaster2.marketing_promotion_scheme','newmedicinemaster.batch_no') 
            ->orderBy('newmedicinemaster.medicine_id','asc')
           ->get();

           $exist_data=DB::table('promotor__sales')
           ->join('promotorsalemedicine','promotorsalemedicine.promotor__sales_id','=','promotor__sales.id')
           ->where([
                'promotor__sales.year_id'=>$request->year_id,
                'promotor__sales.select_doctor_id'=>$request->select_doctor_id,
                'promotor__sales.sale_of_month'=>$request->sale_of_month,
            ])
            ->select('promotorsalemedicine.*')
           ->get()->groupBy('append_no');
            return response()->json(['medicine'=>$data,'exist_data'=>$exist_data]);
        }
        
       

        public function get_scheme(Request $request)
        {
            $drschem=DB::table('doctors')
            ->where([

                'doctors.id'=>$request->doctor_id //doctor_id=script me jo data me hai wo id
            ])
            ->select('doctors.Scheme')
            ->first();//agar hume sirf ek hi value dikhani hai to first

            return response()->json($drschem);
        }



        public function scheme_medicine(Request $request){
            $show = Add_medicine::where('default_scheme',$request['scheme_select'])
            ->where('company',$request['company'])->get();
            echo json_encode($show);
        }



public function create(Request $request){
   


// $request->validate([
            
                
//     // 'year_id' => 'required',
//     // 'sale_of_month' => 'required',
//     'company' => 'required',
//     'market' => 'required',
//     'doctor' => 'required',
//     'stockist' => 'required',
//     'medical' => 'required',
//     // 'sheme' => 'required',

//     'medicine' => 'required',
//     'ptr1' => 'required',
//     'mps1' => 'required',
//     'qnty' => 'required',
//     'batch' => 'required',
//      'mpsqnty'=>'required',
//      'ptrqnty'=>'required',
   
    
// ]);
// $check_exist=Promotor_Sale::where([
//     'year_id'=>$request->year_id,
//     'sale_of_month'=>$request->sale_of_month,
//     'select_doctor_id'=>$request->doctor,
// ])->first();
// if(isset($check_exist)){
//     Promotormedicine::where('promotor__sales_id',$check_exist->id)->delete();
// }
$tds=Tds::select('tds')
->orderBy('id','desc')
->first();
    $promotor=new Promotor_Sale;
    $promotor->year_id=$request->get('year_id');
    $promotor->sale_of_month=$request->get('sale_of_month');
    $promotor->select_company_id=$request->get('company');
    $promotor->select_marketing_id=$request->get('market');
    $promotor->select_doctor_id=$request->get('doctor');
    // $promotor->select_stokist_id=$request->get('stockist');
    // $promotor->select_medical_id=$request->get('medical');
    $promotor->select_scheme=$request->get('sheme');
     
    $promotor->grand_total1=$request->get('grand_total1');
    $promotor->grand_total2=$request->get('grand_total2');
    $promotor->tds = $tds->tds;

    // echo json_encode($promotor);
    // exit();
   $promotor->save(); 

//     $tds=Tds::select('tds')->first();
//    $promotor = Promotor_Sale::updateOrCreate(
//     [
//         'year_id' => $request->get('year_id'),
//         'sale_of_month' => $request->get('sale_of_month'),
//         'select_doctor_id' => $request->get('doctor'),
//     ],
//     [
//         // 'year_id' => $request->get('year_id'),
//         // 'sale_of_month' => $request->get('sale_of_month'),
//         // 'select_doctor_id' => $request->get('doctor'),
//         'select_company_id' => $request->get('company'),
//         'select_marketing_id' => $request->get('market'),
//         'select_scheme' => $request->get('sheme'),
//         'grand_total1' => $request->get('grand_total1'),
//         'grand_total2' => $request->get('grand_total2'),
//         'tds'=>$tds->tds
//     ]
// );

   $insert_id=$promotor->id;

   for($i=0;$i<count($request->stockist); $i++){
    // dd($request->all());
    if(isset($request->stockist[$i]))
    {
    $promotormedicine=new Promotormedicine;
    $promotormedicine->promotor__sales_id=$insert_id;
  
    $promotormedicine->select_stokist_id=$request->stockist[$i];
    $promotormedicine->append_no=$request->append_no[$i];
    $promotormedicine->select_medical_id=$request->medical[$i];
    $promotormedicine->select_medicine1=$request->medicine[$i];
    $promotormedicine->select_batchs=$request->batch[$i];
    $promotormedicine->ptrs=$request->ptr1[$i];
    $promotormedicine->mpss=$request->mps1[$i];
    $promotormedicine->qntys=$request->qnty[$i];

    
    $promotormedicine->qnty_mps_total=$request->mpsqnty[$i];
    $promotormedicine->qnty_ptr_total=$request->ptrqnty[$i];

    $promotormedicine->grandtot1=$request->grandtot1[$i];
    $promotormedicine->grandtot2=$request->grandtot2[$i];
   
    $promotormedicine->save();
   }
}

return redirect(route('promotor'))->with(['success' => 'Data Successfully Submitted !', 'company'=>$request->company,
'market'=>$request->market,
'doctor'=>$request->doctor,
'sheme'=>$request->sheme,
'sale_of_month'=>$request->sale_of_month,
'year_id'=>$request->year_id,
'stockist'=>$request->stockist[0],
]);
   
   // return redirect(route('promotor'));
  
}


//modals

public function create_company_pro(Request $request){

    $company=new Addcompany;
    $company->Name=$request->get('name');
    $company->save(); 
    return redirect(route('promotor'));
    }

    public function create_marketing_pro(Request $request){

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

        $mark->city_id=$request->get('city_id');
        // $mark->city_id=implode(',',$request->get('city_id'));
        // $mark->select_company_id=implode(',',$request->get('select_company_id'));
        $mark->select_company_id=$request->get('select_company_id');
        $mark->name=$request->get('name');
        $mark->mobile=$request->get('mobile');
        $mark->email=$request->get('email');
        $mark->address=$request->get('address');
        $mark->username=$request->get('username');
        $mark->password=$request->get('password');
        $mark->save(); 
        return redirect(route('promotor'));
        }
        

        public function create_doctor_pro(Request $request){

            // dd($request->all());
          
         
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
              $doc->password=Hash::make($request->get('password'));
              $doc->city_id=$request->get('city_id');
              $doc->medical_id=$request->get('medical_id');
              $doc->Scheme=implode(',',$request->get('Scheme'));//for checkbox
              $doc->save(); 
            
              return redirect(route('promotor'));
              }
             

                  public function create_stockist_pro(Request $request){
                    // dd($request->all());
                  $mark=new Link_Stockist_Medical;
                  $mark->select_city_id=$request->get('select_city_id');
                //   $mark->select_company_id=implode(',',$request->get('select_company_id'));
                  $mark->select_company_id=$request->get('select_company_id');
                  $mark->select_stockist_id=$request->get('select_stockist_id');
                //  $mark->select_medical_id=implode(',',$request->get('select_medical_id'));
                  $mark->select_medical_id=$request->get('select_medical_id');
                 
                  $mark->save(); 
                  return redirect(route('promotor'));
                  }
                 

   public function create_medical_pro(Request $request){

          $medicines=new Medicine_List();
          $medicines->select_company_id=$request->get('company');
          $medicines->medicine_id=$request->get('medicine');
          $medicines->batch_no_id=$request->get('batch_no');
          $medicines->mrp=$request->get('mrp');
          $medicines->given_gst=$request->get('given_gst');
          $medicines->purchase=$request->get('purchase');
          $medicines->save(); 
          $insert_id=$medicines->id; //last record inserted id
  
          $medicines=Add_medicine::create([
         'gst'=>$request->get('gst'),
          'medicinesecond_id'=>$insert_id,
          'amount_after_gst'=>$request->get('amount_after_gst'),
          'retail_margin'=>$request->get('retail_margin'),
          'ptr'=>$request->get('ptr'),
          'stockist_margin'=>$request->get('stockist_margin'),
          'pts'=>$request->get('pts'),
          'management'=>$request->get('management'),
          'promotion_cost'=>$request->get('promotion_cost'),
          'scheme'=>$request->get('scheme'),
          'default_scheme'=>$request->get('default_scheme'),
          'scheme_amount_deduct'=>$request->get('scheme_amount_deduct'),
          'transport_expiry_breakage'=>$request->get('transport_expiry_breakage'),
          'tot'=>$request->get('tot'),
          'marketing_working_cost'=>$request->get('marketing_working_cost'),
          'company_profit'=>$request->get('company_profit'),
          'percent_profit_to_investment'=>$request->get('percent_profit_to_investment'),
          'marketing_promotion_scheme'=>$request->get('marketing_promotion_scheme'),
          'percent_profit_to_ptr'=>$request->get('percent_profit_to_ptr'),
          ]);
  
         
  
          $med=new Add_medicine();       
          $med->gst=$request->get('gst_ten');
          $med->medicinesecond_id=$insert_id;
          $med->amount_after_gst=$request->get('amount_after_gst_ten');
          $med->retail_margin=$request->get('retail_margin_ten');
          $med->ptr=$request->get('ptr_ten');
          $med->stockist_margin=$request->get('stockist_margin_ten');
          $med->pts=$request->get('pts_ten');
          $med->management=$request->get('management_ten');
          $med->promotion_cost=$request->get('promotion_cost_ten');
          $med->scheme=$request->get('scheme_ten');
          $med->default_scheme=$request->get('default_scheme_ten');
          $med->scheme_amount_deduct=$request->get('scheme_amount_deduct_ten');
          $med->transport_expiry_breakage=$request->get('transport_expiry_breakage_ten');
          $med->tot=$request->get('tot_ten');
          $med->marketing_working_cost=$request->get('marketing_working_cost_ten');
          $med->company_profit=$request->get('company_profit_ten');
          $med->percent_profit_to_investment=$request->get('percent_profit_to_investment_ten');
          $med->marketing_promotion_scheme=$request->get('marketing_promotion_scheme_ten');
          $med->percent_profit_to_ptr=$request->get('percent_profit_to_ptr_ten');
          $med->save();
  
         
          $medi=new Add_medicine();       
          $medi->gst=$request->get('gst_twenty');
          $medi->medicinesecond_id=$insert_id;
          $medi->amount_after_gst=$request->get('amount_after_gst_twenty');
          $medi->retail_margin=$request->get('retail_margin_twenty');
          $medi->ptr=$request->get('ptr_twenty');
          $medi->stockist_margin=$request->get('stockist_margin_twenty');
          $medi->pts=$request->get('pts_twenty');
          $medi->management=$request->get('management_twenty');
          $medi->promotion_cost=$request->get('promotion_cost_twenty');
          $medi->scheme=$request->get('scheme_twenty');
          $medi->default_scheme=$request->get('default_scheme_twenty');
          $medi->scheme_amount_deduct=$request->get('scheme_amount_deduct_twenty');
          $medi->transport_expiry_breakage=$request->get('transport_expiry_breakage_twenty');
          $medi->tot=$request->get('tot_twenty');
          $medi->marketing_working_cost=$request->get('marketing_working_cost_twenty');
          $medi->company_profit=$request->get('company_profit_twenty');
          $medi->percent_profit_to_investment=$request->get('percent_profit_to_investment_twenty');
          $medi->marketing_promotion_scheme=$request->get('marketing_promotion_scheme_twenty');
          $medi->percent_profit_to_ptr=$request->get('percent_profit_to_ptr_twenty');
          $medi->save(); 
  
         
  
          return redirect()->route('promotor');
    }

    public function create_medicine_pro(Request $request){

        $med=new Medicine;
        $med->select_company_id=$request->get('select_company_id');
        $med->medicine=$request->get('medicine');
        $med->save(); 
        return redirect(route('promotor'));
        }
    

        public function editpromotorsalereport($id)
        {
            $prosalereportedit = Promotor_Sale::find($id); 
            $stocmed=Promotormedicine::where('promotor__sales_id',$id)
            ->get();
            $year=Year::all();
            $company=Addcompany::all();
            $market=Marketing::all();
            $doctor=Doctor::all();
            $stockist=Stockist::all();
            $medical=Medical::all();
            $city=City::all();
            $medi=Newmedicinemaster::all();
            $batchno=Primary_Sale::all();
            return view('editpromotorsale_report',['prosalereportedit'=>$prosalereportedit,'stocmed'=>$stocmed,'year'=>$year,'company'=>$company,'market'=>$market,'doctor'=>$doctor,'stockist'=>$stockist,'medical'=>$medical,'city'=>$city,'medi'=>$medi,'batchno'=>$batchno]);
            // return view('editpromotorsale_report',['prosalereportedit'=>$prosalereportedit,'stocmed'=>$stocmed,'year'=>$year,'company'=>$company,'market'=>$market,'doctor'=>$doctor,'stockist'=>$stockist,'medical'=>$medical,'promotor'=>$promotor]);
        }

}

    








