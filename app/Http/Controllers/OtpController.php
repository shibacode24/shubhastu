<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Otp;
class OtpController extends Controller
{
    public function index(){
                $data=Otp::find(3);
               
                return view('default_otp',compact('data'));
            }
        
            
        public function update(Request $request)  {
            
        //    dd($request->all());
        $fedr=Otp::find(3);
        $fedr->otp=$request->get('otp');
        $fedr->save();
        // Otp::where([
        //     'otp'=>$request->otp,
           
        // ])->first();
        return redirect(route('otp'));
}}
