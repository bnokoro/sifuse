<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\StartupStage;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function startupStages()
    {
        return $this->respondWithSuccess(['data' => StartupStage::all(['id', 'stage'])]);
    }
}
