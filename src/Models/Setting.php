<?php

namespace Yassir3wad\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['section', 'name', 'public', 'value','field', 'active', 'path', 'datatype'];
    protected $casts = ['active' => 'boolean', 'public' => 'boolean', 'path' => 'array'];
    protected $attributes = [
        'active' => true,
        'public' => true
    ];
}
