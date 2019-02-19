<?php
/**
 *
 * @copyright Copyright (c) 2019 ECommerce Farm, SL
 * All rights reserved
 * Developed for ECommerce Farm, SL by:
 *
 * Javier Navarro
 */
namespace App\Notifications\Presentation;

/**
 *
 * @author Javier Navarro
 */
interface ResponseTransformer
{
    
    /**
     * Gets transformed response
     *
     * @param array $data
     * @throws \App\Notifications\Presentation\Exceptions\TransformationError
     * @return mixed
     */
    public function transform(array $data);
}
