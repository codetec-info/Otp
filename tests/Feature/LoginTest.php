<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return
     */
    public function after_login_access_no_home_until_verified()
    {
        // $user = factory(User::class)->create();
        // $this->actingAs($user);

        $this->logInUser();
        $this->get('/home')->assertRedirect('/');
    }

    /**
     * @test
     *
     * @return
     */
    public function after_login_access_home_if_verified()
    {
        $this->logInUser(['isVerified' => 1]);
        $this->get('/home')->assertStatus(200);
    }
}
