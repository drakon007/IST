<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use App\Models\AnswerUser;

class QuestionController extends Controller
{
    public function getForTest($idTest) {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                session(['error'=>'Теста не существует, что-то пошло не так, обратитесь к системному администратору']);
                return redirect()->route('home');
            }
            $questions = Question::where('test_id', $test->id)->paginate(1);

            return view('test.testing')
                ->with('questions', $questions)->with('err', false);
        } catch (\Throwable $th) {
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }

    public function createForTest($idTest, QuestionRequest $request) {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                session(['error'=>'Теста не существует, что-то пошло не так, обратитесь к системному администратору']);
                return redirect()->route('home');
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
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }
    public function updatePage($idQuestion) {
        try {
            $question = Question::find($idQuestion);
            return view('question.update')->
            with('question',$question)->
            with("err",false);

        } catch (\Throwable $th) {
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }

    public function update($idQuestion, QuestionRequest $request) {
        try {
            $question = Question::find($idQuestion);
            if (!$question) {
                session(['error'=>'Вопроса не существует, что-то пошло не так, обратитесь к системному администратору']);
                return redirect()->route('home');
            }
            $question->update([
               "question" => $request->question
            ]);
            $question->save();
            session([
                "message" => "Вопрос изменен"
            ]);
            $test_id = $question->test->id;
            return redirect()->route('edit', $test_id);
        } catch (\Throwable $th) {
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }

    public function delete($idQuestion,) {
        try {
            $question = Question::find($idQuestion);
            if (!$question) {
                session(['error'=>'Вопроса не существует, что-то пошло не так, обратитесь к системному администратору']);
                return redirect()->route('home');
            }
            Answer::where('question_id', $question->id)->delete();
            $test_id = $question->test->id;
            $question->delete();
            session([
                'message' => 'Вопрос удален'
            ]);
            return redirect()
                ->route('edit', $test_id);
        } catch (\Throwable $th) {
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }

    public function addQuestion ($idTest, Request $request) {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                session(['error'=>'Теста не существует, что-то пошло не так, обратитесь к системному администратору']);
                return redirect()->route('home');
            }
            return view('question.create')->
                with('err',false)->
                with('test', $test);
        } catch (\Throwable $th) {
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }

}
