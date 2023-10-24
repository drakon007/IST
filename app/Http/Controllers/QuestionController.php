<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Question;
class QuestionController extends Controller
{
    public function getForTest($idTest) {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                return response()->json([
                    "error" => 'Теста не существует',
                ])->setStatusCode(400);
            }

            $questions = [];
            foreach ($test->questions as $question) {
                array_push($questions, $question);
            }

            return response()->json([
                "messages" => "вопросы получены",
                "questions" => $questions
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "",
                "descriptions" => $th
            ])->setStatusCode(400);
        }
    }

    public function createForTest($idTest, Request $request) {
        try {
            $this->validate($request, [
                "question" => ['required','string'],
            ]);

            $test = Test::find($idTest);
            if (!$test) {
                return response()->json([
                    "error" => 'Теста не существует',
                ])->setStatusCode(400);
            }

            $question = Question::make([
                "question" => $request->question,
                "test_id" => $idTest,
            ]);
            $question->save();

            return response()->json([
                 "message" => "Вопрос добавлен к тесту"
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "",
                "descriptions" => $th
            ])->setStatusCode(400);
        }
    }

    public function updateForTest($idTest, Request $requestv) {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                return response()->json([
                    "error" => 'Теста не существует',
                ])->setStatusCode(400);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "",
                "descriptions" => $th
            ])->setStatusCode(400);
        }
    }

    public function deleteForTest($idTest) {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                return response()->json([
                    "error" => 'Теста не существует',
                ])->setStatusCode(400);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "",
                "descriptions" => $th
            ])->setStatusCode(400);
        }
    }

}
