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
class SmtpProvider implements MailerProvider
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Notifications\Infraestructure\MailerProvider::send()
     */
    public function send($email, $message)
    {
        return true;
    }
}
