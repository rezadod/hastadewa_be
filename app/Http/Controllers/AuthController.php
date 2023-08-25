<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
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
        $validator = Validator::make(request()->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'nama_pemilik_toko' => 'required',
            'no_hp' => 'required',
            'nama_toko' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $toko = Toko::create([
            'nama_toko' => request('nama_toko'),
            'nama_pemilik_toko' => request('nama_pemilik_toko'),
            'status_toko' => 1,
            'jenis_usaha' => 1,
            'alamat' => request('alamat'),
        ]);

        // dd($toko->id);
        $user = User::create([
            'email' => request("email"),
            'password' => Hash::make(
                request("password"),
            ),
            'no_hp' => request("no_hp"),
            'toko_id' => $toko->id,
            'role_id' => 1,
            'username' => request("username"),

        ]);


        if ($user) {
            return response()->json(['message' => 'Successfully registered']);
        } else {
            return response()->json(['message' => 'Failed registered']);
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
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        return response()->json([
            'success' => true,
            'data' => auth()->guard('api')->user(),
            'token' => $token,
        ]);
        // return view('input_stok');
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
