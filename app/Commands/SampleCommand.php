<?php

namespace App\Commands;

use Core\Services\AbstractCommand;

class SampleCommand extends AbstractCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'sample:say-hello';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Just a simple example.';

    /**
     * Possible arguments of the command.
     *
     * @var array
     */
    protected $arguments = [
        'name' => ['type' => 'string', 'default' => 'Nobody', 'description' => 'Name'],
    ];

    /**
     * Possible options of the command.
     *
     * @var array
     */
    protected $options = [
        'bye' => ['type' => 'bool', 'short' => 'b', 'description' => 'Say Good By'],
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->input('bye')) {
            $this->line('Good by, ' . $this->input('name') . '.');
        }
        else {
            $this->line('Hello ' . $this->input('name') . '.');
        }
    }
}