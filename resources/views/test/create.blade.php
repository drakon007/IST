@include('components.check')
    <!doctype html>
<html lang="en">
<head>
    @include('components.head', ['namePage' =>'CreateTest'])
</head>
<body>

@include('components.header')
@include('components.error')

<div class="h-max w-8/12 mx-auto">
    <!--поле для формы и лого-->
    <div class="flex flex-col items-center justify-center sm:gap-8 my-56">
        <form method="POST" action="{{ route('create') }}" class="w-full">
            @method('post')
            @csrf

            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Название теста</label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('name') is-invalid @enderror"
                id="name" name="name" type="text" placeholder="Название теста">
            @error('name')
            <p class="text-red-500 text-xs italic">Название теста введено не корректно</p>
            @enderror

            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Описание для теста</label>
            @trix(\App\Test::class, 'content')
            <input type="submit"
                   class=" mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>
    </div>
</div>
</body>
</html>
