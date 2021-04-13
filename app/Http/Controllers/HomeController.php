<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function index()
    {
        // Role::create(['name' => 'writer']);
        // Permission::create(['name' => 'publish post']);

        // $role = Role::findById(1);
        // $permission = Permission::findById(1);
        // $role->givePermissionTo($permission);

        // $permission = Permission::create(['name' => 'edit post']);
        // $role = Role::findById(1);
        // $permission->assignRole($role);

        // auth()->user()->givePermissionTo('edit post');
        // auth()->user()->assignRole('writer');

        // return auth()->user()->permissions;

        // return auth()->user()->getRoleNames();

        // return User::role('writer')->get();

        return view('welcome');
    }
}
