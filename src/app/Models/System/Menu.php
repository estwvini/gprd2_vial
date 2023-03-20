<?php

namespace App\Models\System;

use App\Models\BaseModel;

/**
 * @mixin IdeHelperMenu
 */
class Menu extends BaseModel
{

    public const HIDDEN = [
        'index.reforms.reforms_reprogramming.execution',
        'index.budgetary.reforms.reforms_reprogramming.execution',
        'index.certifications.execution',
        'approved.certifications.execution'
    ];

    /**
     * Get the parent that owns the menu.
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Get the children for the menu.
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
