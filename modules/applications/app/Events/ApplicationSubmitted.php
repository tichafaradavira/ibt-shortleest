<?php
namespace Modules\Applications\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApplicationSubmitted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    public $application;

    /**
     * OrderShipped constructor.
     * @param \Modules\Applications\Models\Application $application
     */
    public function __construct(\Modules\Applications\Models\Application $application)
    {
        $this->application = $application;
    }
}
