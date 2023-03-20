<?php

namespace App\Models\System;


/**
 * @mixin IdeHelperModule
 */
class Module extends \Laverix\Acl\Models\Eloquent\Module
{
    const MODULE_APP = 4;

    const MODULE_LIBRARY = 5;

    const MODULE_CLIMATERISK = 6;
}
