<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class AuthController extends Controller
{

    public function login()
    {
        try {
            return view('auth.login')->with('err',false);
        } catch (\Throwable $th) {
            return response()->json([
                "description" => $th
            ]);
        }
    }

    public function auth(LoginRequest $request)
    {
        try {
            // получение пользователя и проверка существования
            $user = User::where("login", $request->login)->first();
            if (!$user) {
                return view('auth.login')->
                with('err',"Поверьте данные, они не соответствуют действительности");
            }
            // проверка пароля
//            dd($request->password,
//                $user->password,
//                Hash::check($request->password, $user->password ));
            if (!Hash::check($request->password, $user->password )) {
                return view('auth.login')->
                with('err',"Поверьте данные, они не соответствуют действительности");
            }

            return redirect()->route('home');

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "введены не корректные данные",
                "description" => $th
            ])->setStatusCode(400);
        }
    }

    public function create() {
        try {
            return view('auth.adduser')->
                with('err', false);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Пользователь не создан",
                "description" => $th
            ])->setStatusCode(400);
        }
    }
    public function adduser(Request $request)
    {
        try {
            $candidate = User::where("login", $request->login)->first();

            if ($candidate) {
                return view('auth.login')->
                with('err',"Пользователь уже существует");
            }

            $user = User::make([
                'fio'=>$request->fio,
                'group'=>$request->group,
                'login' => $request->login,
                'token'=>Str::random(60),
                'password'=> Hash::make($request->password)
            ]);
            $user->save();

            return response()->json([
                'message' => "Пользователь создан",
                'user'=>$user
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Пользователь не создан",
                "description" => $th
            ])->setStatusCode(400);
        }
    }

}

//
//use Illuminate\Http\Request;
//use App\Models\User;
//use Illuminate\Http\Response;
//use Illuminate\Support\Facades\Hash;
/////
//public function sign_up(Request $request){
//    $data = $request->validate([
//        'name' => 'required|string',
//        'email' => 'required|string|unique:users,email',
//        'password' => 'required|string|confirmed'
//    ]);
//
//    $user = User::create([
//        'name' => $data['name'],
//        'email' => $data['email'],
//        'password' => bcrypt($data['password'])
//    ]);
//
//    $token = $user->createToken('apiToken')->plainTextToken;
//
//    $res = [
//        'user' => $user,
//        'token' => $token
//    ];
//    return response($res, 201);
//}
//
//public function login(Request $request)
//{
//    $data = $request->validate([
//        'email' => 'required|string',
//        'password' => 'required|string'
//    ]);
//
//    $user = User::where('email', $data['email'])->first();
//
//    if (!$user || !Hash::check($data['password'], $user->password)) {
//        return response([
//            'msg' => 'incorrect username or password'
//        ], 401);
//    }
//
//    $token = $user->createToken('apiToken')->plainTextToken;
//
//    $res = [
//        'user' => $user,
//        'token' => $token
//    ];
//
//    return response($res, 201);
//}
//
//public function logout(Request $request)
//{
//    auth()->user()->tokens()->delete();
//    return [
//        'message' => 'user logged out'
//    ];
//}
//
//
//7)	api.php
//Route::post('/signup', [AuthController::class, 'sign_up']);
//Route::post('/login', [AuthController::class, 'login']);
//
//Route::group(['middleware' => ['auth:sanctum']], function () {
//    Route::post('/logout', [AuthController::class, 'logout']);
