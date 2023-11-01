<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function createForQuestion($idQuestion, Request $request) {
        try {
            $this->validate($request, [
                "answer"=> ["required", "string"]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
               "error" => "",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }
    public function update($idAnswer, Request $request) {
        try {

        } catch (\Throwable $th) {
            return response()->json([
                "error" => "",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function delete($idAnswer) {
        try {

        } catch (\Throwable $th) {
            return response()->json([
                "error" => "",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function getForQuestion($idQuestion) {
        try {

        } catch (\Throwable $th) {
            return response()->json([
                "error" => "",
                "description" => $th->getMessage()
            ])->setStatusCode(400);
        }
    }
}
