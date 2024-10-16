<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Image;
use Illuminate\Http\Request;

class AdverbsController extends Controller
{

    public function adverbs(){

        $get_img = Image :: orderBy('id','desc')->get();

        $msg = Message :: first();

        return view('adverbs',compact('get_img','msg'));
    }

    public function msg(Request $request)
    {
        $validatedData = $request->validate([
            'textarea' => 'required',
        ]);

        $message = new Message();
        $message->message= $validatedData['textarea'];
        $message->save();

        return redirect()->back()->with('success', 'Form submitted successfully');
    }

//update  text
public function update_msg(Request $request)
{
    $validatedData = $request->validate([
        'textarea' => 'required',
    ]);

    $message = Message::find($request->id);

    if (!$message) {
        return redirect()->back()->with('error', 'Message not found');
    }

    $message->message = $validatedData['textarea'];
    // echo json_encode($message);
    // exit();
    $message->save();

    return redirect()->back()->with('success', 'Message updated successfully');
}

    
    public function create_image(Request $request) 
    {
        $validatedData = $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
    

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/slider_img'), $filename);
   
        }   
    
            $image = new Image();
            $image->image = $filename;
            $image->save();
    
        return redirect()->back()->with('success', 'Form submitted successfully');
    }

    public function delete_img($id)
    {
        Image::find($id)->delete();
        return redirect()->back()->with('success', 'data successfully deleted');
    }
    
}