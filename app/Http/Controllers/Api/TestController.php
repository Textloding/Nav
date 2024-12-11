<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request)
    {
        \Log::info('Test endpoint accessed');
        return response()->json([
            'message' => 'test',
            'method' => $request->method(),
            'path' => $request->path(),
            'url' => $request->url(),
        ]);
    }
}
