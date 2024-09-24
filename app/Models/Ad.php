<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(Branch::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    public function status(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
