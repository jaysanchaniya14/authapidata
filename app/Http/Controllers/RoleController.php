<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getallrole(Request $request){
        $alluser = Role::get();
        return  response()->json($alluser);
    }
}
