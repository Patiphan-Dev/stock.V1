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
            'password' => ['required', 'min:6'],
            'status' => ['required'],

        ]);

        // Register
        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Redirect
        return redirect()->route('users.index')->with('success', 'เพิ่มผู้ใช้สำเร็จ');
    }

    public function edituser($id)
    {
        $data = [
            'title' => 'Edit User'
        ];
        $user = User::find($id);

        return view('users.edituser', compact('user'), $data);
    }

    public function updateuser(Request $request, $id)
    {
        // ตรวจสอบและแสดงข้อมูลที่ส่งมา
        // dd($request, $id);

        // Validate ข้อมูล
        $request->validate([
            'fullname' => ['required', 'max:100'],
            'username' => ['required', 'max:50'],
            'status' => ['required'],
        ]);

        // ค้นหาผู้ใช้
        $user = User::find($id);

        // ตรวจสอบว่าผู้ใช้มีอยู่หรือไม่
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'ไม่พบผู้ใช้ที่ระบุ');
        }

        // อัปเดตข้อมูลผู้ใช้
        $user->update([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        // Redirect พร้อมกับข้อความสำเร็จ
        return redirect()->route('users.index')->with('success', 'อัปเดตข้อมูลผู้ใช้สำเร็จ');
    }

    public function deleteuser($id)
    {
        // Attempt to find the user
        $user = User::find($id);

        if ($user) {
            // Soft delete the user
            $user->delete();

            return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ');
        }

        // If user not found, return an error message
        return redirect()->back()->with('error', 'ไม่พบผู้ใช้ที่ต้องการลบ');
    }
}
