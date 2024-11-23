<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Classe Comment
 * 
 * Representa um comentário associado a uma funcionalidade (Feature) e a um usuário (User).
 * 
 * @author Pierri Alexander Vidmar
 * @since 11/2024
 */
class Comment extends Model
{
    /**
     * Relacionamento "belongsTo" (muitos para um) com o modelo User.
     * Isso indica que um "Comment" pertence a um único "User".
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); // Um comentário pertence a um único usuário
    }

    /**
     * Relacionamento "belongsTo" (muitos para um) com o modelo Feature.
     * Isso indica que um "Comment" pertence a uma única "Feature".
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feature(): BelongsTo
    {
        return $this->belongsTo(Feature::class); // Um comentário pertence a uma única funcionalidade
    }
}
