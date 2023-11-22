<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;
use App\Models\Result;

class ResultController extends Controller
{
    public function saveAnswer($idAnswer, $idUser)
    {
        $answerUser = Answer::find($idAnswer);
        $test = $answerUser->question->test;
        $user = User::find($idUser);
        $questions =  Question::where('test_id', $test->id)->get();

        if(Result::where('user_id',$idUser)) {

        }

        $result = Result::make([

        ]);

//        $prevAnswersUser = [];
//
//        foreach ($user->)
//
//        if()

    }
}
