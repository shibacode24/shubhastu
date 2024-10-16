<?php

namespace App\Http\Controllers;

use App\Models\Addedmedicine;
use App\Models\Addcompany;
use Illuminate\Http\Request;

class AddedmedicineController extends Controller
{
    public function index(){
        $medicine_added=Addedmedicine::where('Name', 'like', '%' .$request->serach_keyword. '%')
        
        ->leftjoin('addcompanies','addcompanies.id','=','addedmedicines.select_company_id')
        ->orderby('addedmedicines.id','desc')
        ->select('addedmedicines.*','addcompanies.Name')
        ->get();
   
        $addcompanies=Addcompany::all();
        
     
         return view('addedmedicine',['medicine_added'=>$medicine_added,'addcompanies'=>$addcompanies]);
      
    }

   
  
}