<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UpdateQuestion</title>
    @vite('resources/css/app.css')
</head>
<body>

@include('layouts.header')

<main class="h-screen w-full flex justify-items-center items-center">
    <!--поле для формы и лого-->
    <div class="flex mx-auto sm:w-full flex-col">
        <div class="px-5 xl:w-1/3 md:w-1/2 sm:w-full  mx-auto py-2 lg:px-32 lg:pt-12">
            <form method='POST' action="{{ route('updateQuestion', $question->id) }}" class="w-full" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <label class="block text-gray-700 text-sm font-bold mb-2" for="question">Вопрос</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('question') is-invalid @enderror"
                    id="question" name="question" type="text" placeholder="вопрос" value="{{$question->question}}">
                @error('question')
                <p class="text-red-500 text-xs italic">Вопрос введен не корректно</p>
                @enderror

                @if (!!$err)
                    <p class="text-red-500 text-xs italic">{{$err}}</p>
                @endif

                <div class="flex items-center justify-between">
                    <button
                        class=" mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Изменить вопрос
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
</body>
</html>
