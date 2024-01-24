@include('components.check')
    <!doctype html>
<html lang="en">
<head>
    @include('components.head', ['namePage' =>'CreateInterp'])
</head>
<body>
@include('components.header')
@include('components.error')

<div class="h-max w-8/12 mx-auto">
    <div class="flex flex-col items-center justify-center my-56">
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
            @trix(\App\Interpretation::class, 'content')
            <input type="submit"
                   class=" mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>
    </div>
</div>
</body>
</html>
