<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Event;

use Semaio\TrelloApi\Model\OrganizationModelInterface;

class BoardOrganizationEvent extends BoardEvent
{
    /**
     * @var OrganizationModelInterface
     */
    protected $organization;

    public function setOrganization(OrganizationModelInterface $organization): void
    {
        $this->organization = $organization;
    }

    public function getOrganization(): OrganizationModelInterface
    {
        return $this->organization;
    }
}
