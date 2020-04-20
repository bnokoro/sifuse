<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Resources\StartupProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StartupProfileController extends Controller
{
    public function index(Request $request)
    {
        return $this->respondWithSuccess(['data' => new StartupProfileResource($request->user())]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'phone' => ['required', Rule::unique('startup_profiles')->ignore($user->id, 'user_id')],
            'gender' => ['required', Rule::in(['male', 'female'])]
        ]);

        $path = FileUploader::uploadFile($request->file('profile_pic'), 'profiles');

        $user->startupProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $request->except('profile_pic') + ['profile_pic_url' => $path]
        );

        return $this->respondWithSuccess(['data' => new StartupProfileResource($user)]);
    }

    public function storeCompanyDetails(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'name' => ['required', Rule::unique('companies')->ignore($user->id, 'user_id')],
            'logo' => 'required',
            'website' => 'url'
        ]);

        $path = FileUploader::uploadFile($request->file('logo'), 'company_logos');

        $company = $user->startupCompany()->updateOrCreate(
            ['user_id' => $user->id],
            $request->except('logo', 'industry_ids') + ['logo_url' => $path]
        );

        $company->industries()->delete();
        if ($industries = $request->industry_ids) {
            foreach ($industries as $industry) {
                $company->industries()->create(['industry_id' => $industry]);
            }
        }

        return $this->respondWithSuccess(['data' => new StartupProfileResource($user)]);
    }

    public function storeProductService(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'product_name' => 'required'
        ]);

        $product_vid_url = FileUploader::uploadFile($request->file('product_video'), 'products/videos');
        $product_image_url = FileUploader::uploadFile($request->file('product_image'), 'products/images');
        $pitch_video_url = FileUploader::uploadFile($request->file('pitch_video'), 'products/video');

        $service = $user->startupServices()->updateOrCreate(
            ['user_id' => $user->id],
            $request->except('product_video', 'product_image', 'pitch_video', 'teams') + [
                'product_video_url' => $product_vid_url,
                'pitch_video_url' => $pitch_video_url,
                'product_image_url' => $product_image_url
            ]
        );

        $service->teams()->delete();
        if ($request->teams) {
            foreach ($request->teams as $team) {
                $service->teams()->create($team);
            }
        }

        return $this->respondWithSuccess(['data' => new StartupProfileResource($user)]);
    }

    public function storeMarket(Request $request)
    {
        $user = $request->user();

        $user->startupMarket()->updateOrCreate(
            ['user_id' => $user->id],
            $request->all()
        );

        return $this->respondWithSuccess(['data' => new StartupProfileResource($user)]);
    }

    public function storeFinance(Request $request)
    {
        $request->validate([
            'revenue_type' => 'required',
            'capital_needed_for' => 'required'
        ]);

        $user = $request->user();

        $user->startupFinance()->updateOrCreate(
            ['user_id' => $user->id],
            $request->all()
        );

        return $this->respondWithSuccess(['data' => new StartupProfileResource($user)]);
    }
}
