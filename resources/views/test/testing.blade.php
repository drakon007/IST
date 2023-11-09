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

<div class="container mx-auto px-5 py-2 lg:px-32 lg:pt-12">
    {{--    <div class="-m-1 flex flex-wrap md:-m-2">--}}
    {{--        @foreach ($questions as $question)--}}

    {{--        @endforeach--}}
    {{--    </div>--}}


    {{--    dsf //todo сделать в форму для отправки--}}
    <article class="rounded-xl bg-white p-4 ring ring-indigo-50 sm:p-6 lg:p-8">
        <div class="flex items-start sm:gap-8">

            <div>
                <strong class="rounded border bg-blue-500 px-3 py-1.5 text-[10px] font-medium text-white">
                    Номер вопроса
                </strong>


                <h3 class="mt-4 text-lg font-medium sm:text-xl">
                    Сам вопрос
                </h3>

                @include('layouts.answer')


            </div>

        </div>
    </article>
</div>
<script>

</script>
</body>
</html>
