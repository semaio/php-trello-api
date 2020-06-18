<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
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
use Semaio\TrelloApi\Client;
use Semaio\TrelloApi\Client\TrelloClientInterface;

class ClientTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_create_client(): void
    {
        $client = Client::create($this->getTrelloClientMock());

        static::assertInstanceOf(Client::class, $client);
    }

    /**
     * @test
     */
    public function it_can_retrieve_action_api(): void
    {
        static::assertInstanceOf(ActionApi::class, $this->getClient()->getActionApi());
    }

    /**
     * @test
     */
    public function it_can_retrieve_board_api(): void
    {
        static::assertInstanceOf(BoardApi::class, $this->getClient()->getBoardApi());
    }

    /**
     * @test
     */
    public function it_can_retrieve_card_api(): void
    {
        static::assertInstanceOf(CardApi::class, $this->getClient()->getCardApi());
    }

    /**
     * @test
     */
    public function it_can_retrieve_checklist_api(): void
    {
        static::assertInstanceOf(ChecklistApi::class, $this->getClient()->getChecklistApi());
    }

    /**
     * @test
     */
    public function it_can_retrieve_list_api(): void
    {
        static::assertInstanceOf(CardListApi::class, $this->getClient()->getCardListApi());
    }

    /**
     * @test
     */
    public function it_can_retrieve_member_api(): void
    {
        static::assertInstanceOf(MemberApi::class, $this->getClient()->getMemberApi());
    }

    /**
     * @test
     */
    public function it_can_retrieve_notification_api(): void
    {
        static::assertInstanceOf(NotificationApi::class, $this->getClient()->getNotificationApi());
    }

    /**
     * @test
     */
    public function it_can_retrieve_organization_api(): void
    {
        static::assertInstanceOf(OrganizationApi::class, $this->getClient()->getOrganizationApi());
    }

    /**
     * @test
     */
    public function it_can_retrieve_token_api(): void
    {
        static::assertInstanceOf(TokenApi::class, $this->getClient()->getTokenApi());
    }

    /**
     * @test
     */
    public function it_can_retrieve_webhook_api(): void
    {
        static::assertInstanceOf(WebhookApi::class, $this->getClient()->getWebhookApi());
    }

    protected function getClient(): Client
    {
        return new Client($this->getTrelloClientMock());
    }

    protected function getTrelloClientMock(): MockObject
    {
        return $this->getMockBuilder(TrelloClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
