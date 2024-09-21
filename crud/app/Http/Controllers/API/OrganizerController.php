<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizerResource;
use App\Models\Organizer;

class OrganizerController extends Controller
{
    public function __invoke()
    {
        return OrganizerResource::collection(Organizer::all());
    }
}
