<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $guarded = [];
    protected $table = 'forms';

    /**
     * The fields that belong to the form.
     */
    public function fields()
    {
        return $this->belongsToMany('App\Field', 'form_fields')->withPivot('id', 'options');
    }
}