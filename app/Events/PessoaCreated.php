<?php

namespace App\Events;

use App\Models\Pessoa;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PessoaCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Pessoa
     */
    public $pessoa;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }


}
