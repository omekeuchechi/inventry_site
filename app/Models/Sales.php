<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = [
        'item_id',
        'quantity',
        'total',
        'profit',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }

    public function getTotalAttribute($value)
    {
        return number_format($value, 2);
    }
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s');
    }
    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i:s');
    }
    public function getQuantityAttribute($value)
    {
        return number_format($value, 0);
    }
}
