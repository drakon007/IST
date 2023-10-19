<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function render() {
        $tests = Test::all();
        return view('test.render')
            ->with('tests', $tests);
    }

    public function create(request $request) {
        try {
            $this->validate($request, [
                'type'=> ['required', 'integer', 'max:200'],
                'name'=>['required', 'string', 'max:200'],
            ]);

            $candidates = Test::where('name', $request->name)->first();
            if ($candidates) {
                return response()->json([
                    'errors'=>"Тест уже существует",
                ])->setStatusCode(400);
            }

            $test = Test::make([
                'type' => $request->type,
                'name' => $request->name,
                'status' => 'active'
            ]);
            $test->save();

            return response()->json([
                'message' => 'Тест создан'
            ]);
        }catch(\Throwable $th) {
            return response()->json([
                'errors'=>'Тест не добавлен',
                'descriptions'=>$th
                ])->setStatusCode(400);
        }

    }

}
