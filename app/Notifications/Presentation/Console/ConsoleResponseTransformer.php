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

use App\Notifications\Presentation\ResponseTransformer;
use App\Notifications\Presentation\Exceptions\TransformationError;
use Illuminate\Console\OutputStyle;

/**
 *
 * @author Javier Navarro
 */
final class ConsoleResponseTransformer implements ResponseTransformer
{
    
    /**
     *
     * @var \Illuminate\Console\OutputStyle
     */
    private $output;

    /**
     *
     * @param \Illuminate\Console\OutputStyle $output
     * @return \App\Notifications\Presentation\Console\ConsoleResponseTransformer
     */
    public function setOutput(OutputStyle $output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \App\Notifications\Presentation\ResponseTransformer::transform()
     */
    public function transform(array $data)
    {
        $this->assertOutputNotNull();

        $this->output->writeln(sprintf("User id: %d", $data['user']->getId()));
        $this->output->writeln(sprintf("Email: %s", $data['user']->getEmail()));
        $this->output->writeln(sprintf("Message: %s", $data['message']));
        $this->output->writeln(sprintf("Result: %s", $data['result'] ? 'Ok' : 'Error'));
    }

    /**
     *
     * @throws \RuntimeException
     * @return void
     */
    private function assertOutputNotNull()
    {
        if (is_null($this->output)) {
            throw new TransformationError('Output must be inialized, console transformer must invoke setOutput() before transform!');
        }
    }
}
