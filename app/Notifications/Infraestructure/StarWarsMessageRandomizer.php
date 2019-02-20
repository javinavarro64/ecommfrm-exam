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
final class StarWarsMessageRandomizer implements MessageRandomizer
{

    /**
     *
     * @var string[]
     */
    private $messages = [
        'Help me, Obi-Wan Kenobi. You’re my only hope.',
        'I find your lack of faith disturbing.',
        'The Force will be with you. Always.',
        'Why, you stuck-up, half-witted, scruffy-looking nerf herder!',
        'Never tell me the odds!',
        'Do. Or do not. There is no try.',
        'No. I am your father.',
        'Now, young Skywalker, you will die.',
        'Just for once, let me look on you with my own eyes.',
        'I’m just a simple man trying to make my way in the universe.'
    ];
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \App\Notifications\Infraestructure\MessageRandomizer::get()
     */
    public function get()
    {
        return $this->messages[rand(0, count($this->messages)-1)];
    }
}
