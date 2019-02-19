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

use App\Notifications\Domain\Exceptions\SendMessageFailed;

/**
 *
 * @author Javier Navarro
 */
final class NotificationService
{
    
    /**
     *
     * @var \App\Notifications\Domain\MailerProvider
     */
    private $mailer;
    
    /**
     *
     * @param \App\Notifications\Domain\MailerProvider $mailer
     */
    public function __construct(MailerProvider $mailer)
    {
        $this->mailer = $mailer;
    }
    
    /**
     *
     * @param \App\Notifications\Domain\UserEntity $user
     * @param string $message
     * @throws \App\Notifications\Domain\Exceptions\SendMessageFailed
     * @return boolean
     */
    public function notify(UserEntity $user, $message)
    {
        if (!$this->mailer->send($user->getEmail(), $message)) {
            throw new SendMessageFailed($user->getEmail());
        }
        
        return true;
    }
}
