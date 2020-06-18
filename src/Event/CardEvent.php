<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Event;

use Semaio\TrelloApi\Model\CardModelInterface;

class CardEvent extends AbstractEvent
{
    /**
     * @var CardModelInterface
     */
    protected $card;

    /**
     * @var string
     */
    protected $previousListName;

    /**
     * @var string
     */
    protected $nextListName;

    public function getCard(): CardModelInterface
    {
        return $this->card;
    }

    public function setCard(CardModelInterface $card): void
    {
        $this->card = $card;
    }

    public function getPreviousListName(): string
    {
        return $this->previousListName;
    }

    public function setPreviousListName(string $previousListName): void
    {
        $this->previousListName = $previousListName;
    }

    public function getNextListName(): string
    {
        return $this->nextListName;
    }

    public function setNextListName(string $nextListName): void
    {
        $this->nextListName = $nextListName;
    }
}
