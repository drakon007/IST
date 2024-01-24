<!doctype html>
<html lang="en">
<head>
    @include('components.head', ['namePage' =>'Results'])
</head>
<body>
@include('components.header')
<div class=" w-full py-6 lg:px-32 lg:pt-12">
    @if (count($answerUsers)>0)
        @foreach ($answerUsers as $answerUser)
            <article class="w-full rounded-xl bg-white my-4  p-4 ring ring-indigo-50 sm:p-6 lg:p-8 h-1/2">
                <div class="flex w-full items-start sm:gap-8">
                    <div class="w-full">
{{--todo нужноли выводить выбор пользователея, сделать доп страницу с выбраннами ответами--}}
                        {{--                        @foreach($answerUser->answers as $answer)--}}
                        {{--                            <p>на вопрос {{$loop->iteration}} был выбран ответ {{ $answer->answer }}</p>--}}
                        {{--                        @endforeach--}}

                        @if (session('role') == 'user')
                            @foreach($interpretations as $interpretation)
                                @if (key($interpretation) == $answerUser->end_at)
                                    <p>
                                        Тест: {{ $answerUser->test->name }}
                                    </p>
                                    <p>У вас: {{$interpretation[key($interpretation)]->name}}</p>
                                    <div class="trix-content trix-file-accept">
                                        <h3>Описание:</h3>
                                        @php
                                            echo($interpretation[key($interpretation)]->description);
                                        @endphp
                                    </div>
                                @endif
                            @endforeach
                        @else

                            <div class="flex justify-between">
                                <div class="w-8/12 flex mt-4 text-lg sm:text-xl break-all">
                                    <p>
                                        Пользователь: {{ $answerUser->user->fio}}
                                    </p>
                                </div>
                            </div>
                            <p>
                                Группа: {{ $answerUser->user->group->group }}
                            </p>
                            <p>
                                Тест: {{ $answerUser->test->name }}
                            </p>
                            <p>
                                Дата завершения: {{ date("Y-m-d H:i" , strtotime($answerUser->end_at)) }}
                            </p>

                            @foreach($interpretations as $interpretation)
                                @if (key($interpretation) == $answerUser->end_at)
                                    <p>Получил интерпретацию: {{$interpretation[key($interpretation)]->name}}</p>
                                    <p></p>
                                @endif
                            @endforeach
                        @endif


                    </div>
                </div>
            </article>
        @endforeach
    @else
        @if (session('role') == 'user')
            <div class="w-8/12 flex mt-4 text-lg sm:text-xl break-all">
                <p>Вы не прошли ни одного теста</p>
            </div>
        @else
            <div class="w-8/12 flex mt-4 text-lg sm:text-xl break-all">
                <p>Никто не прошел ни одного теста</p>
            </div>
        @endif
    @endif
</div>
</body>
</html>
