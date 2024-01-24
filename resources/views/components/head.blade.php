<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>{{$namePage}}</title>
@trixassets
@vite('resources/css/app.css')
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- todo проверить стили без относительных ссылок --}}
{{--<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">--}}
{{--<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>--}}
