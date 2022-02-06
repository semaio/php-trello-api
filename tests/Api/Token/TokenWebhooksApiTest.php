<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Token;

use Semaio\TrelloApi\Api\Token\TokenWebhooksApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class TokenWebhooksApiTest extends ApiTestCase
{
    protected $apiPath = 'tokens/#id#/webhooks';

    /**
     * @test
     */
    public function shouldCreateWebhook(): void
    {
        $response = [
            'callbackURL' => 'http://www.callback.com/',
            'idModel' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->create($this->fakeParentId, $response));
    }

    /**
     * @test
     */
    public function shouldNotCreateWebhookWithoutCallbackUrl(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'idModel' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($this->fakeId, $data);
    }

    /**
     * @test
     */
    public function shouldNotCreateWebhookWithoutModelId(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'callbackUrl' => 'http://www.callback.com/',
        ];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($this->fakeId, $data);
    }

    /**
     * @test
     */
    public function shouldUpdateWebhook(): void
    {
        $response = [
            'callbackURL' => 'http://www.callback.com/',
            'idModel' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeParentId, $response));
    }

    /**
     * @test
     */
    public function shouldNotUpdateWebhookWithoutCallbackUrl(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'idModel' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->update($this->fakeParentId, $data);
    }

    /**
     * @test
     */
    public function shouldNotUpdateWebhookWithoutModelId(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'callbackUrl' => 'http://www.callback.com/',
        ];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->update($this->fakeParentId, $data);
    }

    /**
     * @test
     */
    public function shouldRemoveWebhook(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldGetAllWebhooks(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->all($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldShowWebhook(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass()
    {
        return TokenWebhooksApi::class;
    }
}
