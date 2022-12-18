<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function createFlashMessage($message, $class = "info")
    {
        Session::flash($class, $message);
    }

    public static function reorderModel(Model $model, $model_id, $new_position, $field)
    {
        $modelObj   = $model->where('id', $model_id)->first();
        if ($modelObj) {
            $conditions = [
                $field      => $modelObj->{$field},
                'position'  => $new_position,
            ];

            $other      = $model->where($conditions)->first();

            if ($other) {
                $other->update(['position' => $modelObj->position]);
                $modelObj->update(['position' => $new_position]);
                return true;
            }
        }

        return false;
    }
}
