<?php

namespace App\Models;

use App\Traits\HasUuid;
use App\Traits\HasActive;
use App\Traits\FileHandler;
use App\Traits\UploadFiles;
use App\Traits\DeleteOldFiles;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        SoftDeletes,
        HasActive,
        HasUuid,
        UploadFiles,
        DeleteOldFiles,
        FileHandler;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $files = ['image'];

    protected $deletableFiles = ['image'];

    function uploadPath()
    {
        return config("base.user.uploads.img.path");
    }

    public function getImageAttribute($value)
    {
        if (!$value) {
            $default_image_path = config('base.main.uploads.img.default');
            return asset("/$default_image_path");
        }
        if (Str::startsWith($value, ['http', 'https'])) {
            return $value;
        }
        return asset('storage/files/' . $this->uploadPath() . $value);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
