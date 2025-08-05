<?php 

use Illuminate\Support\Facades\Http;

it('sends a request using the custom Http::user() macro', function () {
    config()->set('services.crm.outbound_password', 'secret123');
    config()->set('services.crm.entrypoint', 'https://crm.example.com');

    Http::fake();

    Http::user('crm')->get('/login');

    Http::assertSent(function ($request) {
        return
            $request->url() === 'https://crm.example.com/login' &&
            $request->hasHeader('Authorization', 'Basic ' . base64_encode('crm:secret123')) &&
            $request->method() === 'GET';
    });
});