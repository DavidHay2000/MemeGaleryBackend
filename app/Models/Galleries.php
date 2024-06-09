<?php

namespace App\Models;

use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Galleries extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function photos(): HasMany
    {
        return $this->hasMany(Photos::class, 'galleryID');
    }

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }


}
