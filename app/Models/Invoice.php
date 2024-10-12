<?php

namespace App\Models;

use App\Traits\HasUuid;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasApiTokens,
        HasFactory,
        HasUuid;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'invoice_product')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            do {
                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';

                for ($i = 0; $i < 6; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                $code = '#' . $randomString;
            } while (self::where('code', $code)->exists());

            $invoice->code = $code;
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
