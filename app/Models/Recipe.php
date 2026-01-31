<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    // This lets us mass-assign these fields (security feature)
        protected $fillable = [
            'user_id',
            'title',
            'description',
            'image',
            'cuisine',
            'meal_type',
            'spice_level',
            'prep_time',
            'cook_time',
            'servings',
            'calories',
            'is_vegetarian',
            'is_vegan',
            'is_halal',
            'is_gluten_free',
            'ingredients',
            'instructions'
        ];
    // Relationship: A recipe belongs to one User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: A recipe can have many Reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relationship: A recipe can be bookmarked by many Users
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
    public function getAverageRatingAttribute()
{
    return $this->reviews()->avg('rating') ?? 0;
}
}