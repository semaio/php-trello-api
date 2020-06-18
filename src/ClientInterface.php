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
    public function getTrelloClient(): TrelloClientInterface;

    public function getActionApi(): ActionApi;

    public function getBoardApi(): BoardApi;

    public function getCardApi(): CardApi;

    public function getCardListApi(): CardListApi;

    public function getChecklistApi(): ChecklistApi;

    public function getMemberApi(): MemberApi;

    public function getNotificationApi(): NotificationApi;

    public function getOrganizationApi(): OrganizationApi;

    public function getTokenApi(): TokenApi;

    public function getWebhookApi(): WebhookApi;
}
