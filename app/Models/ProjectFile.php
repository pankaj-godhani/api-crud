<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProjectFile extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'project_id', 'path', 'type'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getProjectFileUrlAttribute()
    {
        if (!empty($this->path) && Storage::disk(config('filesystems.default'))->exists($this->path)) {
            return Storage::disk(config('filesystems.default'))->url($this->path);
        } else {
            return asset('images/avatar.png');
        }
    }
}
