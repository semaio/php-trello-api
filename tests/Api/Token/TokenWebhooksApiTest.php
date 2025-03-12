<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Token;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Token\TokenWebhooksApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class TokenWebhooksApiTest extends ApiTestCase
{
    protected string $apiPath = 'tokens/#id#/webhooks';

    #[Test]
    public function shouldCreateWebhook(): void
    {
        $response = [
            'callbackURL' => 'http://www.callback.com/',
            'idModel' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->create($this->fakeParentId, $response));
    }

    #[Test]
    public function shouldNotCreateWebhookWithoutCallbackUrl(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'idModel' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($this->fakeId, $data);
    }

    #[Test]
    public function shouldNotCreateWebhookWithoutModelId(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'callbackUrl' => 'http://www.callback.com/',
        ];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($this->fakeId, $data);
    }

    #[Test]
    public function shouldUpdateWebhook(): void
    {
        $response = [
            'callbackURL' => 'http://www.callback.com/',
            'idModel' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeParentId, $response));
    }

    #[Test]
    public function shouldNotUpdateWebhookWithoutCallbackUrl(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'idModel' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->update($this->fakeParentId, $data);
    }

    #[Test]
    public function shouldNotUpdateWebhookWithoutModelId(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'callbackUrl' => 'http://www.callback.com/',
        ];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->update($this->fakeParentId, $data);
    }

    #[Test]
    public function shouldRemoveWebhook(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeParentId, $this->fakeId));
    }

    #[Test]
    public function shouldGetAllWebhooks(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->all($this->fakeParentId));
    }

    #[Test]
    public function shouldShowWebhook(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass(): string
    {
        return TokenWebhooksApi::class;
    }
}
