<!doctype html>
<html lang="en">
<head>
    @include('components.head', ['namePage' =>'Login'])
</head>
<body>
@if (!!$err)
<div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" role="alert">
    <div>
        <p class="text-sm">{{$err}}</p>
    </div>
</div>
@endif
<section class="mt-28">
    <div class="container h-full px-6 py-24">
        <div
            class="g-6 flex h-full flex-wrap items-center justify-center lg:justify-between">
            <div class="mb-12 md:mb-0 md:w-8/12 lg:w-6/12">
                <img
                    src="https://tecdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                    class="w-full"
                    alt="Phone image"/>
            </div>
            <div class="md:w-8/12 lg:ml-6 lg:w-5/12">
                <form method="post" action="{{route('auth')}}">
                    @csrf
                    @include('components.input', ['name'=>'login', 'type'=>'text', 'placeholder'=>'Логин'])
                    @include('components.input', ['name'=>'password', 'type'=>'password', 'placeholder'=>'Пароль'])
                    <button
                        type="submit"
                        class="inline-block w-full rounded bg-primary px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white bg-blue-500"
                        data-te-ripple-init
                        data-te-ripple-color="light">
                        Войти
                    </button>
                   @include('components.line')
                    <a
                        href="{{route('register')}}"
                        class="float-right"
                    >Нет учетной записи?</a>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>
