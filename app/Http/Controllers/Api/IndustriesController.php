<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Industry;
use Illuminate\Http\Request;

class IndustriesController extends Controller
{
    public function index()
    {
        return $this->respondWithSuccess(['data' => Industry::orderBy('industry')->get(['id', 'industry'])]);
    }
}
