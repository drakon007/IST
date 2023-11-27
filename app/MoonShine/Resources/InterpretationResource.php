<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Interpretation;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;

class InterpretationResource extends ModelResource
{
    protected string $model = Interpretation::class;

    protected string $title = 'Интерпретации';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Описание интерпретации','description'),
                Number::make('Минимальное колов баллов','min'),
                Number::make('Максимальное колов баллов','max'),
                Text::make('Колонка с баллами','column'),
                Text::make('Степень','degree')
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
