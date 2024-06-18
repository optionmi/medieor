<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function restrictedAction()
    {
        $data = [
            'error' => true,
            'message' => 'Restricted',
        ];
        return response()->json(compact('data'), 403);
    }
}
