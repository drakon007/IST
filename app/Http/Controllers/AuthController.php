<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRequest;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

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
                with('err',"Пользователя не существует");
            }

            if (!Hash::check($request->password, $user->password )) {
                return view('auth.login')->
                with('err',"Поверьте пароль");
            }
            foreach ($user->roles as $role) {
                if ($role->name == 'admin') {
                    $userRole = 'admin';
                    break;
                }
                if ($role->name == 'psychologist') {
                    $userRole = 'psychologist';
                    break;
                }
                $userRole = 'user';
            }

            session([
                'id'=> $user->id,
                'login'=>$user->login,
                'role'=>$userRole,
            ]);

            Auth::login($user);
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
    public function adduser(AddRequest $request)
    {
        try {
            $candidate = User::where("login", $request->login)->first();

            if ($candidate) {
                return view('auth.adduser')->
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
            $role =  Role::where('name','user')->first();
            $user->roles()->attach($role->id);

            session([
                'id'=> $user->id,
                'login'=>$user->login,
                'role'=>$role->name
            ]);

            Auth::login($user);

            return redirect()->route('home');

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Пользователь не создан",
                "description" => $th
            ])->setStatusCode(400);
        }
    }

    public function logout() {
        try {
            session()->flush();
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            return view('auth.login')->with('err',false);
        }catch (\Throwable $th) {
            return response()->json([
                'errors' => "Ошибка при выход пользователя",
                "description" => $th
            ])->setStatusCode(400);
        }
    }

}

