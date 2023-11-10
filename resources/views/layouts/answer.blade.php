@foreach($answers as $answer)
    @if($answer->question_id == $question_id)
        <div>
            <input type="radio" id="{{$loop->iteration}}" name="{{$question_id}}">
            <label for="{{$loop->iteration}}">{{$answer->answer}}</label>
        </div>
    @endif
@endforeach
