<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory,
    HasUuid;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
