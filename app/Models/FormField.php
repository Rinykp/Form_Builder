<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    public $timestamps = false;
    
    protected $guarded = [];
    protected $table = 'form_fields';

    /**
     * Get the field's option.
     *
     * @param  string  $value
     * @return string
     */
    public function getOptionsAttribute($value)
    {
        return json_decode($value);
    }
}