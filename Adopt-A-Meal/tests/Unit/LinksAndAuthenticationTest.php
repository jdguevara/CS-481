<?php
/**
 * Created by PhpStorm.
 * User: danielbakyono
 * Date: 2/25/18
 * Time: 8:47 PM
 */

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
class LinksAndAuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test for routes and views and authentication.
     *
     * @return void
     */
    public function testLinkAuthentication()
    {

        // Checking the Welcome page works fine
        $response = $this->get('/');
        $response->assertViewIs('welcome');
        $response->assertStatus(200);
        $this->assertGuest($guard = null);

        // Checking the /admin URL works fine
        $response = $this->get('/admin');
        //$response->assertViewIs('auth.login');
        $response->assertStatus(500);
        $this->assertGuest($guard = null);

        // Checking the meal-ideas URL works fine
        $response = $this->get('/meal-ideas');
        $response->assertViewIs('mealideas');
        $response->assertStatus(200);
        $this->assertGuest($guard = null);

        // Checking the login URL works fine
        $response = $this->get('/login');
        $response->assertViewIs('auth.login');
        $response->assertStatus(200);
        $this->assertGuest($guard = null);

        // Checking the authentication works fine
        $user = factory(User::class)->create();
        //dump($user);
        $response = $this->actingAs($user, 'api')
            ->withSession(['foo' => 'bar'])
            ->get('/');
        $this->assertAuthenticated($guard = 'api');
        $this->assertAuthenticatedAs($user, $guard = null);
    }
}