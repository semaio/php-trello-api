<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Event;

use Semaio\TrelloApi\Model\CardListModelInterface;

class CardListEvent extends AbstractEvent
{
    /**
     * @var CardListModelInterface
     */
    protected $list;

    public function setList(CardListModelInterface $list): void
    {
        $this->list = $list;
    }

    public function getList(): CardListModelInterface
    {
        return $this->list;
    }
}
