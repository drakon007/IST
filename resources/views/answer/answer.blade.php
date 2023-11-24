@foreach($answers as $answer)
    @if($answer->question_id == $question_id)
            <div>
                <input type="radio" id="{{$loop->iteration}}" name="idAnswer" value="{{$answer->id}}">
                <label class="w-8/12 break-all" for="{{$loop->iteration}}">{{$answer->answer}}</label>
            </div>
    @endif
@endforeach
