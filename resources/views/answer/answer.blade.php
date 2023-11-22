@foreach($answers as $answer)
    @if($answer->question_id == $question_id)
        <form method='POST' action="">

        </form>
        <div>
            <input type="radio" id="{{$loop->iteration}}" name="{{$question_id}}">
            <label class="w-8/12 break-all" for="{{$loop->iteration}}">{{$answer->answer}}</label>
        </div>
    @endif
@endforeach
