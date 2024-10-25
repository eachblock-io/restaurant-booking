<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminResetPasswordNotification;

class AdminPasswordResetTest extends TestCase
{
    public function test_forgot_password_sends_reset_email()
    {
        Notification::fake();

        $admin = Admin::factory()->create();

        $response = $this->postJson('/api/admin/forgot-password', [
            'email' => $admin->email,
        ]);

        $response->assertStatus(200);

        Notification::assertSentTo(
            [$admin], AdminResetPasswordNotification::class
        );
    }
}
