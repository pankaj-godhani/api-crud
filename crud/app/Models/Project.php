<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'organizer_id', 'name', 'description', 'amount', 'collected_fund'];

    public function projectFiles()
    {
        return $this->hasMany(ProjectFile::class, 'project_id', 'id');
    }

    public function tags()
    {
        return $this->belongsTo(Tag::class,'id');
    }

    public function organizers()
    {
        return $this->belongsTo(Organizer::class, 'id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'project_id', 'id');
    }

    public function updates()
    {
        return $this->hasMany(Update::class, 'project_id', 'id');
    }
}
