<?php
/**
 *
 * @copyright Copyright (c) 2019 ECommerce Farm, SL
 * All rights reserved
 * Developed for ECommerce Farm, SL by:
 *
 * Javier Navarro
 */
namespace Tests\Unit;

use App\Notifications\Domain\UsersRepository;
use Tests\TestCase;
use App\Notifications\Domain\Exceptions\UserNotFound;

/**
 *
 * @author Javier Navarro
 */
class UsersInMemoryRepositoryTest extends TestCase
{
    
    /**
     * 
     * @return void
     */
    public function testWhenUserNotFound()
    {
        $this->expectException(UserNotFound::class);
        $this->expectExceptionMessage("User 3 not found!");
        $this->expectExceptionCode(10000);
        
        $this->app->make(UsersRepository::class)->find(3);
    }
}
