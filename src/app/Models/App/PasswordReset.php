<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPasswordReset
 */
class PasswordReset extends Model
{
    protected $table = 'password_reset_clients';

    protected $fillable = [
        'email', 'token','code'
    ];
}
