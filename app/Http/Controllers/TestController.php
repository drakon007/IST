<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Models\AnswerUser;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Answer;
use App\Models\Interpretation;

class TestController extends Controller
{
    public function startPage($idTest) {
        try {
            return view('test.start')->with('idTest', $idTest);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "вопросы не получены",
                "descriptions" => $th
            ])->setStatusCode(400);
        }
    }
    public function start($idTest, $idUser) {
        try {
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
            return redirect()->route('getForTest', $idTest)->with('idAnswerUser', $answerUser->id);
        }catch (\Throwable $th) {
            return response()->json([
                'errors' => "вопросы не получены",
                "descriptions" => $th
            ])->setStatusCode(400);
        }
    }
    public function render() {
        try {
            $tests = Test::paginate(12);
            return view('test.home')
                ->with('tests', $tests);
        } catch (\Throwable $th) {
            return response()->json([
                "description" => $th
            ]);
        }
    }
    public function edit($idTest) {
        try {
            $test = Test::find($idTest);
            return view('test.editing')
                ->with('test', $test);
        } catch (\Throwable $th) {
            return response()->json([
                "description" => $th
            ]);
        }
    }
    public function addTest() {
        try {
            return view('test.create')->
            with('err',false);
        } catch (\Throwable $th) {
            return response()->json([
                "description" => $th
            ]);
        }
    }
    public function create(TestRequest $request) {
        try {
            $candidates = Test::where('name', $request->name)->first();
            if ($candidates) {
                return view('test.create')->
                with('err', "Тест уже существует");
            }

            $test = Test::make([
                'type' => $request->type,
                'name' => $request->name,
            ]);
            $test->save();

            session([
                'message' => 'Тест добавлен'
            ]);

            return redirect()->route('home');
        }catch(\Throwable $th) {
            return response()->json([
                'errors'=>'Тест не добавлен',
                'descriptions'=>$th
                ])->setStatusCode(400);
        }

    }
    public function update($idTest, TestRequest $request) {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                return response()->json([
                    'errors'=>"Теста не существует",
                ])->setStatusCode(400);
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
            return response()->json([
                'errors'=>'Тест не обновлен',
                'descriptions'=>$th
            ])->setStatusCode(400);
        }
    }
    public function updatePage($idTest) {
        try {
            $test = Test::find($idTest);
            return view('test.update')->
            with('test',$test)->
            with("err",false);

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "",
                "descriptions" => $th
            ])->setStatusCode(400);
        }
    }
    public function delete($idTest) {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                return response()->json([
                    'errors'=>"Теста не существует",
                ])->setStatusCode(400);
            }
            $questions = Question::where('test_id', $test->id)->get();
            if ($questions) {
                foreach ($questions as $question) {
                    Answer::where('question_id', $question->id)->delete();
                    $question->delete();
                }
            }
            $test->interpretations()->detach();
            $test->delete();

            session([
                'message' => 'Тест удален'
            ]);

            return redirect()->route('home');
        }catch(\Throwable $th) {
            return response()->json([
                'errors'=>'Тест не удален',
                'descriptions'=>$th
            ])->setStatusCode(400);
        }
    }

}
