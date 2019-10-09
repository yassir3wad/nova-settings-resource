<?php

namespace Yassir3wad\Settings\Resources;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;

class Setting extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Yassir3wad\Settings\Models\Setting::class;

    public static $displayInNavigation = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'value'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make("Name")->rules('required')->sortable(),

        ];
    }
}
