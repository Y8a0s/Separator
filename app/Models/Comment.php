<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'parent_id',
        'accepted',
        'checked_by'
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function replys()
    {
        return $this->where('parent_id', $this->id)->latest();
    }

    public function acceptedReplys()
    {
        return $this->where('parent_id', $this->id)->where('accepted', 'Yes')->latest()->get();
    }

    public function parent()
    {
        return $this->where('id', $this->parent_id)->first();
    }

    public static function scopeFilterOrSearchComments($query, $filterBy = 'all', $search)
    {
        switch ($filterBy) {
            case 'accepted':
                $query = $query->where('accepted', 'Yes');
                break;

            case 'unaccepted':
                $query = $query->where('accepted', 'No');
                break;

            case 'notChecked':
                $query = $query->where('accepted', null);
                break;
        }

        if ($search != null)
            $query = $query->where(function ($query) use ($search) {

                $query
                    ->where('comment', 'like', "%{$search}%")
                    ->orWhere('comment', 'like', "%{$search}%")
                    ->orWhere('id', $search)
                    ->orWhereHas('user', function (Builder $query) use ($search) {

                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    });
            });

        return $query;
    }
}
