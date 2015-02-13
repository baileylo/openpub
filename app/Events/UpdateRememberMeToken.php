<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;

class UpdateRememberMeToken extends Event
{
    use SerializesModels;

    /** @var Authenticatable */
    private $user;

    /** @var string */
    private $newToken;

    /**
     * Create a new event instance.
     *
     * @param Authenticatable $user
     * @param String          $newToken
     */
    public function __construct(Authenticatable $user, $newToken)
    {
        $this->user = $user;
        $this->newToken = $newToken;
    }

    /**
     * @return Authenticatable
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getNewToken()
    {
        return $this->newToken;
    }

}
