@include('auth.check')
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>createTest</title>
    @vite('resources/css/app.css')
</head>
<body>

@include('layouts.header')

<main class="h-screen w-screen bg-bgpage flex justify-items-center items-center">
    <!--поле для формы и лого-->
    <div class="flex mx-auto sm:w-full flex-col">
        <div class="px-5 xl:w-1/3 md:w-1/2 sm:w-full  mx-auto py-2 lg:px-32 lg:pt-12">
            <form method="POST" action="{{ route('create') }}" class="w-full">
                @method('post')
                @csrf

                {{--                <label class="block text-gray-700 text-sm font-bold mb-2" for="type">Тип теста</label>--}}
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('type') is-invalid @enderror"
                    id="type" name="type" type="hidden" value="1">
                @error('type')
                <p class="text-red-500 text-xs italic">Тип теста введен не корректно</p>
                @enderror
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Название теста</label>
                <input
                    class="shadow appearance-none border text-gray-700 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('name') is-invalid @enderror"
                    id="name" name="name" type="text" placeholder="Название теста">
                @error('name')
                <p class="text-red-500 text-xs italic">Название теста введено не корректно</p>
                @enderror

                @if (!!$err)
                    <p class="text-red-500 text-xs italic">{{$err}}</p>
                @endif

                <div class="flex items-center justify-between">
                    <button
                        class=" mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Добавить тест
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
</body>
</html>
