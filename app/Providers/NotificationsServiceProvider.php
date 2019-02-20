<?php
/**
 *
 * @copyright Copyright (c) 2019 ECommerce Farm, SL
 * All rights reserved
 * Developed for ECommerce Farm, SL by:
 *
 * Javier Navarro
 */
namespace App\Providers;

use App\Notifications\Domain\UserEntity;
use App\Notifications\Domain\UsersRepository;
use App\Notifications\Infraestructure\MailerType;
use App\Notifications\Infraestructure\MessageRandomizer;
use App\Notifications\Infraestructure\SesProvider;
use App\Notifications\Infraestructure\SmtpProvider;
use App\Notifications\Infraestructure\StarWarsMessageRandomizer;
use App\Notifications\Infraestructure\UsersInMemoryRepository;
use App\Notifications\Presentation\ResponseTransformer;
use App\Notifications\Presentation\Api\JsonResponseTransformer;
use App\Notifications\Presentation\Api\SendNotificationController;
use App\Notifications\Presentation\Console\ConsoleResponseTransformer;
use App\Notifications\Presentation\Console\SendNotificationCommand;
use Carbon\Laravel\ServiceProvider;

/**
 *
 * @author Javier Navarro
 */
final class NotificationsServiceProvider extends ServiceProvider
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \Carbon\Laravel\ServiceProvider::register()
     */
    public function register()
    {
        $this->app->bind(UsersRepository::class, function () {
            $users = new UsersInMemoryRepository();
            $users->save(new UserEntity(1, 'Anakin', 'anakin@ecommfarm.com'));
            $users->save(new UserEntity(2, 'Luke', 'luke@ecommfarm.com'));
            
            return $users;
        });
        
        $this->app->bind(MessageRandomizer::class, function () {
            return new StarWarsMessageRandomizer();
        });
        
        $this->app->bind(MailerType::SMTP, function () {
            return new SmtpProvider();
        });
        
        $this->app->bind(MailerType::SES, function () {
            return new SesProvider();
        });
        
        $this->app->when(SendNotificationController::class)
            ->needs(ResponseTransformer::class)
            ->give(function () {
                return new JsonResponseTransformer();
            });
        
        $this->app->when(SendNotificationCommand::class)
            ->needs(ResponseTransformer::class)
            ->give(function () {
                return new ConsoleResponseTransformer();
            });
    }
}
