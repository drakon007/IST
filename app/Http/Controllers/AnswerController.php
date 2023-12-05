<?php

namespace App\Http\Controllers;
use App\Http\Requests\AnswerRequest;
use App\Models\Interpretation;
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
            $idTest = $question->test->id;
            $interpretation = Interpretation::where('column', $request->column)->first();
            if (!$interpretation) {
                session(['error'=>"Ответ не добавлен, интерпретации со столбцом {$request->column} не существует"]);
                return redirect()->route('edit', $idTest);
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
            return redirect()->route('edit', $idTest);
        } catch (\Throwable $th) {
            session(['error'=>'Ответ не добавлен, что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }

    public function addAnswer($idQuestion)
    {
        try {
            $question = Question::find($idQuestion);
            return view('answer.create')->
            with('question', $question);
        } catch (\Throwable $th) {
            session(['error'=>'Ответ не добавлен, что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }

    // no use function перед добавлением отредактировать обработчик ошибок
    public function update($idAnswer, AnswerRequest $request)
    {
        try {
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
    // no use function перед добавлением отредактировать обработчик ошибок
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
    // no use function перед добавлением отредактировать обработчик ошибок
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
