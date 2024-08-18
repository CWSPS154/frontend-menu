<?php
/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

namespace CWSPS154\FilamentFrontendMenu\Filament\Resources;

use CWSPS154\FilamentFrontendMenu\Filament\Resources\MenuResource\Pages\ManageMenus;
use CWSPS154\FilamentFrontendMenu\FilamentFrontendMenuServiceProvider;
use CWSPS154\FilamentFrontendMenu\Models\Menu;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    public const DEFAULT_DATETIME_FORMAT = 'M-d-Y h:i:s A';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('filament-frontend-menu::menu.title'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('order')
                    ->label(__('filament-frontend-menu::menu.order'))
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('parent_id')
                    ->label(__('filament-frontend-menu::menu.parent'))
                    ->relationship('parent', 'title', function ($query) {
                        if (config('filament-frontend-menu.widget.max-depth') == 2) {
                            return $query->doesntHave('parent');
                        }
                        return $query;
                    },true)
                    ->native(false),
                Forms\Components\TextInput::make('url')
                    ->label(__('filament-frontend-menu::menu.url'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('target')
                    ->label(__('filament-frontend-menu::menu.target'))
                    ->inline(false),
                Forms\Components\Toggle::make('status')
                    ->label(__('filament-frontend-menu::menu.status'))
                    ->required()
                    ->inline(false)
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-frontend-menu::menu.title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('parent.title')
                    ->label(__('filament-frontend-menu::menu.parent'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label(__('filament-frontend-menu::menu.order'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('url')
                    ->label(__('filament-frontend-menu::menu.url'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('target')
                    ->label(__('filament-frontend-menu::menu.target'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('status')
                    ->label(__('filament-frontend-menu::menu.status'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-frontend-menu::menu.created.at'))
                    ->dateTime(self::DEFAULT_DATETIME_FORMAT)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament-frontend-menu::menu.updated.at'))
                    ->dateTime(self::DEFAULT_DATETIME_FORMAT)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()->slideOver(),
                    Tables\Actions\DeleteAction::make()
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->visible(function () {
                        return self::checkAccess('getCanDelete');
                    }),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageMenus::route('/'),
        ];
    }

    public function getLayout(): string
    {
        if (config('filament-frontend-menu.layout')) {
            return config('filament-frontend-menu.layout');
        }
        return parent::getLayout();
    }

    public static function getCluster(): ?string
    {
        return config('filament-frontend-menu.cluster');
    }

    public static function getNavigationLabel(): string
    {
        return __(config('filament-frontend-menu.navigation.label'));
    }

    public static function getNavigationIcon(): string|Htmlable|null
    {
        return config('filament-frontend-menu.navigation.icon');
    }

    public static function getNavigationGroup(): ?string
    {
        return __(config('filament-frontend-menu.navigation.group'));
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-frontend-menu.navigation.sort');
    }

    public static function checkAccess(string $method, Model $record = null): bool
    {
        $plugin = Filament::getCurrentPanel()?->getPlugin(FilamentFrontendMenuServiceProvider::$name);
        $access = $plugin->$method();
        if (!empty($access) && is_array($access) && isset($access['ability'], $access['arguments'])) {
            return Gate::allows($access['ability'], $access['arguments']);
        }

        return $access;
    }

    public static function canViewAny(): bool
    {
        return self::checkAccess('getCanViewAny');
    }

    public static function canCreate(): bool
    {
        return self::checkAccess('getCanCreate');
    }

    public static function canEdit(Model $record): bool
    {
        return self::checkAccess('getCanEdit', $record);
    }

    public static function canDelete(Model $record): bool
    {
        return self::checkAccess('getCanDelete', $record);
    }
}
