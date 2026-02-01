<?php

namespace App\Models;
use App\Models\User;
use app\Models\Question;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'content','question_id','user_id'
    ];

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

