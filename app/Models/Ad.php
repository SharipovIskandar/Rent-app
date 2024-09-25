<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ad extends Model
{
    use HasFactory;
    protected $with = ['image'];
    protected $fillable = [
      'title',
      'description',
      'address',
      'price',
      'rooms',
      'status_id',
      'branch_id',
      'user_id',
    ];
    public function branch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }
    public function status(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function adbookmark()
    {
        return $this->belongsToMany(Adbookmark::class);
    }

}
