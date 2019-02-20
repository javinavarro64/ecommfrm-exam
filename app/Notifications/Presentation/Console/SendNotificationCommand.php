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

use App\Notifications\Infraestructure\MailerType;
use App\Notifications\Infraestructure\SendNotification;
use App\Notifications\Presentation\AbstractCommand;
use App\Notifications\Presentation\ResponseTransformer;

/**
 *
 * @author Javier Navarro
 */
final class SendNotificationCommand extends AbstractCommand
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
     * @var \App\Notifications\Presentation\ResponseTransformer
     */
    private $transformer;
    
    /**
     *
     * @param \App\Notifications\Presentation\ResponseTransformer $transformer
     */
    public function __construct(ResponseTransformer $transformer)
    {
        parent::__construct();
        
        $this->transformer = $transformer;
    }
    
    /**
     * Run the command
     *
     * @throws \RuntimeException|\InvalidArgumentException|\App\Notifications\Domain\Exceptions\UserNotFound|\App\Notifications\Infraestructure\Exceptions\SendMessageFailed
     * @return void
     */
    public function handle()
    {
        $id = $this->getUserIdentifier();
        $jobResponse = $this->dispatchNow(new SendNotification($id, MailerType::SES));
        info(sprintf("Notification sended to %s", $jobResponse->getUser()->getEmail()));
        
        $this->transformer->setOutput($this->output)->transform($jobResponse->toArray());
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
