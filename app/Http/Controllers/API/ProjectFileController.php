<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\ProjectFile;
use App\Services\ProjectFileService;
use Illuminate\Http\Request;

class ProjectFileController extends Controller
{
    public function destroy(ProjectFile $project_file)
    {

        (new ProjectFileService())->unlink($project_file);
        $project_file->delete();

        return SuccessResource::make([
            'code' => 200,
            'message' => 'File deleted successfully.'
        ]);
    }
}
