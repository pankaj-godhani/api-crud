<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                   => $this->id,
            'tag'                  => TagResource::make($this->tags),
            'organizer'            => OrganizerResource::make($this->organizers),
            'donations'            => DonationResource::collection($this->donations),
            'updates'              => UpdateResource::collection($this->updates),
            'name'                 => $this->name,
            'description'          => $this->description,
            'amount'               => $this->amount,
            'collected_fund'       => $this->collected_fund,
            'files'                 => ProjectFileResource::collection($this->projectFiles)
        ];
    }
}
