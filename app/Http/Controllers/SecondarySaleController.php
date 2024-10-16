<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Year;
use App\Models\Addcompany;
use App\Models\Secondary_Sale;
use App\Models\Stockist;
use App\Models\SecondaryMedicine;
use Illuminate\Support\Facades\DB;

class SecondarySaleController extends Controller
{
    public function index(){
        $secondary=Secondary_Sale::
        join('years','years.id','=','secondary__sales.year_id')
        ->join('addcompanies','addcompanies.id','=','secondary__sales.select_company_id')
        ->join('stockists','stockists.id','=','secondary__sales.select_stokist_id')
        ->select('secondary__sales.*','years.year','addcompanies.Name','stockists.stockist')
        ->get();
        
        $year = Year::orderBy('id', 'desc')->get();

        if (auth()->guard('marketings')->check()) {
            $company = Addcompany::whereIn('id', explode(',', auth()->guard('marketings')->user()->select_company_id))->get();
        } else {
            $company = Addcompany::all();
        }


         if (auth()->guard('marketings')->check()) {
            $stockist = Stockist::whereIn('city_id', explode(',', auth()->guard('marketings')->user()->city_id))->get();
        } 
        else {
            $stockist=Stockist::all();

        }
        
        return view('secondary_sale',['secondary'=>$secondary,'year'=>$year,'company'=>$company,'stockist'=>$stockist]);
    }

    // public function medicine(Request $request)
  
    //     {
    //         $data = DB::table('medicinesecond')
    //         ->select('medicines.medicine','medicines.id')
    //         ->where('medicinesecond.select_company_id', $request->company_id)
    //         ->join('add_medicines','add_medicines.medicinesecond_id','=','medicinesecond.id')
            
    //         ->join('medicines','medicines.id','=','medicinesecond.medicine_id')
    //      ->get();
    //         return response()->json($data);
    //     }


        public function medicine(Request $request)
  
        {
            $data = DB::table('newmedicinemaster')
        
            // ->join('newmedicinemaster2','newmedicinemaster2.newmedicinemaster_id','=','newmedicinemaster.id')
            //  ->join('newmedicinemaster','newmedicinemaster.id','=','newmedicinemaster.medicine_id')
            // ->leftjoin('primary__sales','primary__sales.id','=','newmedicinemaster.batch_no_id')
            // ->where('newmedicinemaster2.select_stokist_id',$request->stockist)
            ->where('newmedicinemaster.select_company_id', $request->company_id)
            ->where('newmedicinemaster.status','1')
            //  ->where('newmedicinemaster.select_medical_id',  $request->medical)
            ->select('newmedicinemaster.medicine_id','newmedicinemaster.purchase','newmedicinemaster.batch_no')
            ->orderBy('newmedicinemaster.medicine_id','asc')
           ->get();
            return response()->json($data);
        }
        
       



        // public function batchnocompany(Request $request)
  
        // {
        //   //dd($request->all());
        //   $medicinesecond=DB::table('medicinesecond')
        //   ->join('add_medicines','add_medicines.medicinesecond_id','=','medicinesecond.id')
        //   ->join('primary__sales','primary__sales.id','=','medicinesecond.batch_no_id')
        //   ->where([
        //       'medicinesecond.select_company_id'=>$request->company_id,
        //       'medicinesecond.medicine_id'=>$request->medicine,  
        //   ])
        //   ->select('primary__sales.batch_no')->first();
        //       return response()->json($medicinesecond);
            
        //   }
          // public function batchnocompany(Request $request)
  
          // {
          //   //dd($request->all());
          //   $medicinesecond=DB::table('medicinesecond')
          //   ->join('add_medicines','add_medicines.medicinesecond_id','=','medicinesecond.id')
          //   ->join('primary__sales','primary__sales.id','=','medicinesecond.batch_no_id')
          //   ->where([
          //       'medicinesecond.select_company_id'=>$request->company_id,
          //       'medicinesecond.medicine_id'=>$request->medicine,
           
    
    
          //   ])
          //   ->select('primary__sales.batch_no','primary__sales.id')->get();
            
          //   return response()->json($medicinesecond);
            
          // }
  
          public function create(Request $request){
            //    echo json_encode($request->all());
            //    exit();

      

            $request->validate([  
                'year_id' => 'required',
                'sale_of_month' => 'required',
                'company' => 'required',
                'stockist' => 'required',
              
            ]);

            // $image_name_array=[];
            // if (isset($request->image) && !empty($request->image)) 
            // {
            //     foreach ($request->image as $key => $image) {
            //     $extension= explode('/', mime_content_type($image))[1];
            //     $data = base64_decode(substr($image, strpos($image, ',') + 1));
            //     $imgname='pdf'.rand(000,999).$key . time() . '.' .$extension;
            //     file_put_contents(public_path('images/uploaded_pdf') . '/' . $imgname, $data);
            //     $image_name_array[]=$imgname;
            // }
            // }
           
            
                $promotor=new Secondary_Sale;
                $promotor->year_id=$request->get('year_id');
                $promotor->sale_of_month=$request->get('sale_of_month');
                $promotor->select_company_id=$request->get('company');
                $promotor->sale_value_total1=$request->get('grand_total2');
                $promotor->grand_total1=$request->get('grand_total11');
                if(auth()->guard('marketings')->check())
                {
                $promotor->master_id=auth()->guard('marketings')->user()->id;
                }
                else{
                $promotor->master_id= auth()->user()->id;

                }

                if ($request->hasFile('pdf')) {
                    $file = $request->file('pdf');
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/pdf'), $filename);
                    $promotor->pdf = $filename;
           
                }   
            //  echo json_encode($promotor);
            //  exit();

               $promotor->save(); 
            
                $insert_id=$promotor->id;
                for($i=0;$i<count($request->stockist); $i++){
                    // dd($request->all());
                    if(isset($request->stockist[$i]))
                    {
                $promotormedicine=new SecondaryMedicine;
                $promotormedicine->secondary__sales_id=$insert_id;
              
                $promotormedicine->select_stokist_id=$request->stockist[$i];
                $promotormedicine->sale_value=$request->medical[$i];
                $promotormedicine->grand_total2=$request->grand_total1[$i];
                $promotormedicine->append_no=$request->append_no[$i];
                $promotormedicine->select_medicine=$request->medicine[$i];
                // $promotormedicine->select_batch=$request->batch[$i];
                $promotormedicine->qnty=$request->qnty[$i];
            
         
                $promotormedicine->purchase_rate=$request->purchase[$i];
                $promotormedicine->qntypurchase=$request->qntypurchase[$i];
                $promotormedicine->save();

             
                }


            }
            
            
               
               // return redirect(route('promotor'));
               return redirect()->back();
            }


            // public function purchase(Request $request)
  
            // {
            //   // dd($request->all());
            //   $medicinesecond=DB::table('medicinesecond')
            //   ->join('add_medicines','add_medicines.medicinesecond_id','=','medicinesecond.id')
            //   ->join('primary__sales','primary__sales.id','=','medicinesecond.batch_no_id')
            //   ->where([
            //       'medicinesecond.batch_no_id'=>$request->batch,
            //       'medicinesecond.medicine_id'=>$request->medicine,
            
      
      
            //   ])
            //   ->select('medicinesecond.purchase')->first();
            
            //   return response()->json($medicinesecond);
            
            // }
    }
