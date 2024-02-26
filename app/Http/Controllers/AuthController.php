<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Group;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // обработчик ошибок
        try {
            // переадресация
            return view('auth.login')->with('err',false);
        } catch (\Throwable $th) {
            // todo сделать редирект на 404
            session(['error'=>'Что-то пошло не так при авторизации, обратитесь к системному администратору']);
            return redirect()->route('login');
        }
    }
    public function auth(LoginRequest $request)
    {
        // обработчик
        try{
            // получение пользователя и проверка существования
            $user = User::where("login", $request->login)->first();
            if (!$user) {
                return view('auth.login')->
                with('err',"Данные не действительны");
            }

            // сравненией хеша
            if (!Hash::check($request->password, $user->password )) {
                return view('auth.login')->
                with('err',"Данные не действительны");
            }

            // проверка какие роли есть todo сделать разделение по ролям более заметное
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

            // создание сессии
            session([
                'id'=> $user->id,
                'fio'=>$user->fio,
                'role'=>$userRole,
            ]);
            Auth::login($user);

            return redirect()->route('home');
        } catch (\Throwable $th) {
            session(['error'=>'Что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('login');
        }
    }
    public function register() {
        try {
            $groups = Group::all();
            return view('auth.register')->
                with('groups', $groups)->
                with('err', false);
        } catch (\Throwable $th) {
            session(['error'=>'Что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('login');
        }
    }
    public function createUser(AddRequest $request)
    {
        try {
            $groups = Group::all();
            $candidate = User::where("login", $request->login)->first();
            if ($candidate) {
                return view('auth.register')->with('groups', $groups)->
                with('err',"Полозователь с таким логином уже существует");
            }
            if ($request->password != $request->password2) {
                return view('auth.register')->with('groups', $groups)->
                with('err',"Введенные пароли отличаются");
            }
            $user = User::make([
                'fio'=>$request->fio,
                'group_id'=>$request->group,
                'login' => $request->login,
                'token'=>Str::random(60),
                'password'=> Hash::make($request->password)
            ]);
            $user->save();
            $role =  Role::where('name','user')->first();
            $user->roles()->attach($role->id);
            session([
                'id'=> $user->id,
                'fio'=>$user->fio,
                'role'=>$role->name
            ]);
            Auth::login($user);
            return redirect()->route('home');
        } catch (\Throwable $th) {
            session(['error'=>'Что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('login');
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
            session(['error'=>'Что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('login');
        }
    }
}

