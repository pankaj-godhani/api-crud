<?php

namespace App\Http\Requests;

use App\Models\Project;
use App\Services\ProjectFileService;
use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tag_id'            => ['required', 'exists:tags,id'],
            'organizer_id'      => ['required', 'exists:organizers,id'],
            'name'              => ['required', 'max:255'],
            'description'       => ['required', 'string'],
            'amount'            => ['required', 'numeric', 'gt:0'],
            'collected_fund'    => ['required', 'numeric', 'gt:0'],
            'files'              => ['required', 'array', 'min:1'],
            'files.*'            => ['required', 'file', 'mimes:jpg,png,jpeg,svg,pdf,mp4,mov']
        ];
    }

    public function persists()
    {
        $project = Project::create($this->validated());

        if($this->hasFile('files')) {
            (new ProjectFileService())->upload($this->file('files'), $project->id);
        }

        return $project;
    }
}
