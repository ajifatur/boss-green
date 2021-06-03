<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  string  $role
     * @return \Illuminate\Http\Response
     */
    public function index($role)
    {
        $users = User::where('role',$role)->get();

        if(!$users){
        	abort(404);
        }

        return view('admin/user.index', [
            'role' => $role,
            'users' => $users
        ]);
    }
}
