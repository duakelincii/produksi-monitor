<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Alert;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $datas = User::get();
        return view('user.index',compact('datas'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->all();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role'  => $data['role'],
            'username' => $data['username']
        ]);
        Alert::success('Success','User Berhasil Ditambahkan');
        return redirect(route('user'));
    }

    public function delete($id)
    {
        $datas = User::findOrFail($id);
        $datas->delete();
        Alert::warning('Delete','User Berhasil Dihapus');
        return redirect(route('user'));
    }
}
