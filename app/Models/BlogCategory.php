<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $table = 'blogs_categories';

    protected $fillable = ['name', 'slug'];

    // Relasi One-to-Many ke model Post
    public function posts()
    {
        return $this->hasMany(Post::class, 'blog_category_id');
    }
}