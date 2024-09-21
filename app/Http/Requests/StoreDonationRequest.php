<?php

namespace App\Http\Requests;

use App\Models\Donation;
use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'gt:0'],
            'profile_image' => ['file', 'mimes:jpg,png,jpeg,svg']
        ];
    }

    public function persists(Project $project)
    {
        if ($this->profile_image) {
            $profileImagePath = $this->profile_image->store('uploads');
        } else {
            $profileImagePath = null;
        }

        $donation = Donation::create($this->validated() + [
                'project_id' => $project->id,
                'profile_image_path' => $profileImagePath
            ]);

        return $donation;
    }
}
