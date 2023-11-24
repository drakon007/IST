<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\AnswerUser;
use App\Models\Question;


class AnswerUserController extends Controller
{
    public function saveAnswerUser($idUser, Request $request)
    {
        try {
            if (!$request->idAnswer) {
                session([
                    'message' => "Выберите ответ"
                ]);
                return redirect()->back();
            }
            $answer = Answer::find($request->idAnswer);

            if(session('next') != 'home') {
                $answer->answerUsers()->attach($idUser);
                return redirect(session()->pull('next'));
            }
            $answer->answerUsers()->attach($idUser);
            $answerUser = AnswerUser::find($idUser);
            date_default_timezone_set('Asia/Irkutsk');
            $answerUser->update([
                'end_at' => date('Y-m-d H:i:s'),
                'status' => "passed"
            ]);
            $answerUser->save();
            session()->forget('answer_user_id');
            session([
                'message' => 'Тест завершен можно посмотреть результаты'
            ]);
            return redirect()->route('home');

        } catch (\Throwable $th) {
            return response()->json([
                "error" => "Ответы для вопроса не получены",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }

}
