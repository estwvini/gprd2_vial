<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperDomain
 */
class Domain extends \Stancl\Tenancy\Database\Models\Domain
{
    use HasFactory;
}
