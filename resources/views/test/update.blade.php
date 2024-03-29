<!doctype html>
<html lang="en">
<head>
    @include('components.head', ['namePage' =>'EditTest'])
</head>
<body>

@include('components.header')

<main class="h-screen w-screen flex justify-items-center items-center">
    <!--поле для формы и лого-->
    <div class="flex mx-auto sm:w-full flex-col">
        <div class="px-5 xl:w-1/3 md:w-1/2 sm:w-full  mx-auto py-2 lg:px-32 lg:pt-12">
            <form method="POST" action="{{ route('updateTest', $test->id) }}" class="w-full">
                @method('PUT')
                @csrf

                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Название теста</label>
                <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('name') is-invalid @enderror"
                        id="name" name="name" type="text" placeholder="Название теста" value="{{$test->name}}">
                @error('name')
                <p class="text-red-500 text-xs italic">Название теста введено не корректно</p>
                @enderror
{{-- todo поменять ошибку --}}
                @if (!!$err)
                    <p class="text-red-500 text-xs italic">{{$err}}</p>
                @endif

                <div class="flex items-center justify-between">
                    <button
                            class=" mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                        Изменить название
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
</body>
</html>
