<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'brand', 'build_model', 'description', 'price', 'available', 'images', 'alt'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function scopeFilterOrSearchProducts($query, $filterBy, $search)
    {
        switch ($filterBy) {
            case 'available':
                $query = $query->where('available', '1');
                break;

            case 'unavailable':
                $query = $query->where('available', '0');
                break;
        }

        if ($search != null)
            $query = $query->where(function ($query) use ($search) { //for grouping wheres
                $query
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('build_model', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('id', $search);
            });

        return $query;
    }
}
