@if (session('role') == 'user')
    @php
        abort(404);
    @endphp
@endif
