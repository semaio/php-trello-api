<?php

declare(strict_types=1);

namespace Semaio\TrelloApi;

use Semaio\TrelloApi\Api\ActionApi;
use Semaio\TrelloApi\Api\BoardApi;
use Semaio\TrelloApi\Api\CardApi;
use Semaio\TrelloApi\Api\CardListApi;
use Semaio\TrelloApi\Api\ChecklistApi;
use Semaio\TrelloApi\Api\MemberApi;
use Semaio\TrelloApi\Api\NotificationApi;
use Semaio\TrelloApi\Api\OrganizationApi;
use Semaio\TrelloApi\Api\TokenApi;
use Semaio\TrelloApi\Api\WebhookApi;
use Semaio\TrelloApi\Client\TrelloClientInterface;

interface ClientInterface
{
    /**
     * Get the Trello client.
     */
    public function getTrelloClient(): TrelloClientInterface;

    /**
     * Get the Trello API Action.
     */
    public function getActionApi(): ActionApi;

    /**
     * Get the Trello API Board.
     */
    public function getBoardApi(): BoardApi;

    /**
     * Get the Trello API Card.
     */
    public function getCardApi(): CardApi;

    /**
     * Get the Trello API CardList.
     */
    public function getCardListApi(): CardListApi;

    /**
     * Get the Trello API Checklist.
     */
    public function getChecklistApi(): ChecklistApi;

    /**
     * Get the Trello API Member.
     */
    public function getMemberApi(): MemberApi;

    /**
     * Get the Trello API Notification.
     */
    public function getNotificationApi(): NotificationApi;

    /**
     * Get the Trello API Organization.
     */
    public function getOrganizationApi(): OrganizationApi;

    /**
     * Get the Trello API Token.
     */
    public function getTokenApi(): TokenApi;

    /**
     * Get the Trello API Webhook.
     */
    public function getWebhookApi(): WebhookApi;
}
