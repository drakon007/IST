@include('components.check')
    <!doctype html>
<html lang="en">
<head>
    @include('components.head', ['namePage' =>'CreateQuestion'])
</head>
<body>

@include('components.header')

<main class="h-screen w-full flex justify-items-center items-center">
    <!--поле для формы и лого-->
    <div class="flex mx-auto sm:w-full flex-col">
        <div class="px-5  mx-auto  py-2 lg:px-32 lg:pt-12">
            <form method="POST" action="{{ route('createForTest', $test->id) }}" class="w-full">
                @csrf
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Вопрос</label>
                @trix(\App\Question::class, 'content')
                <input type="submit"
                       class=" mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            </form>
        </div>
    </div>
</main>
</body>
</html>
