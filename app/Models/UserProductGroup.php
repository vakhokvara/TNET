<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProductGroup extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id', 'discount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productGroupItems()
    {
        return $this->hasMany(ProductGroupItem::class, 'group_id');
    }

}
