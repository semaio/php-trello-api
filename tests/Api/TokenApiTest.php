<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Token\TokenWebhooksApi;
use Semaio\TrelloApi\Api\TokenApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;

#[Group('unit')]
class TokenApiTest extends ApiTestCase
{
    protected string $fakeId = '5461efc60872da1eca5bf45c';

    protected string $apiPath = 'tokens';

    #[Test]
    public function shouldShowToken(): void
    {
        $response = [
            'id' => $this->fakeId,
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeId));
    }

    #[Test]
    public function shouldRemoveToken(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeId));
    }

    #[Test]
    public function shouldGetMember(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeId.'/member')
            ->willReturn($response);

        static::assertEquals($response, $api->getMember($this->fakeId));
    }

    #[Test]
    public function shouldGetMemberField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeId.'/member/fullName')
            ->willReturn($response);

        static::assertEquals($response, $api->getMemberField($this->fakeId, 'fullName'));
    }

    #[Test]
    public function shouldNotGetUnexistingMemberField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects($this->never())->method('get');

        $api->getMemberField($this->fakeId, 'unexisting');
    }

    #[Test]
    public function shouldGetWebhooksApiObject(): void
    {
        static::assertInstanceOf(TokenWebhooksApi::class, $this->getApiMock()->webhooks());
    }

    protected function getApiClass(): string
    {
        return TokenApi::class;
    }
}
