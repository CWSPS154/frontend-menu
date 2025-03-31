<?php

/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

use CWSPS154\FrontendMenu\FrontendMenuServiceProvider;
use CWSPS154\FrontendMenu\Models\Menu;
use Filament\Facades\Filament;

$panel_ids = [];

foreach (Filament::getPanels() as $panel) {
    if ($panel->hasPlugin(FrontendMenuServiceProvider::$name)) {
        $panel_ids[] = $panel->getId();
    }
}

return [
    Menu::MENU => [
        'name' => 'Menu',
        'panel_ids' => $panel_ids,
        'route' => null,
        'status' => true,
        'children' => [
            Menu::VIEW_MENU => [
                'name' => 'View Menu',
                'panel_ids' => $panel_ids,
                'route' => 'resources.menus.index',
                'status' => true,
            ],
            Menu::CREATE_MENU => [
                'name' => 'Create Menu',
                'panel_ids' => $panel_ids,
                'route' => null,
                'status' => true,
            ],
            Menu::EDIT_MENU => [
                'name' => 'Edit Menu',
                'panel_ids' => $panel_ids,
                'route' => null,
                'status' => true,
            ],
            Menu::DELETE_MENU => [
                'name' => 'Delete Menu',
                'panel_ids' => $panel_ids,
                'route' => null,
                'status' => true,
            ],
        ],
    ],
];
