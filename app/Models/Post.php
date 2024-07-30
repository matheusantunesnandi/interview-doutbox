<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Definir os atributos que podem ser atribuídos em massa
    protected $fillable = [
        'id',
        'title',
        'content',
        'author_id',
        'published',
        'comments',
        'created_at',
        'updated_at',
    ];

    // Relacionamento com o modelo User (autor)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    // Definir escopos
    public function scopeByAuthor($query, $authorName)
    {
        return $query->whereHas('author', function ($q) use ($authorName) {
            $q->where('name', $authorName);
        });
    }

    // Definir escopos
    public function scopeByAuthorId($query, $id)
    {
        return $query->whereHas('author', function ($q) use ($id) {
            $q->where('author_id', $id);
        });
    }

    public function scopeByTitle($query, $title)
    {
        return $query->where('title', 'like', '%' . $title . '%');
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereDate('created_at', $date);
    }

    public function scopePublished($query, bool $status)
    {
        return $query->where('published', '=', $status);
        // return $query->where('published', '=', $status == 'T' ? 'T' : 'F');
    }
}
