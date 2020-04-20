<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\StartupType;
use Illuminate\Http\Request;

class StartupTypesController extends Controller
{
    public function index()
    {
        return $this->respondWithSuccess(['data' => StartupType::orderBy('startup_type')->get(['id', 'startup_type'])]);
    }
}
