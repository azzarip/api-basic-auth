<?php

namespace Azzarip\ApiBasicAuth;

use Illuminate\Routing\Controller;

class UpController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return response()->json(['status' => 'ok']);
    }
}
