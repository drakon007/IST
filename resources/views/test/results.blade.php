<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Results</title>
    @vite('resources/css/app.css')
</head>
<body>
@include('layouts.header')
<div class=" w-full py-6 lg:px-32 lg:pt-12">
    @if (count($answerUsers)>0)
        @foreach ($answerUsers as $answerUser)
            <article class="w-full rounded-xl bg-white my-4  p-4 ring ring-indigo-50 sm:p-6 lg:p-8 h-1/2">
                <div class="flex w-full items-start sm:gap-8">
                    <div class="w-full">
                        <div class="flex justify-between">
                            <div class="w-8/12 flex mt-4 text-lg sm:text-xl break-all">
                                <p>
                                    Пользователь: {{ $answerUser->user->fio}}
                                </p>
                            </div>
                        </div>
                        <p>
                            Группа: {{ $answerUser->user->group }}
                        </p>
                        <p>
                            Тест: {{ $answerUser->test->name }}
                        </p>

                        @foreach($answerUser->answers as $qwe)
                            <p>на вопрос {{$loop->iteration}} был выбран ответ {{ $qwe->answer }}</p>
                        @endforeach

                        <p>Получил интерпретацию: {{$answerUser->test->interpretations[0]->description}}</p>
                    </div>
                </div>
            </article>
        @endforeach
    @endif
</div>
</body>
</html>
