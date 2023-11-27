<?php

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
        $interpretations = Interpretation::all();

        if (count($interpretations) == 0) {
            return view('interpretation.render')
                ->with('interpretations', "интерпретаций нет");
        }

        return view('interpretation.render')
            ->with('interpretations', $interpretations);
    }

    public function getForTest($idTest)
    {
        try {
            $test = Test::find($idTest);
             if (!$test) {
                 return response()->json([
                     'errors' => "Такого теста не существует",
                 ])->setStatusCode(400);
             }

            $interpretations = [];
            foreach ($test->interpretations as $interpretation) {
                array_push($interpretations, $interpretation);
            }

            return view('interpretation.edit')->
            with('test', $test)->
            with('interpretations', $interpretations);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Интерпритаций для этого теста не получены",
                "descriptions" => $th
            ])->setStatusCode(400);
        }

    }

    public function createPage($idTest) {
        try {
            return view('interpretation.create')->
            with('id_test', $idTest)->
            with('err', false);
        } catch (\Throwable $th) {
            return response()->json([
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function createForTest($idTest, InterpretationRequest $request)
    {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                return response()->json([
                    'error' => "Теста не существует, к нему нельзя добавить интерпретацию"
                ])->setStatusCode(400);
            }
            $interpretations = Interpretation::make([
                'description' => $request->description,
                'min' => $request->min,
                'max' => $request->max,
                'column' => $request->column,
                'degree' => $request->degree,
            ]);
            $interpretations->save();
            $interpretations->tests()->attach($test->id);

            session([
                'message' => 'Интерпретация добавлена'
            ]);

            return redirect()->route('getForTestInter', $idTest);

        } catch (\Throwable $th) {
            return response()->json([
                'errors' => "Интерпритация не создана",
                "descriptions" => $th
            ])->setStatusCode(400);
        }

    }

    public function deleteForTestOne($idTest, $idInterpretation)
    {
        try {
            $test = Test::find($idTest);
            if (!$test) {
                return response()->json([
                    'error' => "Теста не существует"
                ])->setStatusCode(400);
            }
            $test->interpretations()->detach($idInterpretation);
            Interpretation::find($idInterpretation)->delete();
            session([
                'message' => 'Интерпретация удалена'
            ]);

            return redirect()->route('getForTestInter', $idTest);
        }catch (\Throwable $th) {
            return response()->json([
                'errors' => "Интерпритация не удалена",
                "descriptions" => $th
            ])->setStatusCode(400);
        }

    }

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
        }catch (\Throwable $th) {
            return response()->json([
                'errors' => "Интерпертации не удалены",
                "descriptions" => $th
            ])->setStatusCode(400);
        }

    }

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

    public function  addInterpretationForTest($idInterpretation, $idTest)
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

    public function getResults($idUser) {
        $user = User::find($idUser);
        $role = $user->roles[0]->name;
        if ($role == 'admin' || $role == 'psychologist') {
            $answerUsers = AnswerUser::where('end_at', '!=', null)->get();
            return view('test.results')->with('answerUsers', $answerUsers);
        } else {
            $answerUsers = AnswerUser::where('end_at', '!=', null)->where('user_id', $user->id)->get();
            return view('test.results')->with('answerUsers', $answerUsers);
        }
    }
}
