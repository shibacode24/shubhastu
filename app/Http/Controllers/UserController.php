<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {       
        return view('login');
    }

   //  public function check_login(Request $request){
   //  //  dd($request->all()); //yaha hamne dd ka use kiya hi kyki hame request se data print karna tha and code end karna tha
   //   // if (auth()->attempt(array('email' => $request['email'], 'password' => $request['password']))) 
    
   //   if (($request['email']=='admin@gmail.com' && $request['password']=='123456'))
   //      {  
   //         return redirect()->route('dashboard');
   //     }
   //     else{
   //      // echo "error','Invalid Login Credentials.";
   //      // dd($request->password);
   //       return redirect()->back()->with('error','Invalid Login Credentials.');  
   //         }     
   //  }

     
// public function gallery_panel()
// {
  
//    if(Auth::User())
//    {
//  $check=Index::all();

//  return view('dashboard',compact('check'));
//    }
//    else{
//       return redirect()->route('login');

//    }
// }

// public function log_out()
// {
//    Auth::logout();
  
//   return redirect()->route('login');
// }



public function check_login(Request $request)
{
   // dd($request->all());
   if (auth()->attempt(array('email' => $request['email'], 'password' => $request['password'])))
   {
      
      // echo json_encode (Auth::user());
      // dd(1);
      return redirect()->route('dashboard');
  }
  else{
   // dd(2);
   // echo "error','Invalid Login Credentials.";
    return redirect()->back()->with('error','Invalid Login Credentials.');
      }
}
public function log_out()
{
   Auth::logout();
  return redirect()->route('login');
}

public function marketing_login_page()
{
 return view('marketing_login');
}

public function marketing_login_submit(Request $request)
{

  
if (Auth::guard('marketings')->attempt(['username' => $request['username'], 'password' => $request['password']]))
{
// echo json_encode(Auth::guard('marketings')->user());
// exit();
return redirect()->route('promotor');
}
else{

return redirect()->back()->with('error','Invalid Login Credentials.');  
}

}
public function marketing_log_out()
{
   Auth::guard('marketings')->logout();
  
  return redirect()->route('marketing_login_page');
}


}
