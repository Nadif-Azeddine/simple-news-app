<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }

    /** 
     * method to get all articles of a category
     * it called in the recursive function
     */
    public function allArticles($includeExpired = false)
    {
        $query = $this->news();

        if (!$includeExpired) {
            $query->where('end_date', '>', now());
        }

        return $query->orderByDesc('start_date');
    }

    public function getAllArticlesRecursive($includeExpired = false)
    {
        $articles = $this->allArticles($includeExpired)->get();

        foreach ($this->children as $child) {
            $articles = $articles->merge($child->getAllArticlesRecursive($includeExpired));
        }

        return $articles;
    }
}
