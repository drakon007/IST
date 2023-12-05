<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Http\Requests\InterpretationRequest;
use Illuminate\Http\Request;
use App\Models\Interpretation;
use App\Models\Test;
use App\Models\User;
use App\Models\AnswerUser;
use Illuminate\Support\Facades\DB;

class InterpretationController extends Controller
{
    public function render()
    {
        try {
            $interpretations = Interpretation::all();

            if (count($interpretations) == 0) {
                return view('interpretation.render')
                    ->with('interpretations', "интерпретаций нет");
            }

            return view('interpretation.render')
                ->with('interpretations', $interpretations);
        } catch (\Throwable $th) {
            session(['error' => 'Тест не завершен, что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }

    public function getForTest($idTest)
    {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                session(['error' => 'Тест не найден']);
                return redirect()->route('home');
            }
            $interpretations = Interpretation::where('test_id', $test->id)->get();
            return view('interpretation.edit')->
            with('test', $test)->
            with('interpretations', $interpretations);
        } catch (\Throwable $th) {
            session(['error' => 'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }

    }

    public function createPage($idTest)
    {
        try {
            return view('interpretation.create')->
            with('id_test', $idTest);
        } catch (\Throwable $th) {
            session(['error' => 'что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }

    public function createForTest($idTest, InterpretationRequest $request)
    {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                session(['error' => 'Интерпретация не добавлена, что-то пошло не так, обратитесь к системному администратору']);
                return redirect()->route('home');
            }
            $candidate = Interpretation::where('column', $request->column)->first();
            if ($candidate) {
                session(['error' => "Интерпретация с столбцом '$request->column' уже существует"]);
                return redirect()->route('createPageInter', $idTest);
            }
            $interpretation = Interpretation::make([
                'description' => $request->description,
                'min' => $request->min,
                'max' => $request->max,
                'column' => $request->column,
                'test_id' => $test->id
            ]);
            $interpretation->save();
            session([
                'message' => 'Интерпретация добавлена'
            ]);
            return redirect()->route('getForTestInter', $idTest);
        } catch (\Throwable $th) {
            session(['error' => 'Тест не добавлен, что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }

    }

    public function deleteForTestOne($idTest, $idInterpretation)
    {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                session(['error' => 'Тест не существует, что-то пошло не так, обратитесь к системному администратору']);
                return redirect()->route('home');
            }
            Interpretation::find($idInterpretation)->delete();
            session([
                'message' => 'Интерпретация удалена'
            ]);
            return redirect()->route('getForTestInter', $idTest);
        } catch (\Throwable $th) {
            session(['error' => 'Тест не удален, что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }

    }

    public function getResults($idUser)
    {
        $user = User::find($idUser);
        $role = $user->roles[0]->name;
        if ($role == 'admin' || $role == 'psychologist') {
            $answerUsers = AnswerUser::where('end_at', '!=', null)->get();
        } else {
            $answerUsers = AnswerUser::where('end_at', '!=', null)->where('user_id', $user->id)->get();
        }
        $interpretations = [];
        foreach ($answerUsers as $answer) {
            $columnBalls = DB::table('answer_users')->
            join('answer_answer_user as aau', 'answer_users.id', '=', 'aau.answer_user_id')->
            join('answers as a', 'aau.answer_id', '=', 'a.id')->
            select('column', DB::raw('count(balls) as balls'))->
            where('answer_user_id', '=', $answer->id)->groupBy('column')->get();

            $arrayBall=[];
            foreach ($columnBalls as $all) {
                array_push($arrayBall, $all->balls);
            }
            $maxBall = max($arrayBall);

            foreach ($columnBalls as $all) {
                if ($all->balls == $maxBall) {
                    array_push($interpretations, [$answer->end_at => Interpretation::where('test_id', $answer->test_id)->where('column', $all->column)->first()]);
                }
            }
        }
        return view('test.results')->with(['answerUsers' => $answerUsers, 'interpretations' => $interpretations]);
    }

    // no use function перед использованием добавить обработчик ошибок
    public function deleteForTestAll($idTest)
    {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                return response()->json([
                    'error' => "Теста не существует"
                ])->setStatusCode(400);
            }
            $test->interpretations()->detach();

            return response()->json([
                'message' => "все интерпертации удалены",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Интерпертации не удалены",
                "descriptions" => $th
            ])->setStatusCode(400);
        }

    }

    // no use function перед использованием добавить обработчик ошибок
    public function update($idInterpretation, Request $request)
    {
        try {
            $this->validate($request, [
                "description" => ['required', 'string'],
                "min" => ['required', 'integer'],
                "max" => ['required', 'integer'],
            ]);

            $interpretation = Interpretation::find($idInterpretation);
            if (!$interpretation) {
                return response()->json([
                    'error' => "Интерпретации не существует"
                ])->setStatusCode(400);
            }

            $interpretation->update([
                'description' => $request->description,
                'min' => $request->min,
                'max' => $request->max
            ]);
            $interpretation->save();

            return response()->json([
                'message' => "интерпертация обновлена",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Интерпритация не создана",
                "descriptions" => $th
            ])->setStatusCode(400);
        }
    }

    // no use function перед использованием добавить обработчик ошибок
    public function addInterpretationForTest($idInterpretation, $idTest)
    {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                return response()->json([
                    'error' => "Теста не существует, к нему нельзя добавить интерпретацию"
                ])->setStatusCode(400);
            }
            $interpretation = Interpretation::find($idInterpretation);
            if (!$interpretation) {
                return response()->json([
                    'error' => "Интерпретации не существует"
                ])->setStatusCode(400);
            }
            $interpretation->tests()->attach($test->id);

            return response()->json([
                'message' => "Интерпретация добавлена к тесту"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Интерпритация не добвалена",
                "descriptions" => $th
            ])->setStatusCode(400);
        }


    }
}
