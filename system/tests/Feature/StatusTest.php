<?php

uses(Tests\TestCase::class);

it('Verifica Status Sistema', fn () => $this->get('/user')->assertOk());

it('Verifica Status API de usuários', function () {
    $response = $this->get('/api/cake-user');
    $response->assertOk();
});

it('Verifica Status API de bolos', function () {
    $response = $this->get('/api/cakes');
    $response->assertOk();
});