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

use App\Notifications\Domain\MailerProvider;

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
     * @see \App\Notifications\Domain\MailerProvider::send()
     */
    public function send($email, $message)
    {
        return true;
    }
}
