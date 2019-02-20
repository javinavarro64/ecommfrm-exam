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

use App\Exceptions\ApiException;
use App\Http\Controllers\AbstractController;
use App\Notifications\Domain\Exceptions\UserNotFound;
use App\Notifications\Infraestructure\SendNotification;
use App\Notifications\Infraestructure\Exceptions\SendMessageFailed;
use App\Notifications\Presentation\ResponseTransformer;
use App\Notifications\Infraestructure\MailerType;

/**
 *
 * @author Javier Navarro
 */
final class SendNotificationController extends AbstractController
{
    
    /**
     *
     * @var \App\Notifications\Presentation\ResponseTransformer
     */
    private $transformer;
    
    /**
     *
     * @param \App\Notifications\Presentation\ResponseTransformer $transformer
     */
    public function __construct(ResponseTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
    
    /**
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendNotification($id)
    {
        try {
            $jobResponse = $this->dispatchNow(new SendNotification($id, MailerType::SMTP));
            info(sprintf("Notification sended to %s", $jobResponse->getUser()->getEmail()));
        } catch (UserNotFound $ex) {
            throw new ApiException(404, $ex->getMessage(), $ex);
        } catch (SendMessageFailed $ex) {
            throw new ApiException(200, $ex->getMessage(), $ex);
        }
        
        return $this->transformer->transform($jobResponse->toArray());
    }
}
