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

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 *
 * @author Javier Navarro
 */
abstract class AbstractCommand extends Command
{
    use DispatchesJobs;
}
