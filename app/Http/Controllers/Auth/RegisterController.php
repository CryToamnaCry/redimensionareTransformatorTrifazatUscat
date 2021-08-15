<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware(['guest']);
    }

    public function index()
    {      
        $grupe = User::select('username')->where('is_admin', '=', 0)->distinct()->get();
        // Note: Using `::with()` prevents additional database calls when using `$message->fromContact` in a loop.


        $gr=[];
        foreach($grupe as $grupa){
            $gr[]=$grupa->username;
        }
        
        // $grupa = DB::table('users')->select('username')->where('is_admin', '=', 0)->distinct()->get();
            return view('auth.register',[
                'grupa' => $gr
            ]);
    }
    public function store(Request $request)
    {
        //validate user
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);
        //store user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username'=>$request->username,
            'password'=>Hash::make($request->password)
        ]);
         //sign user in
         auth()->attempt($request->only('email','password'));
         //redirect
        return redirect()->route('redimensionare');
    }
}
