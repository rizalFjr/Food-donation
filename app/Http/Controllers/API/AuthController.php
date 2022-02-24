<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use HasRoles, GeneralTraits;

    public function login(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            // Mengecek credentials (login)
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user->hasRole('user')) {
                throw new Exception('Invalid Roles');
            }
            if (!Hash::check($request->password, $user->password, [])) {
                throw new Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            $members = Member::where('user_id', $user->id)->first();

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user'  => $user,
                'member' => $members
            ], 'Authenticated');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'no_telp' => ['required', 'string', 'max:255'],
            ]);

            $users = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $users->assignRole('user');

            $members = Member::create([
                'user_id' => $users->id,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rw' => $request->rw,
                'rt' => $request->rt,
                'kode_pos' => $request->kode_pos,
               
            ]);

            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
                'member' => $members
            ], 'User Registered');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => "Something went wrong",
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete;

        return ResponseFormatter::success($token, 'Token Revoked');
    }

    public function fetchUser(Request $request)
    {
        try {
            $users = User::findOrFail(Auth::user()->id);
            $members = Member::where('user_id', '=', $users->id)->firstOrFail();

            return ResponseFormatter::success([
                'user' => $users,
                'member' => $members
            ], 'Data member berhasil diambil.');
        }  catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Data member gagal diambil.', 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required'],
                'no_telp' => ['required'],
            ]);
    
            $users = User::findOrFail(Auth::user()->id);
            $members = Member::where('user_id', '=', $users->id)->firstOrFail();
            $users->update([
                'name'  => $request->name,
            ]);
           
            $members->update([
                'user_id' => $users->id,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rw' => $request->rw,
                'rt' => $request->rt,
                'kode_pos' => $request->kode_pos,
            ]);

            return ResponseFormatter::success([
                'user' => $users,
                'member' => $members
            ], 'Profile Updated');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Profile gagal diupdate', 500);
        }
    }

    public function updatePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required|image'
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(['error' => $validator->errors()], 'Update photo fails', 401);
        }

        if ($request->file('foto')) {
            $members = Member::where('user_id', '=', Auth::user()->id)->first();

            $photo_profile = $request->file('foto');
            $path_profile = '/uploads/images/photo-profile';

            $filename_photo = $this->storeCompressImage($photo_profile, $path_profile);

            $members->foto = $filename_photo;
            $members->update();

            return ResponseFormatter::success([$filename_photo], 'File successfully uploaded');
        }
    }
}
