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
