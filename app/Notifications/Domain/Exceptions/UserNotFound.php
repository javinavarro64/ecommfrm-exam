<?php
/**
 *
 * @copyright Copyright (c) 2019 ECommerce Farm, SL
 * All rights reserved
 * Developed for ECommerce Farm, SL by:
 *
 * Javier Navarro
 */
namespace App\Notifications\Domain\Exceptions;

/**
 *
 * @author Javier Navarro
 */
final class UserNotFound extends \RuntimeException
{

    /**
     *
     * @param int $userId
     */
    public function __construct($userId)
    {
        parent::__construct(sprintf('User %d not found!', $userId), 10000);
    }
}
