<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory,
    HasUuid;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

        public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
