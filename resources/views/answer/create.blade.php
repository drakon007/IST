@include('auth.check')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>createAnswer</title>
    @vite('resources/css/app.css')
</head>
<body>

@include('layouts.header')

<main class="h-screen w-screen flex justify-items-center items-center">
    <!--поле для формы и лого-->
    <div class="flex mx-auto sm:w-full flex-col">
        <div class="px-5 xl:w-1/3 md:w-1/2 sm:w-full  mx-auto py-2 lg:px-32 lg:pt-12">
            <form method="POST" action="{{ route('createForQuestion', $question->id) }}" class="w-full">
                @method('post')
                @csrf

                <label class="block text-gray-700 text-sm font-bold mb-2" for="answer">Ответ</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('answer') is-invalid @enderror"
                    id="answer" name="answer" type="text" placeholder="ответ на вопрос">
                @error('answer')
                <p class="text-red-500 text-xs italic">Ответ введен не корректно</p>
                @enderror

                <label class="block text-gray-700 text-sm font-bold mb-2" for="column">Интерпретация к которой будут добавлены баллы</label>
                <select name="column" class="bg-gray-50 border border-gray-300 text-blue-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach($interpretations as $interpretation)
                        <option value="{{ $interpretation->column}}">
                            {{ $interpretation->name }}
                        </option>
                    @endforeach
                </select>


                <label class="block text-gray-700 text-sm font-bold mb-2" for="balls">Колличество баллов</label>
                <input
                    class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('balls') is-invalid @enderror"
                    id="balls" name="balls" type="text" placeholder="колонка с баллами">
                @error('balls')
                <p class="text-red-500 text-xs italic">Баллы можно вводить только цифрами</p>
                @enderror

                <div class="flex items-center justify-between">
                    <button
                        class=" mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Добавить вопрос
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
</body>
</html>
