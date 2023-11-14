{{--
$check - переменная, которая хранит в себе поле для проверки (используется для id, for, name)
$label - описание input и placeholder
--}}

<div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="{{$check}}">{{$label}}</label>
    <input
        class="shadow appearance-none border text-gray-700 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
        id="{{$check}}" name="{{$check}}" type="{{$check}}" placeholder="{{$label}}">
</div>

@error({{$check}})
<div class="alert alert-danger">{{ $message }}</div>
@enderror

