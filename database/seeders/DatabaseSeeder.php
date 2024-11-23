<?php

namespace Database\Seeders;

use App\Enum\PermissionsEnum; // Enum para gerenciar permissões predefinidas.
use App\Enum\RolesEnum; // Enum para gerenciar papéis (roles) predefinidos.
use App\Models\User; // Modelo de usuário da aplicação.
// use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Comentado porque não está sendo usado.
use Illuminate\Database\Seeder; // Classe base para seeders.
use Spatie\Permission\Models\Permission; // Modelo do pacote Spatie para permissões.
use Spatie\Permission\Models\Role; // Modelo do pacote Spatie para papéis.

class DatabaseSeeder extends Seeder
{
    /**
     * Método principal para popular o banco de dados.
     */
    public function run(): void
    {
        // Criando os papéis (roles) com base no enum `RolesEnum`.
        $userRole = Role::create(['name' => RolesEnum::User->value]); // Papel: "user"
        $commenterRole = Role::create(['name' => RolesEnum::Commenter->value]); // Papel: "commenter"
        $adminRole = Role::create(['name' => RolesEnum::Admin->value]); // Papel: "admin"

        // Criando permissões com base no enum `PermissionsEnum`.
        $manageFeaturesPermission = Permission::create([
            'name' => PermissionsEnum::ManageFeatures->value, // Permissão para gerenciar funcionalidades.
        ]);

        $manageCommentsPermission = Permission::create([
            'name' => PermissionsEnum::ManageComments->value, // Permissão para gerenciar comentários.
        ]);

        $manageUsersPermission = Permission::create([
            'name' => PermissionsEnum::ManageUsers->value, // Permissão para gerenciar usuários.
        ]);

        $upvoteDownvotePermission = Permission::create([
            'name' => PermissionsEnum::UpvoteDownvote->value, // Permissão para votar positivo/negativo.
        ]);

        // Associando permissões ao papel "user".
        $userRole->syncPermissions([$upvoteDownvotePermission]);

        // Associando permissões ao papel "commenter".
        $commenterRole->syncPermissions([$upvoteDownvotePermission, $manageCommentsPermission]);

        // Associando permissões ao papel "admin".
        $adminRole->syncPermissions([
            $upvoteDownvotePermission, // Votar positivo/negativo.
            $manageUsersPermission,    // Gerenciar usuários.
            $manageCommentsPermission, // Gerenciar comentários.
            $manageFeaturesPermission, // Gerenciar funcionalidades.
        ]);

        // Criando um usuário com o papel "user".
        User::factory()->create([
            'name' => 'User User', // Nome do usuário.
            'email' => 'user@example.com', // Email do usuário.
        ])->assignRole(RolesEnum::User); // Atribuindo o papel "user" ao usuário.

        // Criando um usuário com o papel "commenter".
        User::factory()->create([
            'name' => 'Commenter User', // Nome do usuário.
            'email' => 'commenter@example.com', // Email do usuário.
        ])->assignRole(RolesEnum::Commenter); // Atribuindo o papel "commenter" ao usuário.

        // Criando um usuário com o papel "admin".
        User::factory()->create([
            'name' => 'Admin User', // Nome do usuário.
            'email' => 'admin@example.com', // Email do usuário.
        ])->assignRole(RolesEnum::Admin); // Atribuindo o papel "admin" ao usuário.
    }
}
