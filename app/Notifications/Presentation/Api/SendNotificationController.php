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
use App\Notifications\Domain\MessageRandomizer;
use App\Notifications\Domain\NotificationService;
use App\Notifications\Domain\UsersRepository;
use App\Notifications\Domain\Exceptions\SendMessageFailed;
use App\Notifications\Domain\Exceptions\UserNotFound;
use App\Notifications\Presentation\ResponseTransformer;

/**
 *
 * @author Javier Navarro
 */
final class SendNotificationController extends AbstractController
{
    
    /**
     *
     * @var \App\Notifications\Domain\NotificationService
     */
    private $notifier;
    
    /**
     *
     * @var \App\Notifications\Domain\UsersRepository
     */
    private $users;
    
    /**
     *
     * @var \App\Notifications\Domain\MessageRandomizer
     */
    private $randomizer;
    
    /**
     *
     * @var \App\Notifications\Presentation\ResponseTransformer
     */
    private $transformer;
    
    /**
     *
     * @param \App\Notifications\Domain\NotificationService $notifier
     * @param \App\Notifications\Domain\UsersRepository $users
     * @param \App\Notifications\Domain\MessageRandomizer $randomizer
     * @param \App\Notifications\Presentation\ResponseTransformer $transformer
     */
    public function __construct(
        NotificationService $notifier,
        UsersRepository $users,
        MessageRandomizer $randomizer,
        ResponseTransformer $transformer
    ) {
        $this->notifier = $notifier;
        $this->users = $users;
        $this->randomizer = $randomizer;
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
            $user = $this->users->find($id);
            $message = $this->randomizer->get();
            $result = $this->notifier->notify($user, $message);
            
            info(sprintf("Notification sended to %s", $user->getEmail()));
        } catch (UserNotFound $ex) {
            throw new ApiException(404, $ex->getMessage(), $ex);
        } catch (SendMessageFailed $ex) {
            throw new ApiException(200, $ex->getMessage(), $ex);
        }
        
        return $this->transformer->transform([
            'user' => $user,
            'message' => $message,
            'result' => $result
        ]);
    }
}
