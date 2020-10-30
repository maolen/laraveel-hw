<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App\Models
 *
 * @property string|Carbon $created_at
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'supplier',
        'price',
        'description',
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
