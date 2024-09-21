<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequest;
use App\Http\Resources\SuccessResource;
use App\Models\Project;
use App\Services\UpdateService;

class UpdateController extends Controller
{
    public function store(UpdateRequest $request, Project $project)
    {
        $update = $request->persists($project);

        return SuccessResource::make($update);
    }
}
