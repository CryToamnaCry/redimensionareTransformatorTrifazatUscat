<?php

namespace App\Http\Controllers\Auth;

use App\Models\DateNominale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class   LoginController extends Controller
{

    public function __construct(){
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {

            //validate user
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            ]);

        //sign user in
        if( !auth()->attempt($request->only('email','password'),$request->remember)){
            return back()->with('status','Invalid login details');
        }

        if (DateNominale::where('user_id', $request->user()->id)->exists()) {
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('redimensionare');
        }
         
    }
}
