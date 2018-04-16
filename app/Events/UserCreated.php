<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Cartalyst\Sentinel\Users\EloquentUser;

class UserCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $user;

    /**
     * Create a new event instance.
     *
     * @param EloquentUser $user
     * @return void
     */
    public function __construct(EloquentUser $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
