<?php
/**
 *
 * @copyright Copyright (c) 2019 ECommerce Farm, SL
 * All rights reserved
 * Developed for ECommerce Farm, SL by:
 *
 * Javier Navarro
 */
namespace App\Notifications\Infraestructure;

use App\Notifications\Domain\UserEntity;
use App\Notifications\Domain\UsersRepository;
use App\Notifications\Domain\Exceptions\UserNotFound;

/**
 *
 * @author Javier Navarro
 */
class UsersInMemoryRepository implements UsersRepository
{

    /**
     *
     * @var array
     */
    private $map = [];

    /**
     *
     * {@inheritDoc}
     *
     * @see \App\Notifications\Domain\UsersRepository::find()
     */
    public function find($id)
    {
        if (!array_key_exists($id, $this->map)) {
            throw new UserNotFound($id);
        }
        
        return $this->map[$id];
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \App\Notifications\Domain\UsersRepository::save()
     */
    public function save(UserEntity $user)
    {
        $this->map[$user->getId()] = $user;
    }
}
