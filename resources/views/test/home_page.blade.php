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

@include('layouts.header', ['page'=> 'home'])

<div class="container  mx-auto  py-6 lg:px-32 lg:pt-12">
    <div class="flex flex-wrap ">
        @foreach ($tests as $test)
            <div class="flex w-full lg:w-1/2 md:w-1/3 xl:w-1/3 flex-wrap">
                <div class="w-full rounded flex flex-col justify-center items-center text-center">
                    <div class="px-6 py-4">
                        <div
                            class="font-bold text-xl mb-2 text-center md:text-left text-4xl md:text-3xl"> {{$test->name}}</div>
                        {{--<p class="text-gray-700 text-base">Описаниe</p>--}}
                        {{--// todo если надо будет добавить описание к тесту--}}
                    </div>
                    <div class="text-center md:text-left px-6 pt-4 pb-2  text-xl md:text-base">
                        @if ($test->status_id == "1")
                            <a href="http://127.0.0.1:8000/question/get/{{$test->id}}">
                                <button
                                    class="bg-blue-500 hover:bg-blue-700 text-white rounded-full px-3 py-1  font-semibold text-gray-700 mr-2 mb-2"
                                    type="button">
                                    Пройти
                                </button>
                            </a>
                        @else
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 font-semibold text-gray-700 mr-2 mb-2">тест не доступен</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<footer class="flex flex-row content-between flex-wrap justify-center">
        {{--если текущая страница не 1 тогда отрисовать кнопку назад--}}
        @if($tests->currentPage() > 1)
            <div>
                <a href="{{$tests->previousPageUrl()}}"
                   class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-blue-500  hover:text-white">
                    <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 5H1m0 0 4 4M1 5l4-4"/>
                    </svg>
                    Предыдущая
                </a>
            </div>
        @endif

        {{--если страниц несколько, тогда вывесити ссылки на них--}}
        @if($tests->lastPage() >=2)
            @for ($i = 0; $i < $tests->lastPage(); $i++)
                <div class="flex">
                    <a href="{{$tests->url($i+1)}}"
                       class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-blue-500  hover:text-white">
                        {{$i+1}}
                    </a>
                </div>
            @endfor
        @endif

{{--        если это не последняя страница, отрисовать кнопку далее--}}
        @if($tests->currentPage() < $tests->lastPage())
            <div>
                <a href="{{$tests->nextPageUrl()}}"
                   class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-blue-500  hover:text-white">
                    Следущая
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        @endif
</footer>
</body>
</html>
