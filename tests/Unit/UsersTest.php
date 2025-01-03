<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class UsersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_users_can_see_dashboard()
    {
        $user = User::where('role', 'user')->first();

        $this->actingAs($user)
            ->get('admin/dashboard/resume')
            ->assertSee('User information');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_users_can_see_loans()
    {
        $user = User::where('role', 'user')->first();

        $this->actingAs($user)
            ->get('admin/loans')
            ->assertSee('Loans');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_users_can_see_activities()
    {
        $user = User::where('role', 'user')->first();

        $this->actingAs($user)
            ->get('admin/activities')
            ->assertSee('Activities');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_users_deposits_unauthorized()
    {
        $user = User::where('role', 'user')->first();

        $response = $this->actingAs($user)
            ->get('admin/deposits');

        $response->assertRedirect('/admin/dashboard/resume');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_users_whithrals_unauthorized()
    {
        $user = User::where('role', 'user')->first();

        $response = $this->actingAs($user)
            ->get('admin/withdrawals');

        $response->assertRedirect('/admin/dashboard/resume');
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_users_cant_see_monthlu_summary()
    {
        $user = User::where('role', 'user')->first();

        $response = $this->actingAs($user)
            ->get('admin/dashboard/summary');

        $response->assertRedirect('/admin/dashboard/resume');
    }

}
