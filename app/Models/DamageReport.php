<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamageReport extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['room', 'user', 'histories'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('id', $search);
        });

        $query->when($filters['statuses'] ?? false, function ($query, $statuses) {
            return $query->whereIn('status', $statuses);
        });

        $query->when($filters['months'] ?? false, function ($query, $months) {
            $query->whereMonth('created_at', $months[0]);
            if (count($months) >= 1) {
                for ($i = 1; $i < count($months); $i++) {
                    $query->orWhereMonth('created_at', $months[$i]);
                }
            }
            return $query;
        });

        $query->when($filters['year'] ?? false, function ($query, $year) {
            return $query->whereYear('created_at', $year);
        });
    }

    public function updateStatus($data)
    {
        $this->status = $data['status'];
        $this->save();
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
