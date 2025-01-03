<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class ClientsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_clients_can_see_dashboard()
    {
        $client = User::where('role', 'client')->first();

        $this->actingAs($client)
            ->get('admin/dashboard/resume')
            ->assertSee('Dashboard');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_clients_can_see_loans()
    {
        $client = User::where('role', 'client')->first();

        $this->actingAs($client)
            ->get('admin/loans')
            ->assertSee('Loans');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_clients_can_see_activities()
    {
        $client = User::where('role', 'client')->first();

        $this->actingAs($client)
            ->get('admin/activities')
            ->assertSee('Activities');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_clients_can_see_deposits()
    {
        $client = User::where('role', 'client')->first();

        $this->actingAs($client)
            ->get('admin/deposits')
            ->assertSee('Deposits');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_clients_can_see_monthly_summary()
    {
        $client = User::where('role', 'client')->first();

        $this->actingAs($client)
            ->get('admin/dashboard/summary')
            ->assertSee('Monthly');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_clients_can_see_whithrals()
    {
        $client = User::where('role', 'client')->first();

        $this->actingAs($client)
            ->get('admin/withdrawals')
            ->assertSee('Withdrawals');
    }
}
