
# Filament Frontend Menu

A filament package for updating frontend page menu's

## Installation

Install Using Composer

```shell
composer require cwsps154/frontend-menu
```
Run

```shell
php artisan frontend-menu:install
```

## Usage/Examples

Add this into your Filament `PannelProvider` class `panel()`
```php
use CWSPS154\FrontendMenu\FrontendMenuPlugin;

$panel->plugins([FrontendMenuPlugin::make()]);
```

You can limit the access to the resources
```php
use CWSPS154\FrontendMenu\FrontendMenuPlugin;

FrontendMenuPlugin::make()
    ->canViewAny(function () {
        return true;
    })
    ->canCreate(function () {
        return true;
    })
    ->canEdit(function () {
        return true;
    })
    ->canDelete(function () {
        return true;
    })
```

If you are using `cwsps154/users-roles-permissions` plugin you can use like this

```php
use CWSPS154\FrontendMenu\Models\Menu;
use CWSPS154\FrontendMenu\FrontendMenuPlugin;
use CWSPS154\UsersRolesPermissions\UsersRolesPermissionsServiceProvider;

FrontendMenuPlugin::make()
    ->canViewAny(UsersRolesPermissionsServiceProvider::HAVE_ACCESS_GATE, Menu::VIEW_MENU)
    ->canCreate(UsersRolesPermissionsServiceProvider::HAVE_ACCESS_GATE, Menu::CREATE_MENU)
    ->canEdit(UsersRolesPermissionsServiceProvider::HAVE_ACCESS_GATE, Menu::EDIT_MENU)
    ->canDelete(UsersRolesPermissionsServiceProvider::HAVE_ACCESS_GATE, Menu::DELETE_MENU),
```

You can publish the config file `frontend-menu.php`, by running this command

```shell
php artisan vendor:publish --tag=frontend-menu-config
```

which contains these settings

```php
return [
    'menu-resource' => CWSPS154\FrontendMenu\Filament\Resources\MenuResource::class,
    'max-depth' => 3,
];
```
For More details about the widget check this package `solution-forest/filament-tree`

Using `get_menus()` you will all the menu's and it's child

## Screenshots

![Frontend Menu Screenshot Widget](screenshorts/frontend-menu.png)

![Frontend Menu Screenshot Widget](screenshorts/widget.png)

![Frontend Menu Screenshot Widget](screenshorts/list.png)

