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
interface MailerProvider
{

    /**
     * Send message to the email address
     *
     * @param string $email
     * @param string $message
     * @return boolean
     */
    public function send($email, $message);
}
