<?php

declare(strict_types=1);

namespace Semaio\TrelloApi;

use Semaio\TrelloApi\Api\ActionApi;
use Semaio\TrelloApi\Api\BoardApi;
use Semaio\TrelloApi\Api\CardApi;
use Semaio\TrelloApi\Api\CardListApi;
use Semaio\TrelloApi\Api\ChecklistApi;
use Semaio\TrelloApi\Api\LabelApi;
use Semaio\TrelloApi\Api\MemberApi;
use Semaio\TrelloApi\Api\NotificationApi;
use Semaio\TrelloApi\Api\OrganizationApi;
use Semaio\TrelloApi\Api\TokenApi;
use Semaio\TrelloApi\Api\WebhookApi;
use Semaio\TrelloApi\Client\TrelloClientInterface;

class Client implements ClientInterface
{
    /**
     * @var TrelloClientInterface
     */
    private $trelloClient;

    public function __construct(TrelloClientInterface $trelloClient)
    {
        $this->trelloClient = $trelloClient;
    }

    public static function create(TrelloClientInterface $trelloClient): ClientInterface
    {
        return new self($trelloClient);
    }

    /**
     * {@inheritdoc}
     */
    public function getTrelloClient(): TrelloClientInterface
    {
        return $this->trelloClient;
    }

    /**
     * {@inheritdoc}
     */
    public function getActionApi(): ActionApi
    {
        return new ActionApi($this->trelloClient);
    }

    /**
     * {@inheritdoc}
     */
    public function getBoardApi(): BoardApi
    {
        return new BoardApi($this->trelloClient);
    }

    /**
     * {@inheritdoc}
     */
    public function getCardApi(): CardApi
    {
        return new CardApi($this->trelloClient);
    }

    /**
     * {@inheritdoc}
     */
    public function getCardListApi(): CardListApi
    {
        return new CardListApi($this->trelloClient);
    }

    /**
     * {@inheritdoc}
     */
    public function getChecklistApi(): ChecklistApi
    {
        return new ChecklistApi($this->trelloClient);
    }

    /**
     * {@inheritdoc}
     */
    public function getLabelApi(): LabelApi
    {
        return new LabelApi($this->trelloClient);
    }

    /**
     * {@inheritdoc}
     */
    public function getMemberApi(): MemberApi
    {
        return new MemberApi($this->trelloClient);
    }

    /**
     * {@inheritdoc}
     */
    public function getNotificationApi(): NotificationApi
    {
        return new NotificationApi($this->trelloClient);
    }

    /**
     * {@inheritdoc}
     */
    public function getOrganizationApi(): OrganizationApi
    {
        return new OrganizationApi($this->trelloClient);
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenApi(): TokenApi
    {
        return new TokenApi($this->trelloClient);
    }

    /**
     * {@inheritdoc}
     */
    public function getWebhookApi(): WebhookApi
    {
        return new WebhookApi($this->trelloClient);
    }
}
