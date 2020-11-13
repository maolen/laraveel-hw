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
        'image_path',
    ];

    function deleteImage()
    {
        if (!$this->image_path) {
            return;
        }

        $file = storage_path('app/' . $this->image_path);

        if (!file_exists($file)) {
            return;
        }

        unlink($file);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
