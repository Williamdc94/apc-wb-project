<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

 protected $fillable = [
    'user_id',
    'original_name',
    'file_path',
    'original_size',
    'compressed_size',
    'compression_ratio',
    'compression_time',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
