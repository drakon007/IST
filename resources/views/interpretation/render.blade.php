<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Interpretation</title>
</head>
<body>
    @if (gettype($interpretations) == 'array')
        @foreach ($interpretations as $interpretation)
        <h1>{{$interpretation}}</h1>
        @endforeach
    @else
        <h1>{{$interpretations}}</h1>
    @endif
</body>
</html>