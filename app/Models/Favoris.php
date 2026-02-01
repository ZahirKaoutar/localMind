<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favoris extends Model
{
    // Table
    protected $table = 'favoris';

    // Autoriser l'insertion via create()
    protected $fillable = ['user_id', 'question_id'];

    // Si la table a created_at et updated_at
    public $timestamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
