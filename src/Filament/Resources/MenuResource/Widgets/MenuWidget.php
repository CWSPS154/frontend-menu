<?php

/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

namespace CWSPS154\FrontendMenu\Filament\Resources\MenuResource\Widgets;

use CWSPS154\FrontendMenu\Models\Menu;
use Filament\Forms\Components\TextInput;
use SolutionForest\FilamentTree\Components\Tree;
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
                ->label(__('frontend-menu::menu.title')),
            TextInput::make('url')
                ->label(__('frontend-menu::menu.url'))
                ->required()
                ->maxLength(255),
        ];
    }

    public function getTreeTitle(): ?string
    {
        return __('frontend-menu::menu.widget.menu');
    }

    protected function hasDeleteAction(): bool
    {
        return $this->getResource()::checkAccess('getCanDelete');
    }

    public function hasEditAction(): bool
    {
        return $this->getResource()::checkAccess('getCanEdit');
    }

    public static function getMaxDepth(): int
    {
        return config('frontend-menu.max-depth', 2);
    }

    public static function getResource(): string
    {
        return config('frontend-menu.menu-resource');
    }

    public function getTree(): Tree
    {
        $this->dispatch('refreshTable');

        return parent::getTree();
    }
}
