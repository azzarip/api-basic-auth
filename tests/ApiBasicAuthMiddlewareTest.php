<?php 

use Illuminate\Support\Facades\Route;

beforeEach(function() {
    Route::get('/test-protected', function () {
        return response()->json(['message' => 'Authorized']);
    })->middleware('api.auth:myuser');
    config()->set('services.myuser.inbound_password', 'secret123');
});

use function Pest\Laravel\get;

it('denies access without basic auth', function () {
    get('/test-protected')
        ->assertStatus(401)
        ->assertSee('Unauthorized');
});

it('denies access with wrong credentials', function () {
    get('/test-protected', [
        'Authorization' => 'Basic ' . base64_encode('wronguser:wrongpass'),
    ])
        ->assertStatus(401)
        ->assertSee('Unauthorized');
});

it('allows access with correct credentials', function () {
    $username = 'myuser';
    $password = config("services.{$username}.inbound_password");

    get('/test-protected', [
        'Authorization' => 'Basic ' . base64_encode("{$username}:{$password}"),
    ])
        ->assertStatus(200)
        ->assertJson(['message' => 'Authorized']);
});