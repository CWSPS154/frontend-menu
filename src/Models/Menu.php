<?php

/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

namespace CWSPS154\FrontendMenu\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SolutionForest\FilamentTree\Concern\ModelTree;
use SolutionForest\FilamentTree\Support\Utils;

class Menu extends Model
{
    use ModelTree;

    public const MENU = 'menu';

    public const VIEW_MENU = 'view-menu';

    public const CREATE_MENU = 'create-menu';

    public const EDIT_MENU = 'edit-menu';

    public const DELETE_MENU = 'delete-menu';

    protected $fillable = [
        'parent_id', 'title', 'order', 'url', 'target', 'status',
    ];

    protected $casts = [
        'parent_id' => 'int',
        'target' => 'boolean',
        'status' => 'boolean',
    ];

    /**
     * Get the parent menu item.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id')
            ->where('parent_id', '!=', $this->id);
    }

    /**
     * Get the child menu items.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public static function defaultParentKey(): ?int
    {
        return null;
    }

    protected function parentId(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == Utils::defaultParentId() ? null : $value,
            set: fn ($value) => $value == null ? Utils::defaultParentId() : $value
        );
    }
}
