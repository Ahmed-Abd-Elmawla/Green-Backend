<?php

namespace App\Models;

use App\Traits\HasUuid;
use App\Traits\HasActive;
use App\Traits\FileHandler;
use App\Traits\UploadFiles;
use Illuminate\Support\Str;
use App\Traits\DeleteOldFiles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasApiTokens,
        HasFactory,
        HasActive,
        HasUuid,
        UploadFiles,
        DeleteOldFiles,
        FileHandler;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $files = ['image'];

    function uploadPath()
    {
        return config("base.products.uploads.imgs.path");
    }

    public function getImageAttribute($value)
    {
        if (!$value) {
            $default_image_path = config('base.products.uploads.imgs.default');
            return asset("/$default_image_path");
        }
        if (Str::startsWith($value, ['http', 'https'])) {
            return $value;
        }
        return asset('storage/files/' . $this->uploadPath() . $value);
    }

    public function getOfferAttribute($value)
    {
        if ($value ==='0') {
            return __('dashboard.product.no_offers');
        }else{
            return $value;
        }
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
