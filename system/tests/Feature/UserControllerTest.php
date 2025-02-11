<?php

uses(Tests\TestCase::class);

it('Exibe a lista de usuários', function () {
    $users = \App\Models\User::factory()->count(3)->create();

    $response = $this->get(route('user.index'));

    $response->assertStatus(200);
    foreach ($users as $user) {
        $response->assertSee($user->name);
    }
});

it('Cadastro de um novo usuário', function () {
    $data = [
        'name' => 'Novo Usuário',
        'email' => 'novo@example.com',
        'password' => 'password',
    ];

    $response = $this->post(route('user.store'), $data);

    $this->assertDatabaseHas('users', [
        'name' => $data['name'],
        'email' => $data['email'],
    ]);
    
    $response->assertRedirect(route('user.index'));
    $response->assertSessionHas('success', 'Usuário cadastrado com sucesso!');
});

it('Exibe um usuário específico', function () {
    $user = \App\Models\User::factory()->create();

    $response = $this->get(route('user.show', $user));

    $response->assertStatus(200);
    $response->assertSee($user->name);
});

it('Verifica ediçao de um usuário', function () {
    $user = \App\Models\User::factory()->create();
    $data = [
        'name' => 'Usuário Editado',
        'email' => 'editado@example.com',
        'password' => 'nova_senha',
    ];

    $response = $this->put(route('user.update', $user), $data);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => $data['name'],
        'email' => $data['email'],
    ]);
    
    $response->assertRedirect(route('user.show', $user));
    $response->assertSessionHas('success', 'Usuário editado com sucesso!');
});

it('destroy remove um usuário', function () {
    $user = \App\Models\User::factory()->create();

    $response = $this->delete(route('user.destroy', $user));

    $this->assertDatabaseMissing('users', ['id' => $user->id]);
    $response->assertRedirect(route('user.index'));
    $response->assertSessionHas('success', 'Usuário apagado com sucesso!');
});
