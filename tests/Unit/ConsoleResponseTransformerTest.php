<?php
/**
 *
 * @copyright Copyright (c) 2019 ECommerce Farm, SL
 * All rights reserved
 * Developed for ECommerce Farm, SL by:
 *
 * Javier Navarro
 */
namespace Tests\Unit;

use App\Notifications\Presentation\Console\ConsoleResponseTransformer;
use App\Notifications\Presentation\Exceptions\TransformationError;
use Tests\TestCase;

/**
 *
 * @author Javier Navarro
 */
class ConsoleResponseTransformerTest extends TestCase
{
    
    /**
     *
     * @return void
     */
    public function testWhenOutputIsNull()
    {
        $this->expectException(TransformationError::class);
        $this->expectExceptionMessage("Output must be inialized, console transformer must invoke setOutput() before transform!");
        $this->expectExceptionCode(10100);
        
        (new ConsoleResponseTransformer())->transform(['empty data']);
    }
}
