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
final class UserEntity
{

    /**
     *
     * @var int
     */
    private $id;
    
    /**
     *
     * @var string
     */
    private $name;

    /**
     *
     * @var string
     */
    private $email;

    /**
     *
     * @param int $id
     * @param string $name
     * @param string $email
     */
    public function __construct($id, $name, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }
    
    /**
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
