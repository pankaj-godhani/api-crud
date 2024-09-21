<?php

namespace App\Http\Requests;

use App\Models\Project;
use App\Services\ProjectFileService;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'tag_id'            => ['required', 'exists:tags,id'],
            'organizer_id'      => ['required', 'exists:organizers,id'],
            'name'              => ['required', 'max:255'],
            'description'       => ['required', 'string'],
            'amount'            => ['required', 'numeric', 'gt:0'],
            'collected_fund'    => ['required', 'numeric', 'gt:0']
        ];

        if($this->has('files')) {
            $rules['files'] = ['required', 'array', 'min:1'];
            $rules['files.*'] = ['required', 'file', 'mimes:jpg,png,jpeg,svg,pdf,mp4,mov'];
        }

        return $rules;
    }

    public function persists(Project $project)
    {
        $project = $project->fill($this->validated());
        $project->save();

        if($this->hasFile('files')) {
            (new ProjectFileService())->upload($this->file('files'), $project->id);
        }

        return $project;
    }
}
