<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSetting
 */
class Setting extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'settings';

    protected $fillable = [
        'id',
        'key',
        'value',
        'description'
    ];

    /**
     * Get data
     *
     * @param $value
     *
     * @return mixed
     */
    public function getValueAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        return json_decode($value, true);
    }

    /**
     * Set data
     *
     * @param $value
     */
    public function setValueAttribute($value)
    {
        // if nothing being set, clear configuration
        if (empty($value) || !is_array($value)) {
            $this->attributes['value'] = '{}';
            return;
        }

        // store as json.
        $this->attributes['value'] = json_encode($value);
    }

}
