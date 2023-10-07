<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolController extends Controller
{
    public function getRoles()
    {
        $roles = Role::all();
        return response()->json(['roles' => $roles]);
    }
}
