<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cover_image',
        'description',
        'author_id'
    ];

    // Relacionamento: um livro pertence a um autor
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
