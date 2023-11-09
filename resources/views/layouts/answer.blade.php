{{--todo $answers = array
--}}

@foreach($answers as $answer)
    <div>
        <input type="radio" id="{{$loop->iteration}}" name="answer">
        <label for="{{$loop->iteration}}">{{$answer->answer}}</label>
    </div>
@endforeach
