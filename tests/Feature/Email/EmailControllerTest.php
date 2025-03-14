<?php

namespace Email;

use App\Jobs\SendSubscribedNotification;
use App\Models\Email;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class EmailControllerTest extends TestCase
{
    /**
     * Test storing a valid email.
     */
    public function test_store_valid_email(): void
    {
        // Arrange
        Queue::fake();
        $email = 'test@example.com';

        // Act
        $response = $this->postJson('/api/subscribe', ['email' => $email]);

        // Assert
        $response->assertStatus(201)
            ->assertJson(['message' => 'Store successful for email ' . $email]);

        $this->assertDatabaseHas('emails', ['email' => $email]);

        Queue::assertPushed(SendSubscribedNotification::class, function ($job) use ($email) {
            return $job->email->email === $email;
        });
    }

    /**
     * Test storing an invalid email.
     */
    public function test_store_invalid_email(): void
    {
        // Arrange
        Queue::fake();

        // Act
        $response = $this->postJson('/api/subscribe', ['email' => 'invalid-email']);

        // Assert
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

        $this->assertDatabaseCount('emails', 0);

        Queue::assertNotPushed(SendSubscribedNotification::class);
    }

    /**
     * Test storing a duplicate email.
     */
    public function test_store_duplicate_email(): void
    {
        // Arrange
        Queue::fake();
        $email = 'test@example.com';
        Email::factory()->create(['email' => $email]);

        // Act
        $response = $this->postJson('/api/subscribe', ['email' => $email]);

        // Assert
        $response->assertStatus(201)
            ->assertJson(['message' => 'Store successful for email ' . $email]);

        $this->assertDatabaseCount('emails', 1);

        Queue::assertPushed(SendSubscribedNotification::class, function ($job) use ($email) {
            return $job->email->email === $email;
        });
    }
}
