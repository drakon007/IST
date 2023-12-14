@include('auth.check')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>createQuestion</title>
    @vite('resources/js/app.js')
    @trixassets
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

@include('layouts.header')

<main class="h-screen w-full flex justify-items-center items-center">
    <!--поле для формы и лого-->
    <div class="flex mx-auto sm:w-full flex-col">
        <div class="px-5  mx-auto  py-2 lg:px-32 lg:pt-12">
            <form method="POST" action="{{ route('createForTest', $test->id) }}" class="w-full">
                @csrf
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Вопрос</label>
                @trix(\App\Interpretation::class, 'content')
                <input type="submit" class=" mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            </form>
        </div>
    </div>
</main>
</body>
</html>
