<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\AnswerResource;
use App\MoonShine\Resources\InterpretationResource;
use App\MoonShine\Resources\QuestionResource;
use App\MoonShine\Resources\TestResource;
use App\MoonShine\Resources\UserResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [];
    }

    protected function pages(): array
    {
        return [];
    }

    protected function menu(): array
    {
        return [
            MenuGroup::make('Администраторы', [
               MenuItem::make(
                   'Администраторы',
                   new MoonShineUserResource()
               ),
//               MenuItem::make(
//                   static fn() => __('moonshine::ui.resource.role_title'),
//                   new MoonShineUserRoleResource()
//               ),
            ])->icon('heroicons.outline.at-symbol'),

            MenuGroup::make('Тесты',[
                MenuItem::make('Тесты', new TestResource())->icon('heroicons.rectangle-stack'),
                MenuItem::make('Вопросы', new QuestionResource())->icon('heroicons.question-mark-circle'),
                MenuItem::make('Ответы', new AnswerResource())->icon('heroicons.arrow-down-on-square-stack'),
                MenuItem::make('Интерпретации', new InterpretationResource())->icon('heroicons.arrow-up-on-square-stack'),
            ])->icon('heroicons.clipboard-document-list'),

            MenuGroup::make('Пользователи', [
                MenuItem::make('Пользователи', new UserResource())->icon('heroicons.user'),
            ])->icon('heroicons.user-group'),
        ];
    }

    /**
     * @return array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
