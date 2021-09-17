<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        $user = User::Join('files', 'files.user_id', '=', 'users.id')
            ->select('users.id','users.name','users.username','users.email',
                    'files.created_at')
            ->where('users.is_admin', '=', 0)
            ->orderBy('users.id','ASC')
            ->get()
            ->groupBy('users.username')
            ->toArray();
        $title = 'Proiecte incarcate:';


        return view('admin.admin',[
            'detalii' => $user,
            'title' =>$title
        ]);
    }
}
