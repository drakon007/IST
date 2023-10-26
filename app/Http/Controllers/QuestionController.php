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
                'errors' => "вопросы не получены",
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
                "test_id" => $test->id,
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

    public function update($idQuestion, Request $request) {
        try {

            $this->validate($request, [
                "question" => ['required','string'],
            ]);

            $question = Question::find($idQuestion);

            if (!$question) {
                return response()->json([
                    "error" => 'Данного вопроса для теста не существует',
                ])->setStatusCode(400);
            }

            $question->update([
               "question" => $request->question
            ]);
            $question->save();

            return response()->json([
                "message" => "Вопрос был изменен",
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Вопрос не изменен, проверьте правильность вопроса",
                "descriptions" => $th
            ])->setStatusCode(400);
        }
    }

    public function delete($idQuestion,) {
        try {
            $question = Question::find($idQuestion);
            if (!$question) {
                return response()->json([
                    "error" => 'Вопроса не существует',
                ])->setStatusCode(400);
            }

            $question->delete();

            return response()->json([
                'message' => "Вопрос удален",
            ])->setStatusCode(400);

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Вопрос не удален",
                "descriptions" => $th
            ])->setStatusCode(400);
        }
    }

}
