<?php
/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

use CWSPS154\FilamentFrontendMenu\Models\Menu;

if (!function_exists('get_menus')) {
    function get_menus()
    {
        return Menu::where('status', true)->where('parent_id', -1)->with('children')->orderBy('order')->get();
    }
}
