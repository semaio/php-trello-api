<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Event;

use Semaio\TrelloApi\Model\ChecklistModelInterface;

class CardChecklistEvent extends CardEvent
{
    /**
     * @var ChecklistModelInterface
     */
    protected $checklist;

    public function setChecklist(ChecklistModelInterface $checklist): void
    {
        $this->checklist = $checklist;
    }

    public function getChecklist(): ChecklistModelInterface
    {
        return $this->checklist;
    }
}
