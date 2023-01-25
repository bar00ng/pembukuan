<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        $users = User::whereRoleIs('user')->get();

        return view('user.listUser', ['users' => $users]);
    }

    public function delete($id) {
        User::where('id', $id)->delete();
        DB::table('role_user')->where('user_id',$id)->delete();

        return redirect('/user')->with('Message', 'Data berhasil dihapus');
    }

    public function tampilFormTambah() {
        return view('user.formTambahUser');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->attachRole('user');

        return redirect('/user')->with('Message', 'Data berhasil ditambahkan');
    }

    public function tampilFormEdit($id) {
        $user = User::where('id', $id)->first();

        return view('user.formEditUser', ['user' => $user]);
    }

    public function patch(Request $request, $id) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if (!empty($request->input('password'))) {
            $validated['password'] = Hash::make($request->password);
        }        
        User::where('id', $id)->update($validated);

        return redirect('/user')->with('Message', 'Data berhasil diedit');
    }
}
