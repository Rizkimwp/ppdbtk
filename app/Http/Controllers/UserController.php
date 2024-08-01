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
    public function index(Request $request)
    {
        // Ambil parameter pencarian dari request
        $nama = $request->input('nama');

        // Query pengguna
        $query = User::query();

        if ($nama) {
            // Filter berdasarkan nama (menggunakan LIKE untuk pencarian parsial)
            $query->where('name', 'like', '%' . $nama . '%');
        }

        // Paginasi hasil query
        $user = $query->paginate(5);

        return view('pages.list_user', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:16|min:4',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
            'konfirmasi' => 'required|string|same:password',
            'role' => 'required|string'
        ]);

        try {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('user.index')->with('success','User berhasil terdaftar');
        }catch (\Throwable $e) {
            return redirect()->route('user.index')->with('success','User gagal terdaftar' . $e->getMessage());
        }
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
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:16|min:4',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string'
        ]);

        try {
        $user  = User::findOrFail($id);
        $user -> name = $request->name;
        $user -> username = $request->username;
        $user -> email = $request->email;
        $user -> role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('success','User berhasil di perbarui');
        }catch (\Throwable $e) {
            return redirect()->route('user.index')->with('success','User gagal di perbarui' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function changePassword(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:4|confirmed',
        ]);

        $user = User::find($id);

         // Jika user tidak ditemukan
    if (!$user) {
        return redirect()->route('user.index')->with('error', 'Pengguna tidak ditemukan.');
    }

    // Cek apakah password lama sesuai
    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->with('error' , 'Password Lama Tidak Sesuai');
    }

    // Update password baru
    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('user.index')->with('success', 'Password berhasil diubah');
    }
}