<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Smoking;
use App\Http\Traits\ValidTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Smoker;

class LoginController extends Controller
{
    use ValidTrait;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['login']]);
    }

    /**
     * @bodyParam email string required email use to login
     * @bodyParam password string required password use to login
     */
    public function login(Request $request)
    {
        $credentials = request(['username', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @header Content-Type multipart/form-data
     * @header Accept application/json
     * @bodyParam account integer required 5 digits number use to login
     */
    public function loginApp(Request $request)
    {
        $request->validate([
            'account' => 'required',
        ]);

        $account = $request->account;

        $check = $this->checkValidAccount($account);

        if(!$check) {
            return response()->json(['message' => 'Invalid account. Please give last 5 digits of phone number'], 400);
        }

        $term = Smoker::where('account', $account)->max('term');
        $smoker = new Smoker();
        $smoker->account = (string)$account;
        $smoker->term = $term??0;
        
        $this->newAccount($smoker);

        return response()->json($smoker, 200);
    }

    /**
     * @authenticated
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
