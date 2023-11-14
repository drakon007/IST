<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body>

<main class="contener h-screen w-screen bg-bgpage flex justify-items-center items-center">
    <!--поле для формы и лого-->
    <div class="flex mx-auto sm:w-full flex-col">
        <div class="px-5 xl:w-1/3 md:w-1/2 sm:w-full  mx-auto py-2 lg:px-32 lg:pt-12">
            <form method="POST" action="{{ route('auth') }}" class="w-full">
                @method('post')
                @csrf

                <label class="block text-gray-700 text-sm font-bold mb-2" for="login">login</label>
                <input
                    class="shadow appearance-none border text-gray-700 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('login') is-invalid @enderror"
                    id="login" name="login" type="text" placeholder="логин">
                @error('login')
                <p class="text-red-500 text-xs italic">Логин или пароль введены не корректно</p>
                @enderror
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">password</label>
                <input
                    class="shadow appearance-none border text-gray-700 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') is-invalid @enderror"
                    id="password" name="password" type="password" placeholder="пароль">
                @error('password')
                <p class="text-red-500 text-xs italic">Логин или пароль введены не корректно</p>
                @enderror

                @if (!$err == false)
                    <p class="text-red-500 text-xs italic">{{$err}}</p>
                @endif

                <div class="flex items-center justify-between">
                    <button
                        class=" mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Вход
                    </button>
                    {{--                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">--}}
                    {{--                        Forgot Password?--}}
                    {{--                    </a>--}}
                </div>
            </form>
        </div>
    </div>
</main>
</body>
</html>
