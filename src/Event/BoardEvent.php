<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Event;

use Semaio\TrelloApi\Model\BoardModelInterface;

class BoardEvent extends AbstractEvent
{
    /**
     * @var BoardModelInterface
     */
    protected $board;

    public function setBoard(BoardModelInterface $board): void
    {
        $this->board = $board;
    }

    public function getBoard(): BoardModelInterface
    {
        return $this->board;
    }
}
