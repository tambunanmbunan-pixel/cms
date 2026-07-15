<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    // Menyesuaikan dengan nama tabel di skema migrasi Anda
    protected $table = 'post';

    protected $fillable = [
        'author_id',
        'blog_category_id',
        'title',
        'slug',
        'content',
        'image',
        'status'
    ];

    // Relasi balik ke Kategori Blog
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    // Relasi ke User / Penulis Artikel
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getReadTimeAttribute()
    {
        $wordsPerMinute = 200; // Rata-rata kecepatan membaca
        $wordsCount = Str::wordCount(strip_tags($this->content));
        $minutes = ceil($wordsCount / $wordsPerMinute);
        return $minutes < 1 ? 1 : $minutes;
    }

    /**
     * Accessor Excerpt Dinamis (Memotong konten otomatis untuk ringkasan)
     */
    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 160, '...');
    }
}