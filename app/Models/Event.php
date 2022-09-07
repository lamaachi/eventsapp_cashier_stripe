<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $garded = [];
    protected $dates = ['starts_at','ends_at'];
    protected $fillable = ['ends_at','starts_at','premium','slug','content','title'];
     
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
