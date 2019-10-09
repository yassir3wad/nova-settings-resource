<?php

namespace Yassir3wad\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Setting extends Model
{
    protected $fillable = ['section', 'name', 'public', 'value', 'field', 'active', 'path'];
    protected $casts = ['active' => 'boolean', 'public' => 'boolean', 'path' => 'array'];
    protected $attributes = [
        'active' => true,
        'public' => true
    ];

    public function scopePublic($q)
    {
        return $q->where('public', true);
    }

    public function getValueAttribute()
    {
        if (!isset($this->attributes['field']))
            return null;

        switch ($this->attributes['field']) {
            case 'Laravel\Nova\Fields\Boolean':
                return (boolean)$this->attributes['value'];
                break;
            case 'MrMonat\Translatable\Translatable':
                return json_decode($this->attributes['value'], true);
                break;
            case 'Laravel\Nova\Fields\Date':
                return Carbon::parse($this->attributes['value']);
                break;
            case 'Laravel\Nova\Fields\DateTime':
                return Carbon::parse($this->attributes['value']);
                break;
            default:
                return $this->attributes['value'];
                break;
        }
    }
}
