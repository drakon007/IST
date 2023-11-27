<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;

class AnswerResource extends ModelResource
{
    protected string $model = Answer::class;

    protected string $title = 'answer';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Ответ','answer'),
                Text::make('Колонка интерпретации','column'),
                Number::make('Колличество баллов','balls'),
                ID::make('Индетификатор вопроса','question_id')
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
