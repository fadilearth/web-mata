<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function loginAct(LoginRequest $request)
    {
        $get_pasien = Pasien::where('email', $request->email)->first();

        if ($get_pasien != null) {
            if ($get_pasien->active != 1) {
                return response()->json([
                    'status' => 'belum_aktif'
                ]);
            }

            if (Auth::guard('pasien')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                return response()->json([
                    'status' => 'success',
                    'is_admin' => false,
                ]);
            }
        } else {
            $get_admin = User::where('email', $request->email)->first();

            if ($get_admin->active != 1) {
                return response()->json([
                    'status' => 'belum_aktif'
                ]);
            }

            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                return response()->json([
                    'status' => 'success',
                    'is_admin' => true,
                ]);
            }
        }


        return response()->json([
            'status' => 'error'
        ]);
    }

    public function registerAct(RegisterRequest $request)
    {
        // validasi
        // $validatedData = Validator::make($request->all(), [
        //     // 'email' => 'email|unique:users',
        //     'email' => 'email|unique:users',
        //     'password' => 'min:8',
        // ]);

        // if ($validatedData->fails()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'error' => $validatedData->errors(),
        //     ]);
        // }

        $cek_email = Pasien::where('email', $request->email)->first();
        if ($cek_email != null) {
            return response()->json([
                'status' => 'email_ada'
            ]);
        }

        Pasien::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => '0',
            'active' => 1,
            'foto_profile' => null,
            'tempat_lahir' => null,
            'tgl_lahir' => null,
            'umur' => null,
            'jenis_kelamin' => null,
            'alamat' => null,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'created_by' => 'SYSTEM',
            'updated_by' => null,
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function profile()
    {
    }
}
