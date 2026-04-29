<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Toastr;

class UserMessageController extends Controller
{
    public function submit(Request $request)
    {
    //    dd($request->all());
        $request->validate([
            'email'     => ['required', 'email'],
            'subject'   => ['required'],
            'purpose'   => ['required'],
            'message'   => ['required'],
        ]);
        // dd($request->all());
        UserMessage::add($request);
        Toastr()->success('Submitted successfully!');
        return back();
    }

    public function list()
    {
        $data['items'] = UserMessage::latest()->get();
        return view('backend.message.list', $data);
    }

    public function destroy($id)
    {
        $message = UserMessage::find($id);
        if($message){
            $message->delete();
            Session::flash('success','Message Deleted Successfully');
            return back();
        }
        Session::flash('error','Failed to delete message');
        return back();
    }
}
