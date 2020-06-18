<?php

declare(strict_types=1);

namespace Semaio\TrelloApi;

use Semaio\TrelloApi\Model\ActionModelInterface;
use Semaio\TrelloApi\Model\BoardModelInterface;
use Semaio\TrelloApi\Model\CardListModelInterface;
use Semaio\TrelloApi\Model\CardModelInterface;
use Semaio\TrelloApi\Model\ChecklistModelInterface;
use Semaio\TrelloApi\Model\MemberModelInterface;
use Semaio\TrelloApi\Model\OrganizationModelInterface;
use Semaio\TrelloApi\Model\TokenModelInterface;
use Semaio\TrelloApi\Model\WebhookModelInterface;

interface ManagerInterface
{
    /**
     * Get action by id.
     */
    public function getAction(string $id): ActionModelInterface;

    /**
     * Get board by id or create a new one.
     */
    public function getBoard(?string $id = null): BoardModelInterface;

    /**
     * Get card by id or create a new one.
     */
    public function getCard($id = null): CardModelInterface;

    /**
     * Get cardlist by id or create a new one.
     */
    public function getCardList(?string $id = null): CardListModelInterface;

    /**
     * Get checklist by id or create a new one.
     */
    public function getChecklist(?string $id = null): ChecklistModelInterface;

    /**
     * Get member by id or create a new one.
     */
    public function getMember(?string $id = null): MemberModelInterface;

    /**
     * Get organization by id or create a new one.
     */
    public function getOrganization(?string $id = null): OrganizationModelInterface;

    /**
     * Get token by id.
     */
    public function getToken(string $id): TokenModelInterface;

    /**
     * Get webhook by id.
     */
    public function getWebhook(string $id): WebhookModelInterface;
}
