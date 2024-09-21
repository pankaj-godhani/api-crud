<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'name', 'amount', 'profile_image_path'];

    public function getProfileImageUrlAttribute()
    {
        if (!empty($this->profile_image_path) && Storage::disk(config('filesystems.default'))->exists($this->profile_image_path)) {
            return Storage::disk(config('filesystems.default'))->url($this->profile_image_path);
        } else {
            return asset('images/avatar.png');
        }
    }
}
