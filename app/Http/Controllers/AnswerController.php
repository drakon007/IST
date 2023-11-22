<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function createForQuestion($idQuestion, AnswerRequest $request)
    {
        try {
            $question = Question::find($idQuestion);
            if (!$question) {
                return view('answer.create')->
                with('err', "Вопрос к которому надо добавить ответ не найден");
            }

            $answer = Answer::make([
                "answer" => $request->answer,
                "column" => $request->column,
                "balls" => $request->balls,
                "question_id" => $question->id
            ]);
            $answer->save();

            session([
                'message' => 'Ответ добавлен'
            ]);

            $testId = $question->test->id;
            return redirect()->route('edit', $testId);

        } catch (\Throwable $th) {
            return response()->json([
                "error" => "Ответ не добавлен",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function addAnswer($idQuestion)
    {
        try {
            $question = Question::find($idQuestion);
            return view('answer.create')->
            with('question', $question)->
            with('err', false);
        } catch (\Throwable $th) {
            return response()->json([
                "error" => "Ответ не добавлен",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function update($idAnswer, Request $request)
    {
        try {
            $this->validate($request, [
                "answer" => ["required", "string"],
                "column" => ["required", "string"],
                "balls" => ["required", "int"],
            ]);

            $answer = Answer::find($idAnswer);
            if (!$answer) {
                return response()->json([
                    "error" => "Ответ не найден"
                ])->setStatusCode(400);
            }

            $answer->update([
                "answer" => $request->answer,
                "column" => $request->column,
                "balls" => $request->balls,
            ]);
            $answer->save();

            return response()->json([
                "message" => "Ответ к вопросу обновлен",
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "error" => "Ответ не обновлен",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function delete($idAnswer)
    {
        try {
            $answer = Answer::find($idAnswer);
            if (!$answer) {
                return response()->json([
                    "error" => "Ответ не найден"
                ])->setStatusCode(400);
            }
            $answer->delete();
            return response()->json([
                "message" => "ответ удален"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "error" => "",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function getForQuestion($idQuestion)
    {
        try {
            $question = Question::find($idQuestion);
            if (!$question) {
                return response()->json([
                    "error" => "вопрос не найден, ответы не предостовлены"
                ])->setStatusCode(400);
            }
            $answers = [];
            foreach ($question->answers as $answer) {
                array_push($answers, $answer);
            }

            return response()->json([
                "message" => "ответы получены",
                "array" => $answers,
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "error" => "Ответы для вопроса не получены",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }

}
