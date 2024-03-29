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
        // обработка ошибок
        try {
            // проверка существования вопроса
            $question = Question::find($idQuestion);
            if (!$question) {
                session(['error' => 'Ответ не добавлен, вопрос не найден']);
                return redirect()->route('home');
            }
            // получение id теста через связи
            $idTest = $question->test->id;
            // создание ответа
            $answer = Answer::make([
                "answer" => $request->answer,
                "column" => $request->column,
                "balls" => $request->balls,
                "question_id" => $question->id
            ]);
            $answer->save();
            // сообщение об успешном добавлении
            session([
                'message' => 'Ответ добавлен'
            ]);
            // переадресация
            return redirect()->route('edit', $idTest);
        } catch (\Throwable $th) {
            session(['error'=>'Ответ не добавлен, что-то пошло не так при создании ответа к вопросу, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }

    public function addAnswer($idQuestion)
    {
        // обработка ошибок
        try {
            // получение вопроса
            $question = Question::find($idQuestion);
            // получение id теста через связи
            $idTest = $question->test->id;
            // получение интерпретаций для текущего теста
            $interpretations = Interpretation::where('test_id', $idTest)->get();
            // переадресация
            return view('answer.create')->
            with('question', $question)->
            with('interpretations', $interpretations);
        } catch (\Throwable $th) {
            session(['error'=>'Страница для добавления ответа к вопросу не отобразилась, что-то пошло не так, обратитесь к системному администратору']);
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
        // обработчик ошибок
        try {
            // проверка существования вопроса
            $question = Question::find($idQuestion);
            if (!$question) {
                return response()->json([
                    "error" => "вопрос не найден, ответы не предостовлены"
                ])->setStatusCode(400);
            }

            // массив ответов для вопроса
            $answers = [];
            foreach ($question->answers as $answer) {
                array_push($answers, $answer);
            }

            // переадресация
            return response()->json([
                "message" => "ответы получены",
                "array" => $answers,
            ]);
        } catch (\Throwable $th) {
            session(['error'=>'Вопросы для ответа не получены, что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }

}
