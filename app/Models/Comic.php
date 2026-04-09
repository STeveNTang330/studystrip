<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    // Ini adalah daftar kolom yang KITA IZINKAN untuk diisi dari form
    protected $fillable = [
        'chapter_number',
        'chapter_title',
        'description',
        'file_path',
    ];
}