<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Classe User
 * 
 * Representa o modelo de usuário da aplicação, com suporte a verificação de e-mail.
 * 
 * @author Pierri Alexander Vidmar
 * @since 11/2024
 */
class User extends Authenticatable implements MustVerifyEmail
{
    /**
     * Habilita o uso de traits para o modelo.
     * 
     * @use HasFactory<\Database\Factories\UserFactory>
     * Inclui funcionalidades de fábrica para criação de instâncias do modelo.
     * 
     * @use Notifiable
     * Permite o envio de notificações para os usuários.
     * 
     * @use HasRoles
     * Adiciona suporte a permissões e papéis via Spatie Permissions.
     */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Os atributos que podem ser atribuídos em massa (mass assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',      // Nome do usuário
        'email',     // Endereço de e-mail
        'password',  // Senha do usuário
    ];

    /**
     * Os atributos que devem ser ocultados na serialização.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',        // Oculta a senha do usuário
        'remember_token',  // Oculta o token de lembrança
    ];

    /**
     * Define os atributos que devem ser convertidos para tipos específicos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Converte o campo para um objeto DateTime
            'password' => 'hashed',           // Indica que a senha é armazenada de forma hasheada
        ];
    }

    /**
     * Relacionamento "hasMany" (um para muitos) com o modelo Feature.
     * Isso indica que um "User" pode ter muitas "Features".
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function features(): HasMany
    {
        return $this->hasMany(Feature::class); 
    }
}
