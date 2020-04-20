<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StartupProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'profile' => $this->startupProfile,
            'company' => $this->startupCompany()->with('industries.industry')->get(),
            'product_services' => $this->startupServices()->with('teams')->get(),
            'market' => $this->startupMarket,
            'finance' => $this->startupFinance
        ];
    }
}
