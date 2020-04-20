<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvestorProfileResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InvestorProfileController extends Controller
{
    public function index(Request $request)
    {
        return $this->respondWithSuccess(['data' => new InvestorProfileResource($request->user())]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'phone' => ['required', Rule::unique('investor_profiles')->ignore($user->id, 'user_id')],
            'gender' => ['required', Rule::in(['male', 'female'])]
        ]);

        $path = FileUploader::uploadFile($request->file('profile_pic'), 'profiles');

        $user->investorProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $request->except('profile_pic') + ['profile_pic_url' => $path]
        );

        return $this->respondWithSuccess(['data' => new InvestorProfileResource($user)]);
    }

    public function storeInterest(Request $request)
    {
        $request->validate([
            'investor_type' => 'required',
            'investment_stage_id' => 'required|exists:startup_stages,id'
        ]);

        $user = $request->user();

        $user->investorInterest()->updateOrCreate(
            ['user_id' => $user->id],
            $request->all()
        );

        return $this->respondWithSuccess(['data' => new InvestorProfileResource($user)]);
    }
}
