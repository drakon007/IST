<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function createForQuestion($idQuestion, Request $request) {
           try {
            $this->validate($request, [
                "answer"=> ["required", "string"],
                "column"=> ["required", "string"],
                "balls"=> ["required", "int"],
            ]);

            $question = Question::find($idQuestion);
            if(!$question) {
                return response()->json([
                    "error"=>"Вопрос к которому надо добавить ответ не найден"
                ])->setStatusCode(400);
            }

            $answer = Answer::make([
                "answer"=>$request->answer,
                "column"=>$request->column,
                "balls"=>$request->balls,
                "question_id"=>$question->id
            ]);
            $answer->save();

            return response()->json([
                "message"=>"Ответ добавлен к вопросу",
            ]);

        } catch (\Throwable $th) {
            return response()->json([
               "error" => "Ответ не добавлен",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }
    public function update($idAnswer, Request $request) {
        try {
            $this->validate($request, [
                "answer"=> ["required", "string"],
                "column"=> ["required", "string"],
                "balls"=> ["required", "int"],
            ]);

            $answer = Answer::find($idAnswer);
            if(!$answer) {
                return response()->json([
                    "error"=>"Ответ не найден"
                ])->setStatusCode(400);
            }

            $answer->update([
                "answer"=>$request->answer,
                "column"=>$request->column,
                "balls"=>$request->balls,
            ]);
            $answer->save();

            return response()->json([
                "message"=>"Ответ к вопросу обновлен",
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "error" => "Ответ не обновлен",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function delete($idAnswer) {
        try {
            $answer = Answer::find($idAnswer);
            if(!$answer) {
                return response()->json([
                    "error"=>"Ответ не найден"
                ])->setStatusCode(400);
            }
            $answer->delete();
            return response()->json([
                "message"=>"ответ удален"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "error" => "",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function getForQuestion($idQuestion) {
        try {
         $question = Question::find($idQuestion);
         if(!$question) {
             return response()->json([
                 "error"=> "вопрос не найден, ответы не предостовлены"
             ])->setStatusCode(400);
         }
         $answers =[];
         foreach ($question->answers as $answer) {
             array_push($answers,$answer);
         }

         return response()->json([
             "message" => "ответы получены",
             "array"=> $answers,
         ]);

        } catch (\Throwable $th) {
            return response()->json([
                "error" => "Ответы для вопроса не получены",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }
}
