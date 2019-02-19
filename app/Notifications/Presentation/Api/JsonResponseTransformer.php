<?php
/**
 *
 * @copyright Copyright (c) 2019 ECommerce Farm, SL
 * All rights reserved
 * Developed for ECommerce Farm, SL by:
 *
 * Javier Navarro
 */
namespace App\Notifications\Presentation\Api;

use App\Notifications\Presentation\ResponseTransformer;

/**
 *
 * @author Javier Navarro
 */
final class JsonResponseTransformer implements ResponseTransformer
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Notifications\Presentation\ResponseTransformer::transform()
     */
    public function transform(array $data)
    {
        return response()->json([
            'id' => $data['user']->getId(),
            'email' => $data['user']->getEmail(),
            'message' => $data['message'],
            'result' => $data['result']
        ]);
    }
}
