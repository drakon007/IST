<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>testing</title>
    @vite('resources/css/app.css')
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
<div class="container mx-auto  px-5 py-2 lg:px-32 lg:pt-12">
    <nav class=" mx-auto flex gap-0.5">
        {{--если страниц несколько, тогда вывесити ссылки на них--}}
        @if($questions->lastPage() >=2)
            @for ($i = 0; $i < $questions->lastPage(); $i++)
                <div class="justify-center">
                    <a href="{{$questions->url($i+1)}}"
                       class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-blue-500  hover:text-white">
                        {{$i+1}}
                    </a>
                </div>
            @endfor
        @endif
    </nav>
    @foreach($questions as $question)
        <article class="rounded-xl bg-white my-4 p-4 ring ring-indigo-50 sm:p-6 lg:p-8 h-1/2">
            <div class="flex items-start sm:gap-8">
                <div class="w-full">
                    <strong class="rounded border bg-blue-500 px-3 py-1.5 text-[10px] font-medium text-white">
                        Вопрос номер {{ $questions->currentPage() }}
                    </strong>
                    <h3 class="mt-4 text-lg font-medium sm:text-xl break-all">
                        {{ $question->question }}
                    </h3>
                    <form method='POST' action="{{route('saveAnswerUser',session('answer_user_id'))}}">
                        @method('POST')
                        @csrf
                        @include('answer.answer', ['question_id' => $question->id])
                        {{session(['next'=>$questions->nextPageUrl()])}}
                        <div
                            class="items-center justify-end flex mt-10">
                            @if($questions->currentPage() < $questions->lastPage())

                                <div
                                    class="flex items-center justify-end rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-blue-500  hover:text-white">
                                    <button>
                                        Следущий вопрос
                                    </button>
                                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </div>
                            @else
                                {{session(['next'=>'home'])}}
                                <div
                                    class="flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-blue-500  hover:text-white">
                                    <button>
                                        Завершить тест
                                    </button>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </article>
    @endforeach
</div>
</body>
