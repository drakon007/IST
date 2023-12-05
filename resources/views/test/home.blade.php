<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HomePage</title>
    @vite('resources/css/app.css')
</head>
<body>

@include('layouts.header')

@if (session()->has('message'))
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div>
            <p class="text-sm">{{session()->pull('message')}}</p>
        </div>
    </div>
@endif
@if (session()->has('error'))
    <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" role="alert">
        <div>
            <p class="text-sm">{{session()->pull('error')}}</p>
        </div>
    </div>
@endif

<div class="container  mx-auto  py-6 lg:px-32 lg:pt-12">
    <div class="flex flex-wrap">
        @foreach ($tests as $test)
            <div class="flex w-full lg:w-1/2 md:w-1/3 xl:w-1/3 flex-wrap">
                <div class="w-full rounded flex flex-col justify-center items-center text-center">
                    <div class="px-6 py-4">
                        <div
                            class="font-bold text-xl mb-2 text-center md:text-left md:text-3xl"> {{$test->name}}</div>
                        {{--<p class="text-gray-700 text-base">Описаниe</p>--}}
                        {{--//если надо будет добавить описание к тесту--}}
                    </div>
                    <div class="text-center md:text-left px-6 pt-4 pb-2  text-xl md:text-base">
                        @if ($test->status == "active")
                            @if (session('role') == 'admin' || session('role') == 'psuchologist')
                                <a href="{{route('deleteTest', $test->id)}}">
                                    <button
                                        class="bg-red-700 text-white hover:bg-red-800 font-medium  rounded-full text-sm px-3 py-1 mr-2 mb-2 dark:bg-red-600 "
                                        type="button">
                                        Удалить
                                    </button>
                                </a>
                                <a href="{{route("edit",$test->id)}}">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white rounded-full text-sm font-semibold px-3 py-1 mr-2 mb-2"
                                        type="button">
                                        Редактировать
                                    </button>
                                </a>
                            @else
                                <a href="{{route('startTestPage', $test->id)}}">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white rounded-full font-semibold  px-3 py-1 mr-2 mb-2"
                                        type="button">
                                        Пройти
                                    </button>
                                </a>
                            @endif
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

<footer class="flex mt-12 flex-row content-between flex-wrap justify-evenly">
    @if (session('role') == 'admin' || session('role') == 'psuchologist')
        <div class="rounded flex flex-col self-start text-center">
            <a href="{{route('addTest')}}"
               class="relative inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-sm font-medium hover:bg-blue-700 bg-blue-500 text-white">
                Добавить тест
                <svg class="w-6 h-6 ml-4 text-gray-800 dark:text-white" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M18 2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2ZM2 18V7h6.7l.4-.409A4.309 4.309 0 0 1 15.753 7H18v11H2Z"/>
                    <path
                        d="M8.139 10.411 5.289 13.3A1 1 0 0 0 5 14v2a1 1 0 0 0 1 1h2a1 1 0 0 0 .7-.288l2.886-2.851-3.447-3.45ZM14 8a2.463 2.463 0 0 0-3.484 0l-.971.983 3.468 3.468.987-.971A2.463 2.463 0 0 0 14 8Z"/>
                </svg>
            </a>
        </div>
    @endif
    <div class="flex flex-row content-between flex-wrap">
        {{--если текущая страница не 1 тогда отрисовать кнопку назад--}}
        @if($tests->currentPage() > 1)
            <div>
                <a href="{{$tests->previousPageUrl()}}"
                   class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-blue-500  hover:text-white">
                    <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg"
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
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</footer>
</body>
</html>
