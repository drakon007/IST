<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Test;

use MoonShine\Fields\Number;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Enum;

class TestResource extends ModelResource
{
    protected string $model = Test::class;

    protected string $title = 'Тесты';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Название', 'name')->hint('Название теста'),
                Number::make('Тип теста','type'),
                Enum::make('Статус','status'),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
