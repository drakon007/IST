<header>
    <ul class="flex">
        <li class="flex-1 mr-2">
            <a class="text-center block border border-white rounded hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-2 px-4"
               href="{{route('home')}}" onclick="onbeunload(true)" >Выбор теста</a>
        </li>
        <li class="flex-1 mr-2">
            <a class="text-center block border border-white rounded hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-2 px-4"
               href="{{route('results', session('id'))}}" onclick="onbeunload(true)" >Просмотрель результаты</a>
        </li>
        <li class="text-right">
            <a class="py-2 px-2 text-gray-400  block" href="#">{{session('fio')}}</a>
        </li>
        <li class="text-right">
            <a href="{{route('logout')}}" onclick="onbeunload(true)" class=" block text-blue-500 hover:border-blue-500 py-2 px-2  hover:bg-gray-200 rounded">Выйти</a>
        </li>
    </ul>
</header>
