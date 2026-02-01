<?php

namespace App\Models;
use App\Models\User;
use App\Models\Response;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title','content','location','date','user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function responses(){
        return $this->hasMany(Response::class);
    }

   public function favorites()
{
    return $this->hasMany(Favoris::class);
}

}
