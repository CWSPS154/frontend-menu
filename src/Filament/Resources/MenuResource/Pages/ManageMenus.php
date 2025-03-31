<?php

/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

namespace CWSPS154\FrontendMenu\Filament\Resources\MenuResource\Pages;

use CWSPS154\FrontendMenu\Filament\Resources\MenuResource\Widgets\MenuWidget;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\Support\Htmlable;

class ManageMenus extends ManageRecords
{
    protected $listeners = ['refreshTable' => '$refresh'];

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            MenuWidget::class,
        ];
    }

    public function updated($name)
    {
        $this->dispatch('updateMenuWidget');
    }

    public function getTitle(): string|Htmlable
    {
        return __('frontend-menu::menu.menu');
    }

    public static function getResource(): string
    {
        return static::$resource = config('frontend-menu.menu-resource');
    }
}
