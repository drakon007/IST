<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Models\AnswerUser;
use App\Models\Interpretation;
use App\Models\Question;
use App\Models\Test;
use App\Models\Answer;

class TestController extends Controller
{
    public function startPage($idTest) {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                session(['error' => 'Данного теста не существует']);
                return redirect()->route('home');
            }
            return view('test.start')->with('test', $test);
        } catch (\Throwable $th) {
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }
    public function start($idTest, $idUser) {
        try {
            $oldTest = AnswerUser::where("end_at", null)->
            where("user_id", $idUser)->
            where("test_id", $idTest)->get();

            date_default_timezone_set('Asia/Irkutsk');
            $answerUser = AnswerUser::make([
                'test_id' => $idTest,
                'user_id' => $idUser,
                'start_at' => date('Y-m-d H:i:s')
            ]);
            $answerUser->save();
            session([
                'answer_user_id' => $answerUser->id,
            ]);
            return redirect()->route('getForTest', $idTest)->
            with('idAnswerUser', $answerUser->id)->
                with('oldTest', $oldTest);
        }catch (\Throwable $th) {
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }
    public function render() {
        try {
            $tests = Test::paginate(12);
            return view('test.home')
                ->with('tests', $tests);
        } catch (\Throwable $th) {
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
            // todo сделать страницу с ошибкой сервера
        }
    }
    public function edit($idTest) {
        try {
            $test = Test::find($idTest);
            return view('test.editing')
                ->with('test', $test);
        } catch (\Throwable $th) {
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }
    public function addTest() {
        try {
            return view('test.create')->
            with('err',false);
        } catch (\Throwable $th) {
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }
    public function create(TestRequest $request) {
        // обработка ошибок
        try {
            // проверка на повтор названия теста
            $candidates = Test::where('name', $request->name)->first();
            if ($candidates) {
                session(['error' => 'Тест с таким названием уже существует']);
                return redirect()->route('addTest');
            }

            // описание с trix
            $description = request('test-trixFields');
            $description = str_replace('localhost', '127.0.0.1:8000', $description['content']);

            // тип теста
            // todo сделать другие типы теста
            $type = 1;

            // создание теста
            $test = Test::make([
                'description' => $description,
                'type' => $type,
                'name' => $request->name,
            ]);
            $test->save();

            // сообщение пользователю об усрешном создании
            session([
                'message' => 'Тест добавлен'
            ]);

            // переадресация
            return redirect()->route('home');
        }catch(\Throwable $th) {
            session(['error'=>'Что-то пошло не так присоздании теста, обратитесь к системному администратору']);
            return redirect()->route('home');
        }

    }
    public function update($idTest, TestRequest $request) {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                session(['error'=>'Теста не существует']);
                return redirect()->route('home');
            }
            $test->update([
                'name' => $request->name,
            ]);
            $test->save();
            session([
                'message'=>'Тест обновлен'
            ]);
            return redirect()->route('edit', $test->id);
        }catch(\Throwable $th) {
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }
    public function updatePage($idTest) {
        try {
            $test = Test::find($idTest);
            return view('test.update')->
            with('test',$test)->
            with("err",false);
        } catch (\Throwable $th) {
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }
    public function delete($idTest) {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                session(['error'=>'Теста не существует, что-то пошло не так, обратитесь к системному администратору']);
                return redirect()->route('home');
            }

            $interpretations = Interpretation::where('test_id', $test->id)->get();
            if ($interpretations) {
                foreach ($interpretations as $interpretation) {
                    Interpretation::where('test_id', $test->id)->delete();
                    $interpretation->delete();
                }
            }

            $questions = Question::where('test_id', $test->id)->get();
            if ($questions) {
                foreach ($questions as $question) {
                    Answer::where('question_id', $question->id)->delete();
                    $question->delete();
                }
            }

            $test->delete();

            session([
                'message' => 'Тест удален'
            ]);
            return redirect()->route('home');
        }catch(\Throwable $th) {
            session(['error'=>'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }

}
