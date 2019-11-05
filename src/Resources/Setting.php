<?php

namespace Yassir3wad\Settings\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\ResourceIndexRequest;
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
        'id', 'name', 'value'
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
            ID::make()->sortable()->hideFromIndex()->hideFromDetail(),

            Text::make("Name")
                ->readonly()
                ->resolveUsing(function ($value) {
                    return Str::ucfirst(str_replace('_', ' ',$value));
                }),

            $this->getField($request)->showOnIndex(),

            DateTime::make('Last Update', 'updated_at')->exceptOnForms()
        ];
    }

    /**
     * @return Field
     */
    protected function getField($request)
    {
        if ($this->model()->id) {
            $field = ($this->resource->field)::make("Value");
        } else {
            $field = (\Yassir3wad\Settings\Models\Setting::find(\request('resourceId'))->field)::make("Value");
        }

        if ($field instanceof \Laravel\Nova\Fields\File && $request instanceof ResourceIndexRequest) {
            return \Inspheric\Fields\Url::make('Value')->label('Preview')
                ->alwaysClickable()
                ->resolveUsing(function ($value) {
                    if ($value) {
                        return Storage::url($value);
                    } else {
                        return null;
                    }
                });
        }

        return $field;
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }
}
