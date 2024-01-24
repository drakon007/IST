@if (session()->has('message'))
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div>
            <p class="text-sm">{{session()->pull('message')}}</p>
        </div>
    </div>
@endif
