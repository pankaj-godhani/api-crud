<?php

namespace App\Http\Requests;

use App\Models\Project;
use App\Models\Update;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['required', 'string']
        ];
    }

    public function persists(Project $project)
    {
        $update = Update::create([
            'project_id' => $project->id,
            'description' => $this->description,
        ]);

        return $update;
    }
}
