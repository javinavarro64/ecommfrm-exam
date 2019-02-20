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

use App\Notifications\Domain\UsersRepository;
use App\Notifications\Infraestructure\Exceptions\SendMessageFailed;

/**
 *
 * @author Javier Navarro
 */
final class SendNotification extends AbstractJob
{
    
    /**
     * User identifier to notify
     *
     * @var int $id
     */
    private $userId;
    
    /**
     *
     * @var string
     */
    private $mailerType;
    
    /**
     *
     * @param int $userId
     * @param string $maylerType
     */
    public function __construct($userId, $mailerType)
    {
        $this->userId = $userId;
        $this->mailerType = $mailerType;
    }

    /**
     *
     * @param \App\Notifications\Infraestructure\MessageRandomizer $randomizer
     * @param \App\Notifications\Domain\UsersRepository $users
     * @return array
     */
    public function handle(MessageRandomizer $randomizer, UsersRepository $users)
    {
        $mailer = app($this->mailerType);
        
        $user = $users->find($this->userId);
        $message = $randomizer->get();
        
        $isMessageSended = $mailer->send($user->getEmail(), $message);
        if (!$isMessageSended) {
            throw new SendMessageFailed($user->getEmail());
        }
        
        info(sprintf("Notification sended to %s", $user->getEmail()));
        
        return new SendNotificationResponse($user, $message, $isMessageSended);
    }
}
