<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Event;

class CardCommentEvent extends CardEvent
{
    /**
     * @var string
     */
    protected $comment;

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getComment(): string
    {
        return $this->comment;
    }
}
