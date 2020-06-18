<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Event;

use Semaio\TrelloApi\Model\OrganizationModelInterface;

class OrganizationEvent extends AbstractEvent
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
