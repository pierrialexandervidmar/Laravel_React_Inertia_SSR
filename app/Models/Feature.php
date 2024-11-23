<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Classe Feature
 * 
 * @author Pierri Alexander Vidmar
 * @since 11/2024
 */
class Feature extends Model
{
    /**
     * Relacionamento "hasMany" (um para muitos) com o modelo Upvote.
     * Isso indica que uma "Feature" pode ter muitos "Upvotes".
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function upvotes(): HasMany
    {
        return $this->hasMany(Upvote::class); // Um recurso pode ter muitos votos
    }

    /**
     * Relacionamento "hasMany" (um para muitos) com o modelo Comment.
     * Isso indica que uma "Feature" pode ter muitos "Comments".
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class); // Um recurso pode ter muitos comentários
    }

    /**
     * Relacionamento "belongsTo" (muitos para um) com o modelo User.
     * Isso indica que uma "Feature" pertence a um único "User".
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); // Um recurso pertence a um único usuário
    }
}
