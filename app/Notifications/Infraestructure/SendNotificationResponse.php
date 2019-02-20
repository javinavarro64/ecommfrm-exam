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

use App\Notifications\Domain\UserEntity;

/**
 *
 * @author Javier Navarro
 */
final class SendNotificationResponse
{
    
    /**
     *
     * @var \App\Notifications\Domain\UserEntity
     */
    private $user;
    
    /**
     * Message sended
     *
     * @var string
     */
    private $message;
    
    /**
     * Send operation result
     *
     * @var boolean
     */
    private $result;
    
    /**
     *
     * @param \App\Notifications\Domain\UserEntity $user
     * @param string $message
     * @param boolean $result
     */
    public function __construct(UserEntity $user, $message, $result)
    {
        $this->user = $user;
        $this->message = $message;
        $this->result = $result;
    }

    /**
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'user' => $this->user,
            'message' => $this->message,
            'result' => $this->result
        ];
    }
    
    /**
     *
     * @return \App\Notifications\Domain\UserEntity
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     *
     * @return boolean
     */
    public function getResult()
    {
        return $this->result;
    }
}
