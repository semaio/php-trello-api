<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\WebhookApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;

#[Group('unit')]
class WebhookApiTest extends ApiTestCase
{
    protected string $fakeId = '5461efc60872da1eca5bf45c';

    protected string $apiPath = 'webhooks';

    #[Test]
    public function shouldShowWebhook(): void
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
    public function shouldSetDescription(): void
    {
        $response = ['response'];

        $description = 'Test Webhook Description';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/description')
            ->willReturn($response);

        static::assertEquals($response, $api->setDescription($this->fakeId, $description));
    }

    #[Test]
    public function shouldSetCallbackUrl(): void
    {
        $response = ['response'];

        $description = 'Test Webhook CallbackUrl';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/callbackUrl')
            ->willReturn($response);

        static::assertEquals($response, $api->setCallbackUrl($this->fakeId, $description));
    }

    #[Test]
    public function shouldSetModel(): void
    {
        $response = ['response'];

        $modelId = $this->fakeId('webhook');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/idModel')
            ->willReturn($response);

        static::assertEquals($response, $api->setModel($this->fakeId, $modelId));
    }

    #[Test]
    public function shouldSetActive(): void
    {
        $response = ['response'];

        $status = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/active')
            ->willReturn($response);

        static::assertEquals($response, $api->setActive($this->fakeId, $status));
    }

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
            ->with($this->apiPath)
            ->willReturn($response);

        static::assertEquals($response, $api->create($response));
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

        $api->create($data);
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

        $api->create($data);
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
            ->with($this->apiPath.'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeId, $response));
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

        $api->update($this->fakeId, $data);
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

        $api->update($this->fakeId, $data);
    }

    protected function getApiClass(): string
    {
        return WebhookApi::class;
    }
}
