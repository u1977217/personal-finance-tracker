<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;

    // All fillable columns
    protected $fillable = [
        'title',
        'description',
        'author_id',
        'genre_id',
        'status_id',
        'pages',
        'year',
        'user_id',
    ];

    // Eloquent Relationships
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Query Scopes

    // Scope for searching titles
    public function scopeSearch($query, $term)
    {
        if ($term) {
            return $query->where('title', 'like', "%{$term}%");
        }
        return $query;
    }

    // Scope for filtering by status
    public function scopeStatusFilter($query, $statusId)
    {
        if ($statusId) {
            return $query->where('status_id', $statusId);
        }
        return $query;
    }

    // Scope for filtering by authors
    public function scopeAuthorsFilter($query, $authorSearch)
    {
        if ($authorSearch) {
            return $query->where('author_id', $authorSearch);
        }
        return $query;
    }
}
