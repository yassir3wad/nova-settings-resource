<?php

namespace Yassir3wad\Settings;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Yassir3wad\Settings\Resources\Setting;

class SettingsTool extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public $resource = Setting::class;

    public function boot()
    {
        Nova::script('nova-settings', __DIR__ . '/../dist/js/tool.js');

        Nova::resources([
            $this->resource
        ]);
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('nova-settings::navigation');
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }
}
