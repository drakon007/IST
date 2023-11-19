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

@include('layouts.header', ['page'=> 'testing'])

<div class="container mx-auto  px-5 py-2 lg:px-32 lg:pt-12">
    @foreach($questions as $question)
        <article class="rounded-xl bg-white my-4 p-4 ring ring-indigo-50 sm:p-6 lg:p-8 h-1/2">
            <div class="flex items-start sm:gap-8">
                <div>
                    <strong class="rounded border bg-blue-500 px-3 py-1.5 text-[10px] font-medium text-white">
                        Вопрос номер {{ $questions->currentPage() }}
                    </strong>
                    <h3 class="mt-4 text-lg font-medium sm:text-xl">
                        {{ $question->question }}
                    </h3>
                    @include('layouts.answer', ['question_id' => $question->id])
                </div>
            </div>
        </article>
    @endforeach
</div>
</body>
</html>
