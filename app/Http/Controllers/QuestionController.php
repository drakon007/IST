<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
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
//            todo узнать, через модель или связь
//            $questions = [];
//            foreach ($test->questions as $question) {
//                array_push($questions, $question);
//            }

            $questions = Question::where('test_id', $test->id)->paginate(1);

            return view('test.testing')
                ->with('questions', $questions);

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "вопросы не получены",
                "descriptions" => $th
            ])->setStatusCode(400);
        }
    }

    public function createForTest($idTest, QuestionRequest $request) {
        try {
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

            session([
               "message" => "Вопрос добавлен"
            ]);

            return redirect()->route('edit', $test->id);

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
            $answers = $question->answers();
            foreach ($answers as $answer) {
                $answer->delete();
            }
            $test_id = $question->test->id;
            $question->delete();

            session([
                'message' => 'Вопрос удален'
            ]);

            return redirect()
                ->route('edit', $test_id);

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Вопрос не удален",
                "descriptions" => $th
            ])->setStatusCode(400);
        }
    }

    public function addQuestion ($idTest, Request $request) {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                return response()->json([
                    "error" => 'Теста не существует',
                ])->setStatusCode(400);
            }

            return view('question.create')->
                with('err',false)->
                with('test', $test);

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "вопросы не получены",
                "descriptions" => $th
            ])->setStatusCode(400);
        }
    }

}
