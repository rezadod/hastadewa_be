<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function register()
    {
        try {
            $validator = Validator::make(request()->all(), [
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8',
                'nama_pemilik_toko' => 'required',
                'no_hp' => 'required',
                'nama_toko' => 'required',
                'alamat' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->messages());
            } elseif (Toko::where('nama_toko', request('nama_toko'))->exists()) {
                return response()->json(['message' => 'Nama toko sudah dipakai'], 400);
            } else if (User::where('username', request('username'))->exists()) {
                return response()->json(['message' => 'Username sudah dipakai'], 400);
            } else if (User::where('email', request('email'))->exists()) {
                return response()->json(['message' => 'Email sudah digunakan'], 400);
            } else {
                $toko = Toko::create([
                    'nama_toko' => request('nama_toko'),
                    'nama_pemilik_toko' => request('nama_pemilik_toko'),
                    'status_toko' => 1,
                    'jenis_usaha' => 1,
                    'alamat' => request('alamat'),
                ]);
                $user = User::create([
                    'email' => request("email"),
                    'password' => Hash::make(
                        request("password"),
                    ),
                    'no_hp' => request("no_hp"),
                    'toko_id' => $toko->id,
                    'role_id' => 2,
                    'username' => request("username"),
                ]);
                if ($user) {
                    return response()->json(['message' => 'Aku berhasil'], 200);
                } else {
                    return response()->json(['message' => 'Failed registered'], 400);
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }
    public function register_admin()
    {
        try {
            $validator = Validator::make(request()->all(), [
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);

            $data_owner = DB::table('users')->where('id', Auth()->id())->first();
            if ($validator->fails()) {
                return response()->json($validator->messages());
            } else if (User::where('username', request('username'))->exists()) {
                return response()->json(['message' => 'Username sudah dipakai'], 400);
            } else if (User::where('email', request('email'))->exists()) {
                return response()->json(['message' => 'Email sudah digunakan'], 400);
            } else {
                $user = User::create([
                    'email' => request("email"),
                    'password' => Hash::make(
                        request("password"),
                    ),
                    'no_hp' => request("no_hp"),
                    'toko_id' => $data_owner->toko_id,
                    'role_id' => 3,
                    'username' => request("username"),
                ]);
                if ($user) {
                    return response()->json(['message' => 'Admin berhasil didaftarkan'], 200);
                } else {
                    return response()->json(['message' => 'Failed registered'], 400);
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // session_start();
        // $_SESSION["data_users_lokal"] = auth()->guard('api')->user();
        // $cookie_name = "data_users";
        // $cookie_value = auth()->guard('api')->user();
        // setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        // echo "<script>localStorage.setItem('data_users', '$cookie_value');</script>";

        // return response()->json([
        //     'success' => true,
        //     'data' => auth()->guard('api')->user(),
        //     'token' => $token,
        // ]);
        return view('dashboard/dashboard');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
