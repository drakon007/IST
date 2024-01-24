<!doctype html>
<html lang="en">
<head>
    @include('components.head', ['namePage' =>'EditTest'])
</head>
<body>

@include('components.header')
@include('components.error')
@include('components.message')

<div class="mx-auto  py-6 lg:px-32 lg:pt-12">
    <h1 class="font-bold mb-6 text-center md:text-left text-4xl md:text-3xl">Вопросы для теста: {{$test->name}}</h1>
    <div class="flex justify-end">
        <a href="{{route('updatePageTest', $test->id)}}"
           class="focus:outline-none text-white font-medium bg-blue-500 h-10 hover:bg-blue-700 rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
            <button>
                Изменить название теста
            </button>
        </a>
    </div>
    <div class="flex justify-end">
        <a href="{{route('getForTestInter', $test->id)}}"
           class="focus:outline-none text-white font-medium bg-blue-500 h-10 hover:bg-blue-700 rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
            <button>
                Интерпретации
            </button>
        </a>
    </div>

    @include('components.question', ["test_id"=>$test->id])
    <div class="rounded flex flex-col self-start text-center">
        <a href="{{route('addQuestion', $test->id)}}"
           class="relative inline-flex items-center justify-between rounded-md border border-gray-300 px-4 py-2 text-sm font-medium hover:bg-blue-700 bg-blue-500 text-white">
            Добавить вопрос к тесту
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
</div>

</body>
</html>
