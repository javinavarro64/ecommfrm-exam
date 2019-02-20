<?php
/**
 *
 * @copyright Copyright (c) 2019 ECommerce Farm, SL
 * All rights reserved
 * Developed for ECommerce Farm, SL by:
 *
 * Javier Navarro
 */
namespace Tests\Notifications;

use App\Notifications\Infraestructure\MailerProvider;
use App\Notifications\Infraestructure\MessageRandomizer;
use Tests\TestCase;

/**
 *
 * @author Javier Navarro
 */
class SendNotificationControllerTest extends TestCase
{
    
    /**
     * 
     * @var \App\Notifications\Infraestructure\MessageRandomizer|\Mockery\MockInterface
     */
    private $randomizer;
    
    /**
     * 
     * {@inheritDoc}
     *
     * @see \Illuminate\Foundation\Testing\TestCase::setUp()
     */
    public function setUp()
    {
        parent::setUp();
        
        $this->randomizer = \Mockery::mock(MessageRandomizer::class);
        $this->app->instance(MessageRandomizer::class, $this->randomizer);
        $this->randomizer->shouldReceive('get')->andReturn('Never tell me the odds!');
    }
    
    /**
     * 
     * @return void
     */
    public function testSendNotificationOk()
    {
        $response = $this->get('/api/v1/users/send_notification/1');
        
        $response->assertStatus(200);
    }
    
    /**
     *
     * @return void
     */
    public function testSendNotificationWithoutRequiredUserIdentifier()
    {
        $response = $this->get('/api/v1/users/send_notification');
        
        $response->assertStatus(404)
            ->assertJson([
                'error' => 'Resource not found!'
            ]);
        
    }
    
    /**
     *
     * @return void
     */
    public function testSendNotificationWithTextualUserIdentifier()
    {
        $response = $this->get('/api/v1/users/send_notification/uno');
        
        $response->assertStatus(404)
            ->assertJson([
                'error' => 'Resource not found!'
            ]);
    }
    
    /**
     * 
     * @return void
     */
    public function testSendNotificationWhenUserIsNotFound()
    {
        $response = $this->get('/api/v1/users/send_notification/3');
        
        $response->assertStatus(404)
            ->assertJson([
                'error' => 'User 3 not found!',
                'code' => 10000
            ]);
    }
    
    /**
     * 
     * @return void
     */
    public function testSendNotificationWhenSendMessageFails()
    {
        $mailer = \Mockery::mock(MailerProvider::class);
        $this->app->instance('smtp', $mailer);
        
        $mailer->shouldReceive('send')->andReturn(false);
        
        $response = $this->get('/api/v1/users/send_notification/2');
        
        $response->assertStatus(200)
            ->assertJson([
                'error' => 'Message for email luke@ecommfarm.com could not be sended!',
                'code' => 10001
            ]);
    }
}
