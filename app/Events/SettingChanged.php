<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Illuminate\Database\Eloquent\Model;
use App\Setting;

class SettingChanged
{
    use InteractsWithSockets, SerializesModels;

    public $setting;
    public $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Setting $setting, Model $model)
    {
        $this->setting = $setting;
        $this->model = $model;
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
