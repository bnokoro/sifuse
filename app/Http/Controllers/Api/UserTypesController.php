<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\UserType;
use Illuminate\Http\Request;

class UserTypesController extends Controller
{
    public function index()
    {
        return $this->respondWithSuccess(['data' => UserType::all(['id', 'user_type'])]);
    }
}
