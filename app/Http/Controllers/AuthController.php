<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function render()
    {
        try {
            return view('login');
        } catch (\Throwable $th) {
            return response()->json([
                "description" => $th
            ])->setStatusCode($th->status);
        }
    }

    public function login(Request $request)
    {
        try {
            $this->validate($request, [
               'login'=> ['required', 'string', 'max: 200'],
               'password'=> ['required', 'string', 'max:200']
            ]);

            $user = User::where("login", $request->login)->first();

            if (!$user) {
                return response()->json([
                    'errors' => 'Пользователя не существует',
                    // todo сделать auth контроллер
                ])->setStatusCode(400);
            }

            if (Hash::check($request->password, $user->password )) {
                return response()->json([
                    'add' => 'pass chech',
                    // todo сделать chech
                ])->setStatusCode(200);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "введены не корректные данные",
                "description" => $th
            ])->setStatusCode(400);
        }
    }

    public function createUser(Request $request)
    {
        try {

            $this->validate($request, [
                "login"=>['required', 'string', 'max:200'],
                "password"=>['required', 'string', 'max:200'],
            ]);

            $candidate = User::where("login", $request->login)->first();

            if ($candidate) {
                return response()->json([
                    "error" => "Пользователь уже существует",
                ])->setStatusCode(400);
            }

            $user = User::make([
                'login' => $request->login,
                'token'=>Str::random(60),
                'password'=> Hash::make($request->password)
            ]);

            $user->save();
            return response()->json([
                'message' => "Пользователь создан"
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Пользователь не создан",
                "description" => $th
            ])->setStatusCode(400);
        }
    }

}
