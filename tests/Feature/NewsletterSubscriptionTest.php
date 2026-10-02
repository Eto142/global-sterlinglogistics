<?php

namespace Tests\Feature;

use Tests\TestCase;

class NewsletterSubscriptionTest extends TestCase
{
    public function test_subscribe_now_posts_to_the_newsletter_route(): void
    {
        $response = $this->withSession(['_token' => 'test-token'])
            ->post('/newsletter/subscribe', [
                '_token' => 'test-token',
                'email' => 'subscriber@example.com',
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }
}
