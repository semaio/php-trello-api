<?php

declare(strict_types=1);

namespace Semaio\TrelloApi;

use Semaio\TrelloApi\Model\ActionModel;
use Semaio\TrelloApi\Model\ActionModelInterface;
use Semaio\TrelloApi\Model\BoardModel;
use Semaio\TrelloApi\Model\BoardModelInterface;
use Semaio\TrelloApi\Model\CardListModel;
use Semaio\TrelloApi\Model\CardListModelInterface;
use Semaio\TrelloApi\Model\CardModel;
use Semaio\TrelloApi\Model\CardModelInterface;
use Semaio\TrelloApi\Model\ChecklistModel;
use Semaio\TrelloApi\Model\ChecklistModelInterface;
use Semaio\TrelloApi\Model\MemberModel;
use Semaio\TrelloApi\Model\MemberModelInterface;
use Semaio\TrelloApi\Model\OrganizationModel;
use Semaio\TrelloApi\Model\OrganizationModelInterface;
use Semaio\TrelloApi\Model\TokenModel;
use Semaio\TrelloApi\Model\TokenModelInterface;
use Semaio\TrelloApi\Model\WebhookModelInterface;

class Manager implements ManagerInterface
{
    /**
     * Constructor.
     */
    public function __construct(protected ClientInterface $client)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getAction(string $id): ActionModelInterface
    {
        return new ActionModel($this->client, $this->client->getActionApi(), $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getBoard(?string $id = null): BoardModelInterface
    {
        return new BoardModel($this->client, $this->client->getBoardApi(), $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getCard($id = null): CardModelInterface
    {
        return new CardModel($this->client, $this->client->getCardApi(), $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getCardList(?string $id = null): CardListModelInterface
    {
        return new CardListModel($this->client, $this->client->getCardListApi(), $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getChecklist(?string $id = null): ChecklistModelInterface
    {
        return new ChecklistModel($this->client, $this->client->getChecklistApi(), $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getMember(?string $id = null): MemberModelInterface
    {
        return new MemberModel($this->client, $this->client->getMemberApi(), $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getOrganization(?string $id = null): OrganizationModelInterface
    {
        return new OrganizationModel($this->client, $this->client->getOrganizationApi(), $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getToken(string $id): TokenModelInterface
    {
        return new TokenModel($this->client, $this->client->getTokenApi(), $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getWebhook(string $id): WebhookModelInterface
    {
        return new Model\WebhookModel($this->client, $this->client->getWebhookApi(), $id);
    }
}
