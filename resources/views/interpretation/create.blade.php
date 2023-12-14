@include('auth.check')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>createInterp</title>
    @vite('resources/js/app.js')
    @trixassets
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@include('layouts.header')

@if (session()->has('error'))
    <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" role="alert">
        <div>
            <p class="text-sm">{{session()->pull('error')}}</p>
        </div>
    </div>
@endif

<main class="contener h-screen w-screen bg-bgpage flex justify-items-center items-center">
    <!--поле для формы и лого-->
    <div class="flex mx-auto sm:w-full flex-col">
        <div class="px-5 xl:w-full md:w-full sm:w-full  mx-auto py-2 lg:px-32 lg:pt-12">
            <form method="POST" action="{{ route('createInterForTest', $id_test) }}" class="w-full">
                @csrf
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Название
                    интерпретации</label>
                <input
                    class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('name') is-invalid @enderror"
                    id="name" name="name" type="text" placeholder="Название интерпретации">
                @error('name')
                <p class="text-red-500 text-xs italic">Интерпретация введена не корректно</p>
                @enderror

                {{-- todo решить, что делать с баллами--}}
{{--                <div class="flex">--}}
{{--                    <div class="w-1/2">--}}
{{--                        <label class="block text-gray-700 text-sm font-bold mb-2" for="min">Минимальное колличество--}}
{{--                            баллов</label>--}}
{{--                        <input--}}
{{--                            class="shadow appearance-none border  rounded w-11/12 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('min') is-invalid @enderror"--}}
{{--                            id="min" name="min" type="text" placeholder="минимальное">--}}
{{--                        @error('min')--}}
{{--                        <p class="text-red-500 text-xs italic">Колличестов введено не корректно</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="w-1/2">--}}
{{--                        <label class="block text-gray-700 text-sm font-bold mb-2" for="min">Максимальное колличество--}}
{{--                            баллов</label>--}}
{{--                        <input--}}
{{--                            class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('max') is-invalid @enderror"--}}
{{--                            id="max" name="max" type="text" placeholder="максимальное">--}}
{{--                        @error('max')--}}
{{--                        <p class="text-red-500 text-xs italic">Колличестов введено не корректно</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Описание интерпретации</label>
                @trix(\App\Question::class, 'content')
                <input type="submit" class=" mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            </form>
        </div>
    </div>
</main>
</body>
</html>
