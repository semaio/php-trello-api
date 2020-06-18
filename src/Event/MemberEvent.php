<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Event;

use Semaio\TrelloApi\Model\MemberModelInterface;

class MemberEvent extends AbstractEvent
{
    /**
     * @var MemberModelInterface
     */
    protected $member;

    public function setMember(MemberModelInterface $member): void
    {
        $this->member = $member;
    }

    public function getMember(): MemberModelInterface
    {
        return $this->member;
    }
}
