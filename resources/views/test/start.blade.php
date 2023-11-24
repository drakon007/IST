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

<article class=" h-max bg-white my-4 mx-4 p-4 sm:p-6 lg:p-8">
    <div class="flex items-center justify-center sm:gap-8 my-56">
        <a href="{{route('startTest', ['id_test' => $idTest, 'id_user' => session('id')])}}">
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
