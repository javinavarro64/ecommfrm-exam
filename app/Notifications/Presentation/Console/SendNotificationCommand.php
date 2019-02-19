<?php
/**
 *
 * @copyright Copyright (c) 2019 ECommerce Farm, SL
 * All rights reserved
 * Developed for ECommerce Farm, SL by:
 *
 * Javier Navarro
 */
namespace App\Notifications\Presentation\Console;

use App\Notifications\Domain\MessageRandomizer;
use App\Notifications\Domain\NotificationService;
use App\Notifications\Domain\UsersRepository;
use App\Notifications\Presentation\ResponseTransformer;
use Illuminate\Console\Command;

/**
 *
 * @author Javier Navarro
 */
final class SendNotificationCommand extends Command
{
    
    /**
     *
     * @var string
     */
    protected $signature = 'send_notification {id}';
    

    /**
     *
     * @var string
     */
    protected $description = 'Send a random message to the user';
    
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
        ResponseTransformer $transformer)
    {
        parent::__construct();
        
        $this->notifier = $notifier;
        $this->users = $users;
        $this->randomizer = $randomizer;
        $this->transformer = $transformer;
    }
    
    /**
     * Run the command
     *
     * @throws \RuntimeException|\InvalidArgumentException|\App\Notifications\Domain\Exceptions\UserNotFound|\App\Notifications\Domain\Exceptions\SendMessageFailed
     * @return void
     */
    public function handle()
    {
        $id = $this->getUserIdentifier();
        $user = $this->users->find($id);
        $message = $this->randomizer->get();
        $result = $this->notifier->notify($user, $message);
        
        info(sprintf("Notification sended to %s", $user->getEmail()));
        
        $this->transformer->setOutput($this->output)->transform([
            'user' => $user,
            'message' => $message,
            'result' => $result
        ]);
    }
    
    /**
     * Gets and validates the user identifier
     *
     * @throws \RuntimeException|\InvalidArgumentException
     * @return int
     */
    private function getUserIdentifier()
    {
        $id = $this->argument('id');
        if (!is_numeric($id)) {
            throw new \InvalidArgumentException("The \"id\" argument must be a numeric value!");
        }
        
        return $id;
    }
}
