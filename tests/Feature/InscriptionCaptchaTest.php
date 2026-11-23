<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class InscriptionCaptchaTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_un_captcha_refuse_empeche_l_inscription(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' =>
            Http::response(['success' => false], 200),
        ]);

        $this->post(route('register.store'), [
            'name' => 'test',
            'email' => 'test@example.test',
            'email_confirmation' => 'test@example.test',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'g-recaptcha-response' => 'jeton-test',
        ])->assertSessionHasErrors('g-recaptcha-response');

        $this->assertDatabaseMissing('users', ['email' => 'test@example.test']);
    }
}
