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
interface MessageRandomizer
{
    
    /**
     * Gets a random text message
     *
     * @return string
     */
    public function get();
}
