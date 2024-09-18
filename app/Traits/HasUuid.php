<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}
