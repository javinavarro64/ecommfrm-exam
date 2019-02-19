<?php
/**
 *
 * @copyright Copyright (c) 2019 ECommerce Farm, SL
 * All rights reserved
 * Developed for ECommerce Farm, SL by:
 *
 * Javier Navarro
 */
namespace App\Notifications\Presentation\Exceptions;

/**
 *
 * @author Javier Navarro
 */
final class TransformationError extends \RuntimeException
{
    
    /**
     *
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code = 10100)
    {
        parent::__construct($message, $code);
    }
}
