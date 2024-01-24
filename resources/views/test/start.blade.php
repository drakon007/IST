<!doctype html>
<html lang="en">
<head>
    @include('components.head', ['namePage' =>'StartPage'])
</head>>
<body>
@include('components.header')

<article class="w-8/12 h-max mx-auto bg-white p-4 sm:p-6 lg:p-8">
    <div class="flex flex-col items-center justify-center sm:gap-8 my-56">
        <h3 class="text-4xl decoration-8 font-semibold">{{$test->name}}</h3>

        <div class="trix-content trix-file-accept">
            @php
                echo($test->description);
            @endphp
        </div>

        <a href="{{route('startTest', ['id_test' => $test->id, 'id_user' => session('id')])}}">
            <button
                    class="bg-blue-500 hover:bg-blue-700 text-white rounded-full text-2xl px-6 py-3 mr-2 mb-2"
                    type="button">
                Начать тест
            </button>
        </a>
    </div>
</article>

</body>
</html>
