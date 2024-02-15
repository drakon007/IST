<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\AnswerUser;
use Illuminate\Support\Facades\DB; // todo сделать обновление вопросов если пользователь выбрал другой, возможность продолжить тест


class AnswerUserController extends Controller
{
    public function saveAnswerUser($idAnswerUser, Request $request)
    {
        // Обработчик ошибок
        try {
            // проверка выбора ответа пользователем
            if (!$request->idAnswer) {
                session([
                    'error' => "Выберите ответ"
                ]);
                return redirect()->back();
            }
            $answer = Answer::find($request->idAnswer);

            // переадресация на следующий вопрос если он есть
            if(session('next') != 'home') {
                // добавление ответа пользователя
                $answer->answerUsers()->attach($idAnswerUser);
                // переадресация
                return redirect(session()->pull('next'));
            }

            // добавление ответа пользователя
            $answer->answerUsers()->attach($idAnswerUser);
            $answerUser = AnswerUser::find($idAnswerUser);

            // установка часового пояса
            date_default_timezone_set('Asia/Irkutsk');

            // сохрание ответа пользователя (попытки)
            $answerUser->update([
                'end_at' => date('Y-m-d H:i:s'),
                'status' => "passed"
            ]);
            $answerUser->save();

            // удаление из сессии ключа
            session()->forget('answer_user_id');
            session([
                'message' => 'Тест завершен можно посмотреть результаты'
            ]);

            // переадресация
            return redirect()->route('home');

        } catch (\Throwable $th) {
            session(['error'=>'Тест не завершен, что-то пошло не так, обратитесь к системному администратору']);
            return redirect()->route('home');
        }
    }
}
