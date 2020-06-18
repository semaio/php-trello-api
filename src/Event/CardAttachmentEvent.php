<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Event;

class CardAttachmentEvent extends CardEvent
{
    /**
     * @var array
     */
    protected $attachment;

    public function setAttachment($attachment): void
    {
        $this->attachment = $attachment;
    }

    public function getAttachment(): array
    {
        return $this->attachment;
    }
}
