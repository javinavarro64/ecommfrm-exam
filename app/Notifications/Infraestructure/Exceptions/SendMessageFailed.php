<?php
/**
 *
 * @copyright Copyright (c) 2019 ECommerce Farm, SL
 * All rights reserved
 * Developed for ECommerce Farm, SL by:
 *
 * Javier Navarro
 */
namespace App\Notifications\Infraestructure\Exceptions;

/**
 *
 * @author Javier Navarro
 */
final class SendMessageFailed extends \RuntimeException
{
    
    /**
     *
     * @param string $email
     */
    public function __construct($email)
    {
        parent::__construct(sprintf("Message for email %s could not be sended!", $email), 10001);
    }
}
