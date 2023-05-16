<?php

namespace Tests\Feature;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Dashboard\Admin\ApprovalController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\RedirectResponse;
use Tests\TestCase;
use Illuminate\Http\Request;


class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
//    public function test_example(): void
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }

//    public function test_new_professor_can_register(): void
//    {
//        $response = $this->post('/register', [
//            'name' => 'Test prof',
//            'email' => 'exam@example.com',
//            'role' => 2,
//            'is_approved' => 1,
//            'password' => 'password',
//            'password_confirmation' => 'password',
//        ]);
//
//        $this->assertAuthenticated();
//        $response->assertRedirect(route('professor.dashboard'));
//    }

}
