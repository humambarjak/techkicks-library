<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'pdf_file',
        'user_id',
        'category',
        'user_id',
        'is_special', // ✅ THIS LINE IS NEEDED
        'level', // ✅ Add this!
    ];
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
        // Book.php
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    protected $casts = [
        'is_special' => 'boolean',
    ];
    public function reviewers()
    {
        return $this->belongsToMany(User::class, 'book_user_reviews')
                    ->withPivot('rating')
                    ->withTimestamps();
    }
    public function averageRating()
    {
        return round($this->ratings()->avg('rating'), 1);
    }
    
    public function ratings()
    {
        return $this->hasMany(\App\Models\Rating::class);
    }



    
    
}
