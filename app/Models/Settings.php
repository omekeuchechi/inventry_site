<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $table = 'settings';

    protected $fillable = [
        'company_name',
        'favicon',
        'keywords',
        'web_color',
        'logo',
        'updateded_by',
        'setbg',
    ];
}
