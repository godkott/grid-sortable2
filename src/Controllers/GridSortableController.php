<?php

namespace Encore\Admin\GridSortable\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GridSortableController extends Controller
{
    public function sort(Request $request)
    {
        $sorts = $request->get('_sort');

        $sorts = collect($sorts)
            ->pluck('key');

        $status     = true;
        $message    = trans('admin.save_succeeded');

        $modelClass = $request->get('_model');

        try {

            $modelClass::setNewOrder($sorts->toArray());
        } catch (Exception $exception) {
            $status  = false;
            $message = $exception->getMessage();
        }

        return response()->json(compact('status', 'message'));
    }
}
