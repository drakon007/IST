<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Status;

class TestController extends Controller
{
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

            $status = Status::where('status', 'active')->first();
            $test = Test::make([
                'type' => $request->type,
                'name' => $request->name,
                'status_id' => $status->id
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

    public function update($idTest, Request $request) {
        try {
            $this->validate($request, [
                'name'=>['required', 'string', 'max:200'],
            ]);

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

            return response()->json([
                'message'=>'Тест обновлен'
            ]);
        }catch(\Throwable $th) {
            return response()->json([
                'errors'=>'Тест не обновлен',
                'descriptions'=>$th
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
            $test->interpretations()->detach();
            $test->delete();

            return response()->json([
                'message'=>"Теста удален",
            ]);
        }catch(\Throwable $th) {
            return response()->json([
                'errors'=>'Тест не удален',
                'descriptions'=>$th
            ])->setStatusCode(400);
        }
    }
}
