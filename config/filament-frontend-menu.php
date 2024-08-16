<?php
/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

return [
    'layout' => null,
    'cluster' => null,
    'navigation' => [
        'group' => 'filament-frontend-menu::menu.content',
        'label' => 'filament-frontend-menu::menu.menu',
        'icon' => 'heroicon-o-queue-list',
        'sort' => 100,
    ],
    'widget' => [
        'label' => 'filament-frontend-menu::menu.widget.menu',
        'max-depth' => 2,
    ]
];
