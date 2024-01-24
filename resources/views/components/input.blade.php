<div class="relative mb-6">
    <label
        for="{{ $name }}"
        class="text-xl ml-2"
    >{{ $placeholder }} </label>
    <input
        type="{{$type}}"
        class="mt-2 peer block appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error($name) is-invalid @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name) }}"
        placeholder="{{ $placeholder }}"/>
    @error($name)
    <p class="text-red-500 text-xs italic">Пожалуйста, проверьте это поле ({{$name}})</p>
    @enderror
</div>
