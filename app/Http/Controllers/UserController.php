<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Users'
        ];
      
        // ดึงข้อมูลการขายสินค้าภายใน 3 เดือนย้อนหลัง
        $users = User::get();

        return view('users.index', array_merge($data, compact('users')));
    }

    public function adduser()
    {
        $data = [
            'title' => 'Add User'
        ];
      
        // ดึงข้อมูลการขายสินค้าภายใน 3 เดือนย้อนหลัง
        $users = User::get();

        return view('users.adduser', array_merge($data, compact('users')));
    }

    public function createuser(Request $request)
    {
        // Validate
        $request->validate([
            'fullname' => ['required', 'max:100'],
            'username' => ['required', 'max:50'],
            'password' => ['required', 'min:6']
        ]);

        // Register
        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Redirect
        return redirect()->route('users.index')->with('success', 'นำเข้าสินค้าสำเร็จ');
    }

    public function edituser(Request $request)
    {
        
        return view('users.edituser');
    }

}
