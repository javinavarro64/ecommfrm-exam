<?php
/**
 * 
 * @copyright Copyright (c) 2019 Javier Navarro
 * All rights reserved
 */
namespace Tests\Notifications;

use App\Notifications\Domain\MessageRandomizer;
use App\Notifications\Domain\Exceptions\SendMessageFailed;
use App\Notifications\Domain\Exceptions\UserNotFound;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Notifications\Domain\MailerProvider;

/**
 *
 * @author Javier Navarro
 */
class SendNotificationCommandTest extends TestCase
{
    
    /**
     * 
     * @var \App\Notifications\Domain\MessageRandomizer|\Mockery\MockInterface
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
        Artisan::call('send_notification', ['id' => '1']);
        
        $this->assertEquals("User id: 1\nEmail: anakin@ecommfarm.com\nMessage: Never tell me the odds!\nResult: Ok\n", Artisan::output());
    }

    /**
     *
     * @return void
     */
    public function testSendNotificationWithoutRequiredUserIdentifier()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage("Not enough arguments (missing: \"id\").");
        
        Artisan::call('send_notification', []);
    }
    
    /**
     *
     * @return void
     */
    public function testSendNotificationWithoutNumericUserIdentifier()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("The \"id\" argument must be a numeric value!");
        
        Artisan::call('send_notification', ['id' => 'one']);
    }
    
    /**
     * 
     * @return void
     */
    public function testSendNotificationWhenUserIsNotFound()
    {
        $this->expectException(UserNotFound::class);
        $this->expectExceptionMessage("User 3 not found!");
        $this->expectExceptionCode(10000);
        
        Artisan::call('send_notification', ['id' => '3']);
    }
    
    /**
     * 
     * @return void
     */
    public function testSendNotificationWhenSendMessageFails()
    {
        $mailer = \Mockery::mock(MailerProvider::class);
        $this->app->instance('ses', $mailer);
        
        $mailer->shouldReceive('send')->andReturn(false);
        
        $this->expectException(SendMessageFailed::class);
        $this->expectExceptionMessage("Message for email luke@ecommfarm.com could not be sended!");
        $this->expectExceptionCode(10001);
        
        Artisan::call('send_notification', ['id' => '2']);
    }
}
