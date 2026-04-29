<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Session;
use App\Models\Category;
use App\Utility\SendSMSUtility;

class RegisteredUserController extends Controller{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(){
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){

        //dd($request);
        if ($request->has('create_account') && $request->create_account === "on") {
            $userPass = rand(100000,999999);
            $user = User::create([
                'name' => $request->name,
                // 'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($userPass),
                // 'referrer_code' => $request->referrer_code,
                'address' => $request->address ?? null,
                // 'comment' => $request->comment
            ]);

            $message = "You have created an account on Vynzin. Use your phone no as username,
            and your password is: {$userPass}.";

            SendSMSUtility::sendSMS($user->phone, $message);
            return redirect()->route('checkout.payment');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:4'],
            'referrer_code' => 'nullable|string|max:255',
        ]);

        $userEmail = User::where('email', $request->email)->first();
        // $userUser = User::where('username', $request->username)->first();
        $userPhone = User::where('phone', $request->phone)->first();
        if ($userEmail) {
            $notification = array(
                'message' => 'User email already Created',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }elseif($userPhone){
            $notification = array(
                'message' => 'User phone already Created',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        
        $verificationCode = rand(1000, 9999);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'password' => Hash::make($request->password),
        //     'address' => $request->address ?? null,

        // ]);

        session(['name'     => $request->name]);
        session(['email'    => $request->email]);
        session(['phone'    => $request->phone]);
        session(['password' => Hash::make($request->password)]);
        session(['referrer_code' => $request->referrer_code ?? null]);
        session(['address'  => $request->address ?? null]);

        //dd(session('referrer_code'));
        // event(new Registered($user));
        // Auth::login($user);

        // session(['phone' => $user->phone]);
        session(['otp' => $verificationCode]);

        $message = "Your verification code is: {$verificationCode}";
        SendSMSUtility::sendSMS(session('phone'), $message);

        return redirect()->route('verify.code');



    }
}
