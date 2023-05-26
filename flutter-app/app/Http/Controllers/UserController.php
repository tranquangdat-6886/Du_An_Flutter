<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();

        return view('backend.pages.users.list_user')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userData = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'role' => $request->input('role')
        ];

        // Tạo đối tượng Employee và lưu vào cơ sở dữ liệu



        $hashedPassword = Hash::make($userData['password']);

        // Tạo đối tượng User và lưu vào cơ sở dữ liệu
        $user = new User([
            'name' => $userData['name'],
            'username' => $userData['username'],
            'password' => $hashedPassword,
            'role' => $userData['role'],

        ]);
        $user->save();
        return redirect()->route('users.index')->with('message', "Successfully Created Account");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userdelete=User::find($id);
        $userdelete->delete();
        return redirect()->route('users.index')->with('message', "Successfully Delete One Talent");
    }

    public function editUser($userId)
    {
        // Xử lý yêu cầu AJAX và trả về dữ liệu tương ứng
        $user = User::find($userId);

        $response = [
            'name' => $user->name,
            'username' => $user->username,
            'password' => $user->password,
            'role' => $user->role,
            'api_token' => $user->api_token,
        ];
        // Trả về dữ liệu
        return response()->json($response);
    }
}