<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class AuthController extends Controller
{

       public $registrationInput = [
            'check' => [
                'login',
                'fio',
                'group',
                'password',
            ],
            'label' => [
                'Логин',
                'Фамилия Имя Отчество',
                'Группа',
                'Пароль',
            ],
            'error' => [
                'Пожалуйста введите ваш логин',
                'Пожалуйста введите ваши инициалы',
                'Пожалуйста введите вашу группу',
                'Пожалуйста введите пароль',
            ]
        ];
    public function login()
    {
        try {
            return view('auth.login');
        } catch (\Throwable $th) {
            return response()->json([
                "description" => $th
            ]);
        }
    }

    public function auth(Request $request)
    {
        try {
            $validate = $this->validate($request, [
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

    public function create() {
        try {
            return view('auth.adduser')->
                with('collectionErrors', false)->
                with('data',$this->registrationInput);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Пользователь не создан",
                "description" => $th
            ])->setStatusCode(400);
        }
    }
    public function adduser(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "login"=>['required', 'string', 'max:10'],
            "fio"=>['required','string', 'max:200'],
            "group"=>['required','string', 'max: 25'],
            "password"=>['required', 'string', 'max:200'],
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors()->messages();
            $collectionErrors = collect([
                'login'=>$errors['login'][0],
                'fio'=>$errors['fio'][0],
                'group'=>$errors['group'][0],
                'password'=>$errors['password'][0],
            ]);

            return view('auth.adduser')->
                with('collectionErrors',$collectionErrors)->
                with('data',$this->registrationInput);
        }

        try {

            $candidate = User::where("login", $request->login)->first();

            if ($candidate) {
                return response()->json([
                    "error" => "Пользователь уже существует",
                ])->setStatusCode(400);
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
