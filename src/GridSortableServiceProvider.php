<?php

namespace Encore\Admin\GridSortable;

use Encore\Admin\Admin;
use Illuminate\Support\ServiceProvider;

class GridSortableServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(GridSortable $extension)
    {
        if (! GridSortable::boot()) {
            return ;
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/godkott/grid-sortable2')],
                'laravel-admin-grid-sortable'
            );
        }

        GridSortable::routes(__DIR__.'/../routes/web.php');

        Admin::booting(function () {
            Admin::headerJs('vendor/godkott/grid-sortable2/jquery-ui.min.js');
        });

        $extension->install();
    }
}
