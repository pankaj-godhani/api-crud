<?php

namespace App\Services;


use App\Enums\FileTypes;
use App\Models\ProjectFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectFileService
{
    public function upload($files, $projectId)
    {
        foreach ($files as $file) {
            $path = $file->store('uploads');
            $mimeType = $file->getMimeType();
            if (in_array($mimeType, ['video/mp4', 'video/mov'])) {
                $type = FileTypes::VIDEO;
            } elseif (in_array($mimeType, ['application/pdf'])) {
                $type = FileTypes::PDF;
            } else {
                $type = FileTypes::IMAGE;
            }

            ProjectFile::create([
                'project_id' => $projectId,
                'path' => $path,
                'type' => $type,
            ]);
        }

        return true;

    }

    public function unlink(ProjectFile $projectFile)
    {
        Storage::delete($projectFile->path);
    }
}
