<?php

namespace App\Models\App;

use Altek\Accountant\Contracts\Identifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @mixin IdeHelperClient
 */
class Client extends Authenticatable implements Identifiable
{
    use Notifiable, HasApiTokens, Notifiable;


    protected $table = 'app_clients';

    protected $fillable = [
        'username',
        'full_name',
        'age',
        'date_birth',
        'ethnicity',
        'gender',
        'canton',
        'email',
        'password'
    ];

    /**
     * Cifrado.
     *
     * @var array
     */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function getIdentifier()
    {
        return $this->getKey();
    }
}
