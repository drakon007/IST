<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @vite('resources/css/app.css')
</head>
<body>

{{--todo сделать шапку--}}
<ul class="flex">
    {{--    <li class="flex-1 mr-2">--}}
    {{--        <a class="text-center block border border-white rounded hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-2 px-4" href="#">Выбор теста</a>--}}
    {{--    </li>--}}
    {{--    <li class="flex-1 mr-2">--}}
    {{--        <a class="text-center block border border-blue-500 rounded py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white" href="#">Просмотрель результаты</a>--}}
    {{--    </li>--}}
    <li class="flex-1 mr-2">
        <a class="text-center block border border-blue-500 rounded py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white" href="#">Выбор теста</a>
    </li>
    <li class="flex-1 mr-2">
        <a class="text-center block border border-white rounded hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-2 px-4" href="#">Просмотрель результаты</a>
    </li>
    <li class="text-right flex-1">
        <a class="py-2 px-4 text-gray-400" href="#">Логин:  20061</a>
    </li>
</ul>


<div class="container mx-auto px-5 py-2 lg:px-32 lg:pt-12">
    <div class="-m-1 flex flex-wrap md:-m-2">
        @foreach ($tests as $test)
            <div class="flex w-full lg:w-1/3 md:w-1/3 xl:w-1/3 flex-wrap">
                <div class="max-w-sm rounded ">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{$test->name}}</div>
                        {{--                                                <p class="text-gray-700 text-base">Описаниe</p>--}}
                        {{--                        // todo если надо бедет добавить описание к тесту--}}
                    </div>
                    @if ($test->status == "active")
                        <div class="px-6 pt-4 pb-2">
                            <a href="http://127.0.0.1:8000/question/get/{{$test->id}}" >
                                <button class="bg-blue-500 hover:bg-blue-700 text-white rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2" type="button">
                                    Пройти
                                </button>
                            </a>
                        </div>
                    @else
                        <div class="px-6 pt-4 pb-2">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">тест не доступен</span>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
