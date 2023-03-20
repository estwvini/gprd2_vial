<?php

namespace App\Models;

use Altek\Accountant\Contracts\Identifiable;
use Altek\Accountant\Contracts\Recordable;
use Altek\Eventually\Eventually;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase BaseModel
 *
 * @mixin IdeHelperBaseModel
 */
class BaseModel extends Model implements Identifiable, Recordable
{
    use \Altek\Accountant\Recordable, Eventually;

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return $this->getKey();
    }

}