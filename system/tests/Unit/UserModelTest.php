<?php

use App\Models\Cake;
use App\Models\User;
use App\Models\CakeUser;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

it('Possui os atributos preenchíveis corretos', function () {
    $user = new User();

    expect($user->getFillable())->toBe([
        'name',
        'email',
        'password',
    ]);
});

it('Testa a o relacionamento com a tabela de usuários', function () {
    $cake = Cake::factory()->create();
    expect($cake->users())->toBeInstanceOf(BelongsToMany::class);
});

it('Verificar se a associação das tabelas está correto', function () {
    $cake = Cake::factory()->create();
    $users = User::factory()->count(3)->create();

    CakeUser::factory()->count(3)->create([
        'cake_id' => $cake->id,
        'user_id' => $users->random()->id,
    ]);

    $cake->load('users');

    expect($cake->users)->toHaveCount(3);
});