<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDonationRequest;
use App\Http\Resources\DonationResource;
use App\Models\Project;

class DonationController extends Controller
{
    public function store(StoreDonationRequest $request, Project $project)
    {
        $donation = $request->persists($project);

        return DonationResource::make($donation);
    }
}
