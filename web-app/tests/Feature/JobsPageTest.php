<?php

namespace Tests\Feature;

use App\Jobs\TestEmailJob;
use App\Jobs\TestJob;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class JobsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_jobs_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/jobs');

        $response->assertStatus(200);
        $response->assertSee('Jobs List');
        $response->assertSee('Add Test Job');
        $response->assertSee('Add Test Email Send Job');
    }

    public function test_dispatches_test_job(): void
    {
        Queue::fake();

        $user = User::factory()->create();

        $this->actingAs($user)->post(route('jobs.test-job'));

        Queue::assertPushed(TestJob::class);
    }

    public function test_dispatches_test_email_job(): void
    {
        Queue::fake();

        $user = User::factory()->create();

        $this->actingAs($user)->post(route('jobs.test-email-job'));

        Queue::assertPushed(TestEmailJob::class);
    }
}
