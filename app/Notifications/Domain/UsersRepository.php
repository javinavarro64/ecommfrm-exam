<?php
/**
 *
 * @copyright Copyright (c) 2019 ECommerce Farm, SL
 * All rights reserved
 * Developed for ECommerce Farm, SL by:
 *
 * Javier Navarro
 */
namespace App\Notifications\Domain;

/**
 *
 * @author Javier Navarro
 */
interface UsersRepository
{
    
    /**
     *
     * @param int $id
     * @throws \App\Notifications\Domain\Exceptions\UserNotFound
     * @return \App\Notifications\Domain\UserEntity
     */
    public function find($id);
    
    /**
     *
     * @param \App\Notifications\Domain\UserEntity $user
     * @return void
     */
    public function save(UserEntity $user);
}
