<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Semaio\TrelloApi\Client;
use Semaio\TrelloApi\Client\TrelloClientInterface;
use Semaio\TrelloApi\Manager;
use Semaio\TrelloApi\Model\ActionModelInterface;
use Semaio\TrelloApi\Model\BoardModelInterface;
use Semaio\TrelloApi\Model\CardListModelInterface;
use Semaio\TrelloApi\Model\CardModelInterface;
use Semaio\TrelloApi\Model\ChecklistModelInterface;
use Semaio\TrelloApi\Model\MemberModelInterface;
use Semaio\TrelloApi\Model\OrganizationModelInterface;
use Semaio\TrelloApi\Model\TokenModelInterface;
use Semaio\TrelloApi\Model\WebhookModelInterface;

class ManagerTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_retrieve_action_model(): void
    {
        static::assertInstanceOf(
            ActionModelInterface::class,
            $this->getManager(true)->getAction('12345')
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_board_model(): void
    {
        static::assertInstanceOf(
            BoardModelInterface::class,
            $this->getManager(false)->getBoard()
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_board_model_with_id(): void
    {
        static::assertInstanceOf(
            BoardModelInterface::class,
            $this->getManager(true)->getBoard('12345')
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_card_model(): void
    {
        static::assertInstanceOf(
            CardModelInterface::class,
            $this->getManager(false)->getCard()
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_card_model_with_id(): void
    {
        static::assertInstanceOf(
            CardModelInterface::class,
            $this->getManager(true)->getCard('12345')
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_cardlist_model(): void
    {
        static::assertInstanceOf(
            CardListModelInterface::class,
            $this->getManager(false)->getCardList()
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_cardlist_model_with_id(): void
    {
        static::assertInstanceOf(
            CardListModelInterface::class,
            $this->getManager(true)->getCardList('12345')
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_checklist_model(): void
    {
        static::assertInstanceOf(
            ChecklistModelInterface::class,
            $this->getManager(false)->getChecklist()
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_checklist_model_with_id(): void
    {
        static::assertInstanceOf(
            ChecklistModelInterface::class,
            $this->getManager(true)->getChecklist('12345')
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_member_model(): void
    {
        static::assertInstanceOf(
            MemberModelInterface::class,
            $this->getManager(false)->getMember()
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_member_model_with_id(): void
    {
        static::assertInstanceOf(
            MemberModelInterface::class,
            $this->getManager(true)->getMember('12345')
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_organization_model(): void
    {
        static::assertInstanceOf(
            OrganizationModelInterface::class,
            $this->getManager(false)->getOrganization()
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_organization_model_with_id(): void
    {
        static::assertInstanceOf(
            OrganizationModelInterface::class,
            $this->getManager(true)->getOrganization('12345')
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_token_model(): void
    {
        static::assertInstanceOf(
            TokenModelInterface::class,
            $this->getManager(true)->getToken('12345')
        );
    }

    /**
     * @test
     */
    public function it_can_retrieve_webhook_model(): void
    {
        static::assertInstanceOf(
            WebhookModelInterface::class,
            $this->getManager(true)->getWebhook('12345')
        );
    }

    private function getManager(bool $expectsGetMethodCalled)
    {
        return new Manager($this->getClient($expectsGetMethodCalled));
    }

    private function getClient(bool $expectsGetMethodCalled)
    {
        return Client::create($this->getTrelloClientMock($expectsGetMethodCalled));
    }

    private function getTrelloClientMock(bool $expectsGetMethodCalled): MockObject
    {
        $mock = $this->getMockBuilder(TrelloClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        if ($expectsGetMethodCalled) {
            $mock->expects(static::once())->method('get');
        } else {
            $mock->expects(static::never())->method('get');
        }

        return $mock;
    }
}
