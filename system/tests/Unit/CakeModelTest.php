<?php

use App\Models\Cake;
use App\Models\User;
use App\Models\CakeUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

uses(RefreshDatabase::class);

it('Possui os atributos preenchíveis corretos', function () {
    $cake = new Cake();

    expect($cake->getFillable())->toBe([
        'description',
        'weight',
        'price',
        'qty_avail',
    ]);
});

it('Testa o relacionamento com a tabela de bolos', function () {
    $user = user::factory()->create();
    expect($user->cakes())->toBeInstanceOf(BelongsToMany::class);
});

it('Verificar se a associação das tabelas está correto', function () {
    $user = User::factory()->create();
    $cakes = Cake::factory()->count(3)->create();

    CakeUser::factory()->count(3)->create([
        'user_id' => $user->id,
        'cake_id' => $cakes->random()->id,
    ]);

    $user->load('cakes');

    expect($user->cakes)->toHaveCount(3);
});