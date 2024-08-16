<?php
/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

namespace CWSPS154\FilamentFrontendMenu\Filament\Resources\MenuResource\Widgets;

use CWSPS154\FilamentFrontendMenu\Filament\Resources\MenuResource;
use CWSPS154\FilamentFrontendMenu\Models\Menu;
use Filament\Forms\Components\TextInput;
use SolutionForest\FilamentTree\Widgets\Tree as BaseWidget;

class MenuWidget extends BaseWidget
{
    protected static string $model = Menu::class;

    protected bool $enableTreeTitle = true;

    protected $listeners = ['updateMenuWidget' => '$refresh'];

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->required()
                ->label(__('filament-frontend-menu::menu.title'))
        ];
    }

    /**
     * @return string|null
     */
    public function getTreeTitle(): ?string
    {
        return __(config('filament-frontend-menu.widget.label'));
    }

    protected function hasDeleteAction(): bool
    {
        return MenuResource::checkAccess('getCanDelete');
    }

    public function hasEditAction(): bool
    {
        return MenuResource::checkAccess('getCanEdit');
    }

    public static function getMaxDepth(): int
    {
        return config('filament-frontend-menu.widget.max-depth');
    }
}
