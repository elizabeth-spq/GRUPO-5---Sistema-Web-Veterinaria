<?php

namespace App\Http\Controllers;

use App\Models\RolePermissions;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index()
    {
        $rolepermission = RolePermissions::all();
        return response()->json($rolepermission);
    }
}
