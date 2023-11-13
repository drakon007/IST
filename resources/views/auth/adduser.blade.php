<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body>

<main class="contener h-screen w-screen bg-bgpage flex justify-items-center items-center">
    <!--поле для формы и лого-->
    <div class="flex mx-auto sm:w-full flex-col">
        <div class="px-5 xl:w-1/3 md:w-1/2 sm:w-full  mx-auto py-2 lg:px-32 lg:pt-12">
            <form method="POST" action="{{ route('adduser') }}" class="w-full">
                @csrf

                @if ($collectionErrors == false)
                    @for($i = 0; $i < count($data['check']); $i++)
                        @include('layouts.input', [
                        'check'=> $data['check'][$i],
                        'label'=> $data['label'][$i]
                        ])
                    @endfor
                @else
                    @for($i = 0; $i < count($data['check']); $i++)
                        @if ($collectionErrors[$data['check'][$i]])
                            @include('layouts.inputErrors', [
                            'check'=> $data['check'][$i],
                            'label'=> $data['label'][$i],
                            'error'=> $data['error'][$i]
                            ])
                        @endif
                    @endfor
                @endif

                <div class="flex items-center justify-between">
                    <button
                        class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Вход
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
</body>
</html>
