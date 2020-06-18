<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Event;

use Semaio\TrelloApi\Model\PowerUpInterface;

class PowerUpEvent extends AbstractEvent
{
    /**
     * @var PowerUpInterface
     */
    protected $powerUp;

    public function setPowerUp(PowerUpInterface $powerUp): void
    {
        $this->powerUp = $powerUp;
    }

    public function getPowerUp(): PowerUpInterface
    {
        return $this->powerUp;
    }
}
