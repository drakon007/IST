<header>
    @switch($page)
        @case('home')
            <ul class="flex">
                <li class="flex-1 mr-2  bg-blue-500 hover:bg-blue-700">
                    <a class="text-center block border border-blue-500 rounded py-2 px-4 text-white"
                       href="#">Выбор теста</a>
                </li>
                <li class="flex-1 mr-2">
                    <a class="text-center block border border-white rounded hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-2 px-4"
                       href="#">Просмотрель результаты</a>
                </li>
                <li class="text-right flex-1">
                    <a class="py-2 px-4 text-gray-400" href="#">Логин: 20061</a>
                    {{--                  todo сделать auth->id вместо логина--}}
                </li>
            </ul>
            @break
        @case('testing')
            <ul class="flex">
                <li class="flex-1 mr-2 hover:border-gray-200 text-blue-500 hover:bg-gray-200 border rounded border-white">
                    <a class="text-center block py-2 px-4"
                       href="{{route('home')}}">Выбор теста</a>
                </li>
                <li class="flex-1 mr-2">
                    <a class="text-center block border border-white rounded hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-2 px-4"
                       href="#">Просмотрель результаты</a>
                </li>
                <li class="text-right flex-1">
                    <a class="py-2 px-4 text-gray-400" href="#">Логин: 20061</a>
                    {{--                  todo сделать auth->id вместо логина--}}
                </li>
            </ul>
            @break
        @default
            <h1>Обратитесь к системному администратору</h1>
    @endswitch
</header>
