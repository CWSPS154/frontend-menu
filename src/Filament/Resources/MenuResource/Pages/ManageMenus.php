<?php
/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

namespace CWSPS154\FilamentFrontendMenu\Filament\Resources\MenuResource\Pages;

use CWSPS154\FilamentFrontendMenu\Filament\Resources\MenuResource;
use CWSPS154\FilamentFrontendMenu\Filament\Resources\MenuResource\Widgets\MenuWidget;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\Support\Htmlable;

class ManageMenus extends ManageRecords
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            MenuWidget::class
        ];
    }

    public function updated($name)
    {
        $this->dispatch('updateMenuWidget');
    }

    public function getTitle(): string|Htmlable
    {
        return __(config('filament-frontend-menu.navigation.title'));
    }
}
