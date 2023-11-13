{{--
$check - переменная, которая хранит в себе поле для проверки (используется для id, for, name)
$label - описание input и placeholder
$error - описание ошибки для поля input
--}}

<label class="block text-gray-700 text-sm font-bold mb-2" id="{{$check}}">{{$label}}</label>
<input
    class="shadow appearance-none border text-gray-700 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
    id="{{$check}}" name="{{$check}}" type="{{$check}}" placeholder="{{$label}}">
<p class="text-red-500 text-xs italic">{{$error}}</p>
