<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use Semaio\TrelloApi\Api\Token\TokenWebhooksApi;
use Semaio\TrelloApi\Api\TokenApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;

/**
 * @group unit
 */
class TokenApiTest extends ApiTestCase
{
    protected $fakeId = '5461efc60872da1eca5bf45c';

    protected $apiPath = 'tokens';

    /**
     * @test
     */
    public function shouldShowToken(): void
    {
        $response = ['id' => $this->fakeId];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeId));
    }

    /**
     * @test
     */
    public function shouldRemoveToken(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeId));
    }

    /**
     * @test
     */
    public function shouldGetMember(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeId.'/member')
            ->willReturn($response);

        static::assertEquals($response, $api->getMember($this->fakeId));
    }

    /**
     * @test
     */
    public function shouldGetMemberField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeId.'/member/fullName')
            ->willReturn($response);

        static::assertEquals($response, $api->getMemberField($this->fakeId, 'fullName'));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingMemberField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getMemberField($this->fakeId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetWebhooksApiObject(): void
    {
        static::assertInstanceOf(TokenWebhooksApi::class, $this->getApiMock()->webhooks());
    }

    protected function getApiClass()
    {
        return TokenApi::class;
    }
}
